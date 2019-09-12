# EnabledTrait

Trait para marcar una entidad con un booleano, que se pueda usar como enabled/disabled.

````php
<?php

namespace App\Entity;

use \Irontec\DoctrineEntityTrait\EnabledTrait;

class MyEntity
{
    ...
    use EnabledTrait;
    ...
}
````

# Fields

+ enabled

## Functions

Funciones disponibles

+ **getEnabled**: Getter del estado
+ **setEnabled**: Setter manual estado
+ **isEnabled**: Comprueba cual es el estado
+ **disable**: Fuerza el estado a FALSE
+ **enable**: Fuerza el estado a TRUE
