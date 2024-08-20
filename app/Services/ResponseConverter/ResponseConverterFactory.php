<?php

namespace App\Services\ResponseConverter;

use App\Services\Enums\DeliveryServicesEnum;
use App\Services\Interfaces\ResponseConverterFactoryInterface;
use App\Services\Interfaces\ResponseConverterInterface;
use App\Exceptions\InvalidArgumentException;

final class ResponseConverterFactory implements ResponseConverterFactoryInterface
{
    /**
     * @param string $operator
     * @return ResponseConverterInterface
     */
    public function create(string $operator): ResponseConverterInterface
    {
        return match ($operator) {
            DeliveryServicesEnum::novaposhta->name => new NovaPoshtaResponseConverter(),
            DeliveryServicesEnum::urkposhta->name => new UkrPoshtaResponseConverter(),
            default => throw new InvalidArgumentException(400, "Unknown response converter '{$operator}'"),
        };
    }
}
