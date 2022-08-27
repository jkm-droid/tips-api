<?php

namespace App\Services\Api;

use App\Exceptions\CustomException;
use App\Http\Resources\TipResource;
use App\Models\Tip;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TipService
{
    /**
     * @return AnonymousResourceCollection
     * @throws CustomException
     */
    public function viewAllTips()
    {
        $tips = Tip::all();
        if ($tips->isEmpty())
            throw new CustomException('Not tips were found',404);

        return TipResource::collection($tips);
    }

    /**
     * @param $tipRequest
     * @return JsonResponse
     */
    public function createNewTip($tipRequest): JsonResponse
    {
        $tip = new Tip($tipRequest);
        $tip->save();

        return response()->json([
            'success' => true,
            'message' => 'Tip created successfully',
            'tip' => new TipResource($tip)
        ]);
    }

    /**
     * @param $tipRequest
     * @param $tipId
     * @return JsonResponse
     */
    public function updateExistingTip($tipRequest, $tipId): JsonResponse
    {
        $existingTip = $this->checkIfExists($tipId);

        $existingTip->update($tipRequest);

        return response()->json([
            'success' => true,
            'message' => 'Tip updated successfully',
            'tip' => new TipResource($existingTip)
        ]);
    }

    /**
     * @param $tipId
     * @return TipResource
     * @throws CustomException
     */
    public function getTipById($tipId)
    {
        $existingTip = $this->checkIfExists($tipId);

        return new TipResource($existingTip);
    }

    /**
     * @param $tipId
     * @return JsonResponse
     * @throws CustomException
     */
    public function deleteTip($tipId)
    {
        $existingTip = $this->checkIfExists($tipId);

        $existingTip->delete();

        return response()->json([
            'success'=> true,
            'message' => "Tip with the id $tipId deleted successfully"
        ]);
    }

    /**
     * @param $tipId
     * @return mixed
     * @throws CustomException
     */
    private function checkIfExists($tipId)
    {
        $existingTip = Tip::where('id', $tipId)->first();
        if ($existingTip == null)
            throw new CustomException("Tip with the id: $tipId does not exist",404);
        else
            return $existingTip;
    }
}
