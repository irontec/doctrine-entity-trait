<?php

/**
 * This file is part of the DoctrineEntityTrait.
 */

namespace Irontec\DoctrineEntityTrait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Irontec <info@irontec.com>
 *
 * @see https://github.com/irontec
 */
#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
trait AddressTrait
{
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private $address;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private $city;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private $state;

    #[ORM\Column(type: Types::INTEGER)]
    private $postalCode;

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }
}
