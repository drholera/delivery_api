<?php

namespace App\Services\Interfaces;

interface ResponseConverterFactoryInterface
{
    /**
     * @param string $operator
     * @return ResponseConverterInterface
     */
    public function create(string $operator): ResponseConverterInterface;
}
