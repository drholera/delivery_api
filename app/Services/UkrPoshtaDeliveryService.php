<?php

namespace App\Services;

use App\DTO\ParcelDataDTO;
use App\DTO\RecipientDataDTO;
use App\Services\Interfaces\ResponseConverterInterface;
use Illuminate\Http\Client\Factory as HttpClient;

final class UkrPoshtaDeliveryService extends AbstractDeliveryService
{
    /**
     * @param HttpClient $httpClient
     * @param ResponseConverterInterface $responseConverter
     */
    public function __construct(HttpClient $httpClient, private readonly ResponseConverterInterface $responseConverter)
    {
        parent::__construct($httpClient);
    }

    /**
     * @param RecipientDataDTO $recipientData
     * @return ParcelDataDTO
     */
    public function sendParcel(RecipientDataDTO $recipientData): ParcelDataDTO
    {
        $response = $this->httpClient->post(config('delivery.ukrposhta.base_url'), [
            'customer_name' => $recipientData->getName(),
            'phone_number' => $recipientData->getPhone(),
            'email' => $recipientData->getEmail(),
            'sender_address' => config('app.sender_address'),
            'delivery_address' => $recipientData->getAddress(),
        ]);


        return $this->responseConverter->convert($response);
    }
}
