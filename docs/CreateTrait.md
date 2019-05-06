# CreateTrait

Trait para gestionar la fecha de creación de los registro de una entidad, teniendo en cuenta el TimeZone UTC.


````php
<?php

namespace App\Entity;

use \Irontec\DoctrineEntityTrait\CreateTrait;

class MyEntity
{
    ...
    use CreateTrait;
    ...
}
````
