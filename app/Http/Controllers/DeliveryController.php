<?php

namespace App\Http\Controllers;

use App\DTO\RecipientDataDTO;
use App\Http\Requests\SendParcelDeliveryRequest;
use App\Services\Interfaces\DeliveryServicesFactoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

final class DeliveryController extends Controller
{
    public function __construct(private readonly DeliveryServicesFactoryInterface $deliveryServicesFactory) {}

    /**
     * As a test task I've created DeliveryServices only for NP and UKRP.
     *
     * If a client will have A LOT of operators we'll need to update DeliveryServiceEnum and add
     * required services and response converters. Also, factories should be updated to handle the additional operators.
     *
     * For testing purpose FakeDeliveryService was created. To disable it just change flag `DELIVERY_DEBUG` in the `.env` file.
     *
     * Question: If the customer has a problem with the delivery of orders. Customer sends data, but courier service support says they are not receiving data from current service.
     * In this case we should rely on the response from the delivery service. If we're receiving response as expected - we're good,
     * but it should be discussed with the delivery operator.
     * BUT if the response is empty or wrong (and we're sure it's issue on the operator side) we can postpone
     * request sending with a delayed job.
     *
     * @param SendParcelDeliveryRequest $request
     * @return Response
     */
    public function sendParcel(SendParcelDeliveryRequest $request): Response
    {
        $operator = $request->input('operator');

        $deliveryService = $this->deliveryServicesFactory->create($operator);

        $recipientData = new RecipientDataDTO(
            $request->input('name'),
            $request->input('email'),
            $request->input('phone'),
            $request->input('address'),
        );

        try {
            $parcelData = $deliveryService->sendParcel($recipientData);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
            // We can create postponed job here and return a message that the delivery was scheduled and the customer
            //will receive an update about the result by the email or SMS.
        }

        return new JsonResponse([
            'data' => [
                'width' => $parcelData->getWidth(),
                'height' => $parcelData->getHeight(),
                'weight' => $parcelData->getWeight(),
                'length' => $parcelData->getLength(),
            ]
        ]);
    }
}
