<?php

namespace Irontec\DoctrineEntityTrait;

use \Doctrine\ORM\PersistentCollection;

/**
 * @author Irontec <info@irontec.com>
 * @author ddniel16 <daniel@irontec.com>
 * @link https://www.irontec.com
 *
 * @ORM\MappedSuperclass
 */
trait GetToFieldsTrait
{

    public function __getToFields($fields = NULL)
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
            $getter = 'get' . ucfirst($key);
            if (method_exists($this, $getter)) {
                $data = $this->$getter();

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
        }

        return $item;

    }

    protected function _getEntityData($data, $value)
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

     protected function _getEntityDateRelation($data, $value, $oneToMany = true)
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
