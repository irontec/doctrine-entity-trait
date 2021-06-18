<?php

/**
 * This file is part of the DoctrineEntityTrait.
 * @package irontec/doctrine-entity-trait
 */

namespace Irontec\DoctrineEntityTrait;

use DateTime;
use DateTimeZone;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author Irontec <info@irontec.com>
 * @author ddniel16 <ddniel16>
 * @link https://github.com/irontec
 */
#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
trait UpdateTrait
{

    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $updated;

    public function getUpdated(): DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?DateTimeInterface $updated): self
    {
        $this->updated = $updated;
        return $this;
    }

    #[ORM\PrePersist]
    public function prePersistUpdated(): void
    {
        $this->setUpdated(new DateTime('now', new DateTimeZone('UTC')));
    }

    #[ORM\PreUpdate]
    public function preUpdateUpdated(): void
    {
        $this->setUpdated(new DateTime('now', new DateTimeZone('UTC')));
    }

    /**
     * @param string $format
     * @param string $timeZone
     * @return string
     */
    public function getUpdatedFormat(
        string $format = 'd-m-Y H:i:s e',
        string $timeZone = 'UTC'
    ): string {

        $timezones = timezone_identifiers_list();

        if (in_array($timeZone, $timezones)) {
            $this->updated->setTimezone(new DatetimeZone($timeZone));
        } else {
            $this->updated->setTimezone(new DatetimeZone('UTC'));
        }

        return $this->updated->format($format);
    }
}
