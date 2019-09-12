# CreateTrait

Trait para gestionar la fecha de creación de los registro de una entidad, teniendo en cuenta el TimeZone UTC.

````php
<?php

namespace App\Entity;

use \Irontec\DoctrineEntityTrait\UserNameTrait;

class MyEntity
{
    ...
    use UserNameTrait;
    ...
}
````

# Fields

+ name
+ lastName

## Functions

Funciones disponibles

+ **getName**: Getter de "Name"
+ **setName**: Setter de "Name"
+ **getLastName**: Getter de "lastName"
+ **setLastName**: Setter de "lastName"
+ **getFullName**: Combina el nombre y apellido en un string

