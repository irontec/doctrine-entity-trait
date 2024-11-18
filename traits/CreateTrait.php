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
trait CreateTrait
{
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $created;

    public function getCreated(): DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    #[ORM\PrePersist]
    public function prePersistCreated(): void
    {
        $this->setCreated(new DateTime('now', new DateTimeZone('UTC')));
    }

    public function getCreatedFormat(
        string $format = 'd-m-Y H:i:s e',
        string $timeZone = 'UTC',
    ): string {
        $timezones = timezone_identifiers_list();

        if (in_array($timeZone, $timezones)) {
            $this->created->setTimezone(new DateTimeZone($timeZone));
        } else {
            $this->created->setTimezone(new DateTimeZone('UTC'));
        }

        return $this->created->format($format);
    }
}
