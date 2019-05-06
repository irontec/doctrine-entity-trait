# LocationTrait

Trait para gestionar información de geolocalización de Latitud y Longitud.

````php
<?php

namespace App\Entity;

use \Irontec\DoctrineEntityTrait\LocationTrait;

class MyEntity
{
    ...
    use LocationTrait;
    ...
}
````

## Setter

````php
<?php

$entity->setLatitude('43.2686965');
$entity->setLongitude('-2.934542');

// -- OR --

$entity->setLocation('43.2686965,-2.934542');

````

## Getter

````php
<?php

$entity->getLatitude();//43.2686965
$entity->getLongitude();//-2.934542

// -- OR --

$entity->getLocation();//43.2686965,-2.934542

````
