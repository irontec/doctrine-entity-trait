<?php

/**
 * This file is part of the DoctrineEntityTrait.
 */

namespace Irontec\DoctrineEntityTrait;

use DateTimeImmutable;
use DateTimeZone;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Entities using this Trait must have the
 * `#[ORM\HasLifecycleCallbacks]` attribute.
 */
trait TimestampableTrait
{
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    #[Groups(['timestampable'])]
    protected ?DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    #[Groups(['timestampable'])]
    protected ?DateTimeImmutable $updatedAt = null;

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    public function createTimestamps(): void
    {
        $now = new DateTimeImmutable('now', timezone: new DateTimeZone('UTC'));
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        $this->updatedAt = new DateTimeImmutable('now', timezone: new DateTimeZone('UTC'));
    }
}
