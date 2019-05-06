# UpdateTrait

Trait para gestionar la fecha de actualización de los registro de una entidad, teniendo en cuenta el TimeZone UTC.

````php
<?php

namespace App\Entity;

use \Irontec\DoctrineEntityTrait\UpdateTrait;

class MyEntity
{
    ...
    use UpdateTrait;
    ...
}
````
