<?php

/**
 * This file is part of the DoctrineEntityTrait.
 * @package irontec/doctrine-entity-trait
 */

namespace Irontec\DoctrineEntityTrait;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author Irontec <info@irontec.com>
 * @author ddniel16 <ddniel16>
 * @link https://github.com/irontec
 */
#[ORM\MappedSuperclass]
trait EnabledTrait
{

    #[ORM\Column(type: 'boolean', nullable: false, options: ['default' => 0])]
    private $enabled;

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function isEnabled(): bool
    {
        if (is_null($this->enabled)) {
            return false;
        }
        return $this->enabled;
    }

    public function disable(): self
    {
        $this->enabled = false;
        return $this;
    }

    public function enable(): self
    {
        $this->enabled = true;
        return $this;
    }
}
