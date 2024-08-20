<?php

namespace App\Services\Testing;

use App\DTO\ParcelDataDTO;
use App\DTO\RecipientDataDTO;
use App\Services\Interfaces\DeliveryServiceInterface;
use Faker\Factory;

final class FakeDeliveryService implements DeliveryServiceInterface
{
    /**
     * @param RecipientDataDTO $recipientData
     * @return ParcelDataDTO
     */
    public function sendParcel(RecipientDataDTO $recipientData): ParcelDataDTO
    {
        $faker = Factory::create();
        return new ParcelDataDTO(
            $faker->numberBetween(1, 100),
            $faker->numberBetween(1, 100),
            $faker->numberBetween(1, 100),
            $faker->numberBetween(1, 100),
        );
    }
}
