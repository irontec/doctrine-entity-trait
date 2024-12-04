# TimestampableTrait

Trait para gestionar la fecha UTC de creación/actualización de una entidad.

````php
<?php

namespace App\Entity;

use \Irontec\DoctrineEntityTrait\TimestampableTrait;

class MyEntity
{
    ...
    use TimestampableTrait;
    ...
}
````

# Fields

+ createdAt
+ updatedAt
