# GetToFieldsTrait

Obtiene un array de respuesta de la entidad, en base a un string separando los campos por coma (,) Si se quiere obtener campos de entidades relacionadas, se pone el nombre de la entidad y el campo separado por punto (.)

````php
<?php

namespace App\Entity;

use \Irontec\DoctrineEntityTrait\GetToFieldsTrait;

class MyEntity
{
    ...
    use GetToFieldsTrait;
    ...
}
````

## Example

````php
<?php

$fields = 'id,name,email,company.id,company.name';

$entity->__getToFields($fields);
/*
array (size=4)
  'id' => int 1
  'name' => string 'info'
  'email' => string 'info@irontec.com'
  'company' => 
    array (size=2)
      'id' => int 1
      'name' => string 'Irontec'
*/

````
