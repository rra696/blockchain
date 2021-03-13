<?php

declare(strict_types=1);

namespace App\Services\Chain;

use App\Entity\Block;
use App\Entity\Chain;
use App\Services\Chain\Storage\Storage;
use Dotenv\Exception\ValidationException;

class ChainService
{
    private ChainValidator $chainValidator;
    private Storage $chainStorage;

    /**
     * @param ChainValidator $validator
     * @param Storage $chainStorage
     */
    public function __construct(ChainValidator $validator, Storage $chainStorage)
    {
        $this->chainValidator = $validator;
        $this->chainStorage = $chainStorage;
    }

    /**
     * @param Block $newBlock
     * @return Chain
     */
    public function appendNewBlock(Block $newBlock): Chain
    {
        $currentChain = $this->getCurrentCain();

        $blocks = $currentChain->getBlocks();
        $blocks[] = $newBlock;

        return $currentChain->update($blocks);
    }

    /**
     * @return Chain
     */
    public function getCurrentCain(): Chain
    {
        return $this->chainStorage->get();
    }

    /**
     * @param Chain $chain
     */
    public function saveCurrentChain(Chain $chain): void
    {
        $isChainValid = $this->chainValidator->validate($chain);

        if (!$isChainValid) {
            throw new ValidationException('New chain is not valid.');
        }

        $this->chainStorage->save($chain);
    }

    /**
     * @return Block
     */
    public function getLastBlock(): Block
    {
        $blocks = $this->getCurrentCain()->getBlocks();

        return end($blocks);
    }
}
