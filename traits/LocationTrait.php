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
trait LocationTrait
{

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitude;

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
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

    public function setLocation(float $latitude, float $longitude): self
    {

        $this->setLatitude($latitude);
        $this->setLongitude($longitude);

        return $this;

    }

}
