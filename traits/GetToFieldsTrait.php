<?php

namespace Irontec\DoctrineEntityTrait;

use \Doctrine\ORM\PersistentCollection;

/**
 * @author Irontec <info@irontec.com>
 * @author ddniel16 <daniel@irontec.com>
 * @link https://www.irontec.com
 */
trait GetToFieldsTrait
{

    /**
     * Obtiene un array de respuesta de la entidad, en base a un string separando los campos por coma (,)
     * Si se quiere obtener campos de entidades relacionadas, se pone el nombre de la entidad y el campo separado por punto (.)
     *
     * Example: id,name,email,company.id,company.name
     *
     * @param string $fields
     * @return array
     */
    public function __getToFields(?string $fields = NULL): array
    {

        if (!is_string($fields)) {
            return array();
        }

        $item = array();
        $fields = explode(',', $fields);

        $parseFields = array();
        foreach ($fields as $field) {
            $ex = explode('.', $field);
            if (sizeof($ex) > 1) {
                $parseFields[$ex[0]][] = $ex[1];
            } else {
                $parseFields[$field] = $field;
            }
        }

        foreach ($parseFields as $key => $value) {

            if (strpos($key, '_') !== false) {
                $pieces = explode('_', $key);
                $pieces = array_map('ucfirst', $pieces);
                $fieldGetter = implode('', $pieces);
                $getter = 'get' . ucfirst($fieldGetter);
            } else {
                $getter = 'get' . ucfirst($key);
            }

            if (method_exists($this, $getter)) {
                $data = $this->$getter();

                if (is_null($data) && empty($data)) {
                    $item[$key] = $data;
                    continue;
                }

                if ($data instanceof PersistentCollection) {
                    $item[$key] = $this->_getEntityDateRelation($data, $value, true);
                } elseif (
                    (isset($data->__initializer__) && $data->__initializer__ instanceof \Closure)
                ||
                    (isset($data->__isInitialized__) && $data->__isInitialized__ === true)
                ) {
                    $item[$key] = $this->_getEntityDateRelation($data, $value, false);
                } else {
                    $item[$key] = $this->_getEntityData($data, $value);
                }

            }
        }//$parseFields

        return $item;

    }

    private function _getEntityData($data, $value)
    {

        if (!is_object($data)) {
            return $data;
        }

        if ($data instanceof \DateTime) {
            return $data->format('Y-m-d H:i:s');
        }

         $newData = array();

         if (is_array($value)) {
             $newData[] = $data->__getToFields(implode(',', $value));
         }

         return $newData;

     }

     private function _getEntityDateRelation($data, $value, $oneToMany = true)
     {

         $newData = array();

         if ($oneToMany === true) {
             foreach ($data as $entity) {
                 if (is_array($value)) {
                     $newData[] = $entity->__getToFields(implode(',', $value));
                 }
             }

            return $newData;
         }

         if (is_array($value)) {
             $newData = $data->__getToFields(implode(',', $value));
         }

         return $newData;

     }

}
