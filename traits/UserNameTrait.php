<?php

/**
 * This file is part of the DoctrineEntityTrait.
 * @package irontec/doctrine-entity-trait
 */

namespace Irontec\DoctrineEntityTrait;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @author Irontec <info@irontec.com>
 * @author ddniel16 <ddniel16>
 * @link https://github.com/irontec
 */
#[ORM\MappedSuperclass]
trait UserNameTrait
{

    #[Assert\NotBlank(message: 'user.name.not_blank')]
    #[Assert\Length(max: 100, maxMessage: 'user.name.max')]
    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[Assert\NotBlank(message: 'user.lastName.not_blank')]
    #[Assert\Length(max: 100, maxMessage: 'user.lastName.max')]
    #[ORM\Column(type: 'string', length: 100)]
    private string $lastName;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getFullName(): string
    {
        return sprintf(
            '%s %s',
            $this->getName(),
            $this->getLastName()
        );
    }
}
