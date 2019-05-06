<?php

namespace Irontec\DoctrineEntityTrait;

use \Doctrine\ORM\Mapping as ORM;

/**
 * @author Irontec <info@irontec.com>
 * @author ddniel16 <daniel@irontec.com>
 * @link https://www.irontec.com
 *
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 */
trait CreateTrait
{

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $created;

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created): self
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersistCreated()
    {
        $this->setCreated(new \DateTime('now', new \DateTimeZone('UTC')));
    }

    /**
     * @param string $format
     * @param string $timeZone
     * @return string
     */
    public function getCreatedFormat(
        string $format = 'd-m-Y H:i:s e',
        string $timeZone = 'UTC'
    ): string
    {

        $timezones = timezone_identifiers_list();

        if (in_array($timeZone, $timezones)) {
            $this->created->setTimezone(new \DatetimeZone($timeZone));
        } else {
            $this->created->setTimezone(new \DatetimeZone('UTC'));
        }

        return $this->created->format($format);

    }

}
