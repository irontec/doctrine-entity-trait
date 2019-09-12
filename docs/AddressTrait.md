# AddressTrait

Trait con las prepiedades basicas en la gestión de dirección en una entidad.

````php
<?php

namespace App\Entity;

use \Irontec\DoctrineEntityTrait\AddressTrait;

class MyEntity
{
    ...
    use AddressTrait;
    ...
}
````

# Fields

+ address
+ city
+ state
+ postalCode
