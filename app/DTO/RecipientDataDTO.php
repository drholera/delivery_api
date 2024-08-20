<?php

namespace App\DTO;

final class RecipientDataDTO
{
    /**
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $address
     */
    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $phone,
        private readonly string $address,
    ) {}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }
}
