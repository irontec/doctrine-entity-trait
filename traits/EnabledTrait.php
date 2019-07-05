<?php
/**
 * This file is part of the DoctrineEntityTrait.
 */

namespace Irontec\DoctrineEntityTrait;

use \Doctrine\ORM\Mapping as ORM;

/**
 * @author Irontec <info@irontec.com>
 * @author ddniel16 <ddniel16>
 * @link https://github.com/irontec
 *
 * @ORM\MappedSuperclass
 */
trait EnabledTrait
{

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $enabled;

    public function isEnabled(): bool
    {
        if (is_null($this->enabled)) {
            return false;
        }
        return $this->enabled;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

}
