<?php

namespace App\Services\Api;

use App\Exceptions\CustomException;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubscriptionService
{
    /**
     * @return AnonymousResourceCollection
     * @throws CustomException
     */
    public function getAllSubscriptions()
    {
        $subscriptions = Subscription::all();
        if ($subscriptions->isEmpty())
            throw new CustomException("No subscriptions were found",404);

        return SubscriptionResource::collection($subscriptions);
    }

    /**
     * @param $subscriptionRequest
     * @return JsonResponse
     */
    public function saveSubscription($subscriptionRequest)
    {
        $subscription = new Subscription($subscriptionRequest);
        $subscription->save();

        return response()->json([
            "success" => true,
            "message" => "subscription saved successfully",
            "subscription" => new SubscriptionResource($subscription)
        ]);
    }

    /**
     * @param $subId
     * @return SubscriptionResource
     * @throws CustomException
     */
    public function getSubscriptionById($subId)
    {
        $existingSubscription = Subscription::where('id',$subId)->with('user')->first();
        if ($existingSubscription == null)
            throw new CustomException("Subscription with id: $subId does not exist", 404);

        return new SubscriptionResource($existingSubscription);
    }
}
