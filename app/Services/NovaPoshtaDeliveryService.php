<?php

namespace App\Services;

use App\DTO\ParcelDataDTO;
use App\DTO\RecipientDataDTO;

final class NovaPoshtaDeliveryService extends AbstractDeliveryService
{
    /**
     * @param RecipientDataDTO $recipientData
     * @return ParcelDataDTO
     */
    public function sendParcel(RecipientDataDTO $recipientData): ParcelDataDTO
    {
        $response = $this->httpClient->post(config('delivery.novaposhta.base_url'), [
            'customer_name' => $recipientData->getName(),
            'phone_number' => $recipientData->getPhone(),
            'email' => $recipientData->getEmail(),
            'sender_address' => config('app.sender_address'),
            'delivery_address' => $recipientData->getAddress(),
        ]);

        return $this->responseConverter->convert($response);
    }
}
