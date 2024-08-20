<?php

namespace App\Services;

use App\Services\Interfaces\DeliveryServiceInterface;
use Illuminate\Http\Client\Factory as HttpClient;

abstract class AbstractDeliveryService implements DeliveryServiceInterface
{
    /**
     * @param HttpClient $httpClient
     */
    public function __construct(protected readonly HttpClient $httpClient) {}
}
