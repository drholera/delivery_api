<?php

namespace App\Services;

use App\Services\Interfaces\DeliveryServiceInterface;
use App\Services\Interfaces\ResponseConverterInterface;
use Illuminate\Http\Client\Factory as HttpClient;

abstract class AbstractDeliveryService implements DeliveryServiceInterface
{
    /**
     * @param HttpClient $httpClient
     * @param ResponseConverterInterface $responseConverter
     */
    public function __construct(
        protected readonly HttpClient $httpClient,
        protected readonly ResponseConverterInterface $responseConverter
    ) {
    }
}
