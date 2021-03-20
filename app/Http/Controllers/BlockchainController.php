<?php

namespace App\Http\Controllers;

use App\Services\Block\BlockService;
use App\Services\Chain\ChainHydrator;
use App\Services\Chain\ChainService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class BlockchainController extends Controller
{
    private ChainService $chainService;
    private BlockService $blockService;
    private ChainHydrator $chainHydrator;

    /**
     * @param ChainService $chainService
     * @param BlockService $blockService
     */
    public function __construct(ChainService $chainService, BlockService $blockService, ChainHydrator $chainHydrator)
    {
        $this->chainService = $chainService;
        $this->blockService = $blockService;
        $this->chainHydrator = $chainHydrator;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $data = $request->input('data');

        $newBlock = $this->blockService->createNewBlock($data);
        $currentChain = $this->chainService->appendNewBlock($newBlock);
        $this->chainService->saveCurrentChain($currentChain);

        return response()->json(['success' => true], 201);
    }

    /**
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $curChain = $this->chainService->getCurrentCain();
        $chain = $this->chainHydrator->extract($curChain);

        return response()->json(['chain' => $chain]);
    }

}
