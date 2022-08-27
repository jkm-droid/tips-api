<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Services\Api\SubscriptionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubscriptionController extends Controller
{
    /**
     * @var SubscriptionService
     */
    private $_subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->_subscriptionService = $subscriptionService;
    }

    /**
     * Display all the subscriptions
     *
     * This endpoint lets you get all the app's subscribers
     * @return AnonymousResourceCollection
     * @throws CustomException
     */
    public function displayAllSubscriptions()
    {
        return $this->_subscriptionService->getAllSubscriptions();
    }

    /**
     * Create a new subscription
     *
     * This endpoint lets you add a new subscription to the storage
     * @param SubscriptionRequest $request
     * @return JsonResponse
     */
    public function createNewSubscription(SubscriptionRequest $request)
    {
        return $this->_subscriptionService->saveSubscription($request->validated());
    }

    /**
     * Display single subscription
     *
     * This endpoint lets you get a single subscription using its id
     * @param $subId
     * @return SubscriptionResource
     * @throws CustomException
     */
    public function viewSingleSubscription($subId)
    {
        return $this->_subscriptionService->getSubscriptionById($subId);
    }
}
