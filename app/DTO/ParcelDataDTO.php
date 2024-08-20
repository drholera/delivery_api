<?php

namespace App\DTO;

final class ParcelDataDTO
{
    /**
     * @param int $width
     * @param int $height
     * @param int $weight
     * @param int $length
     */
    public function __construct(
        private readonly int $width,
        private readonly int $height,
        private readonly int $weight,
        private readonly int $length,
    ) {}

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }
}
