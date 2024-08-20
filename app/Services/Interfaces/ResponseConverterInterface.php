<?php

namespace App\Services\Interfaces;

use App\DTO\ParcelDataDTO;
use Illuminate\Http\Client\Response;

interface ResponseConverterInterface
{
    /**
     * @param Response $response
     * @return ParcelDataDTO
     */
    public function convert(Response $response): ParcelDataDTO;
}
