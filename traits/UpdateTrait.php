<?php

/**
 * This file is part of the DoctrineEntityTrait.
 */

namespace Irontec\DoctrineEntityTrait;

use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Irontec <info@irontec.com>
 *
 * @see https://github.com/irontec
 */
#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
trait UpdateTrait
{
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
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

    public function getUpdatedFormat(
        string $format = 'd-m-Y H:i:s e',
        string $timeZone = 'UTC',
    ): string {
        $timezones = timezone_identifiers_list();

        if (in_array($timeZone, $timezones)) {
            $this->updated->setTimeZone(new DateTimeZone($timeZone));
        } else {
            $this->updated->setTimeZone(new DateTimeZone('UTC'));
        }

        return $this->updated->format($format);
    }
}
