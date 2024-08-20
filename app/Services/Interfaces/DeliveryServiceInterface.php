<?php

namespace App\Services\Interfaces;

use App\DTO\ParcelDataDTO;
use App\DTO\RecipientDataDTO;

interface DeliveryServiceInterface
{
    /**
     * @param RecipientDataDTO $recipientData
     * @return bool
     */
    public function sendParcel(RecipientDataDTO $recipientData): ParcelDataDTO;
}
