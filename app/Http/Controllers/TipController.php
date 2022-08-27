<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipRequest;
use App\Http\Resources\TipResource;
use App\Services\Api\TipService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TipController extends Controller
{
    /**
     * @var TipService
     */
    private $_tipService;

    public function __construct(TipService $tipService)
    {
        $this->_tipService = $tipService;
    }

    /**
     * View all tips
     *
     * This endpoint lets you get all the tips from the storage
     * @return AnonymousResourceCollection
     */
    public function viewAllTips()
    {
        return $this->_tipService->viewAllTips();
    }
    /**
     * Create a new tip
     *
     * This endpoint lets you add a new tip to the storage
     * @param TipRequest $tipRequest
     * @return JsonResponse
     */
    public function createTip(TipRequest $tipRequest)
    {
        return $this->_tipService->createNewTip($tipRequest->validated());
    }

    /**
     * View a tip
     *
     * This endpoint lets you get a single tip using its id
     * Throws an error if the tip is not found in storage
     * @param $tipId
     * @return TipResource
     */
    public function viewTip($tipId)
    {
        return $this->_tipService->getTipById($tipId);
    }

    /**
     * Update a tip
     *
     * This endpoint lets update an existing tip
     * Throws an error if the tip is not found in storage
     * @param TipRequest $tipRequest
     * @param $tipId
     * @return JsonResponse
     */
    public function updateTip(TipRequest $tipRequest, $tipId)
    {
        return $this->_tipService->updateExistingTip($tipRequest->validated(), $tipId);
    }

    /**
     * Delete a tip
     *
     * This endpoint lets you remove a tip from storage
     * Throws an error if the tip is not found in storage
     * @param $tipId
     * @return JsonResponse
     */
    public function deleteTip($tipId)
    {
        return $this->_tipService->deleteTip($tipId);
    }
}
