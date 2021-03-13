<?php

declare(strict_types=1);

namespace App\Console\Commands\Chain;

use App\Entity\Block;
use App\Entity\Chain;
use App\Services\Block\Hasher;
use App\Services\Chain\ChainService;
use Illuminate\Console\Command;
use RuntimeException;

class BlockchainGenerator extends Command
{
    /** @var string  */
    protected $signature = 'generate:blockchain_with_genesis_block';
    /** @var string  */
    protected $description = 'Create new blockchain with genesis block.';

    private ChainService $chainService;
    private Hasher $blockHasher;

    /**
     * @param ChainService $chainService
     * @param Hasher $blockHasher
     */
    public function __construct(ChainService $chainService, Hasher $blockHasher)
    {
        parent::__construct();

        $this->chainService = $chainService;
        $this->blockHasher = $blockHasher;
    }

    public function handle(): void
    {
        $this->createIfNotExistBlockchainFile();

        $initBlock = new Block(0, '', 'init block');

        $hash =  $this->blockHasher->calculateHash($initBlock);
        $initBlock->setHash($hash);

        $chain = new Chain([$initBlock]);

        $this->chainService->saveCurrentChain($chain);
    }

    private function createIfNotExistBlockchainFile(): void
    {
        $pathToFile = base_path(env('BLOCKCHAIN_FILE_PATH'));

        if (file_exists($pathToFile)) {
            return;
        }

        $result = file_put_contents($pathToFile, '', LOCK_EX);

        if ($result === false) {
            throw new RuntimeException('Error creating the file!');
        }
    }
}
