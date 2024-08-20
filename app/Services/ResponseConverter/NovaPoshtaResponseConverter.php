<?php

namespace App\Services\ResponseConverter;

use App\DTO\ParcelDataDTO;
use App\Services\Interfaces\ResponseConverterInterface;
use Illuminate\Http\Client\Response;

final class NovaPoshtaResponseConverter implements ResponseConverterInterface
{
    /**
     * @param Response $response
     * @return ParcelDataDTO
     */
    public function convert(Response $response): ParcelDataDTO
    {
        return new ParcelDataDTO(
            $response->object()->width,
            $response->object()->height,
            $response->object()->weight,
            $response->object()->length
        );
    }
}
