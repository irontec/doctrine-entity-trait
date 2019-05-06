<?php

namespace Irontec\DoctrineEntityTrait;

use \Doctrine\ORM\Mapping as ORM;

/**
 * @author Irontec <info@irontec.com>
 * @author ddniel16 <daniel@irontec.com>
 * @link https://www.irontec.com
 *
 * @ORM\MappedSuperclass
 */
trait LocationTrait
{

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $longitude;

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getLocation(): ?string
    {

        if (empty($this->latitude) || empty($this->longitude)) {
            return null;
        }

        return trim($this->latitude) . ',' . trim($this->longitude);

    }

    public function setLocation(string $location): self
    {

        list ($latitude, $longitude) = explode(',', $location);

        $this->setLatitude($latitude);
        $this->setLongitude($longitude);

        return $this;

    }

}
