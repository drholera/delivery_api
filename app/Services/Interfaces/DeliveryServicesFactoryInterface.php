<?php

namespace App\Services\Interfaces;

interface DeliveryServicesFactoryInterface
{
    /**
     * @param string $operator
     * @return DeliveryServiceInterface
     */
    public function create(string $operator): DeliveryServiceInterface;
}
