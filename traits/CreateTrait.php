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
trait CreateTrait
{

    #[ORM\Column(type: 'datetime')]
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

    /**
     * @param string $format
     * @param string $timeZone
     * @return string
     */
    public function getCreatedFormat(
        string $format = 'd-m-Y H:i:s e',
        string $timeZone = 'UTC'
    ): string {

        $timezones = timezone_identifiers_list();

        if (in_array($timeZone, $timezones)) {
            $this->created->setTimezone(new DatetimeZone($timeZone));
        } else {
            $this->created->setTimezone(new DatetimeZone('UTC'));
        }

        return $this->created->format($format);
    }
}
