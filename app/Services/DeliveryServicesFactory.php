<?php

namespace App\Services;

use App\Exceptions\InvalidArgumentException;
use App\Services\Enums\DeliveryServicesEnum;
use App\Services\Interfaces\DeliveryServiceInterface;
use App\Services\Interfaces\DeliveryServicesFactoryInterface;
use App\Services\Interfaces\ResponseConverterFactoryInterface;
use App\Services\Testing\FakeDeliveryService;
use Illuminate\Http\Client\Factory as HttpClient;

final class DeliveryServicesFactory implements DeliveryServicesFactoryInterface
{
    /**
     * @param HttpClient $httpClient
     * @param ResponseConverterFactoryInterface $responseConverterFactory
     */
    public function __construct(
        private readonly HttpClient $httpClient,
        private readonly ResponseConverterFactoryInterface $responseConverterFactory
    ) {
    }

    /**
     * @param string $operator
     * @return DeliveryServiceInterface
     */
    public function create(string $operator): DeliveryServiceInterface
    {
        if (config('delivery.debug')) {
            return new FakeDeliveryService();
        }

        $converter = $this->responseConverterFactory->create($operator);
        return match ($operator) {
            DeliveryServicesEnum::novaposhta->name => new NovaPoshtaDeliveryService($this->httpClient, $converter),
            DeliveryServicesEnum::urkposhta->name => new UkrPoshtaDeliveryService($this->httpClient, $converter),
            // Add other services here
            default => throw new InvalidArgumentException(400, "Unsupported courier: $operator"),
        };
    }
}
