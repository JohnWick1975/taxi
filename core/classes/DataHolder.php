<?php


namespace Core;


class DataHolder
{
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->_setData($data);
        }
    }

    public function __set($property_key, $value)
    {
        $setter = $this->_getSetterFor($property_key);
        $setter ? $this->$setter($value) : null;
    }

    public function __get($property_key)
    {
        $getter = $this->_getGetterFor($property_key);
        return $getter ? $this->$getter() : null;
    }

    private function _keyToMethod($prefix, $property_key)
    {
        return str_replace('_', '', $prefix . $property_key);
    }

    private function _methodToKey($prefix, $method)
    {
        $letter_array = str_split($method);
        foreach ($letter_array as &$letter) {
            if ($letter === strtoupper($letter)) {
                $letter = '_' . $letter;
            }
        }
        $name = (strtolower(join($letter_array)));
        return str_replace($prefix . '_', '', $name);
    }

    private function _getSetterFor($property_key)
    {
        $method_name = $this->_keyToMethod('set', $property_key);
        return method_exists($this, $method_name) ? $method_name : null;

    }

    private function _getGetterFor($property_key)
    {
        $method_name = $this->_keyToMethod('get', $property_key);
        return method_exists($this, $method_name) ? $method_name : null;
    }

    private function _getPropertyKeys()
    {
        $class_methods = get_class_methods($this);

        $get_methods_array = [];

        foreach ($class_methods as $method) {
            if (preg_match("/^get/", $method)) {
                $get_methods_array[] = $this->_methodToKey('get', $method);
            }
        }

        return $get_methods_array;
    }

    public function _setData(array $data)
    {
        foreach ($data as $property_key => $value) {
            $setter = $this->_getSetterFor($property_key);
            if ($setter) {
                $this->$setter($value);
            }
        }
    }

    public function _getData()
    {
        $data = [];

        foreach ($this->_getPropertyKeys() as $property_key) {
            $method_name = $this->_getGetterFor($property_key);
            $property = $this->{$method_name}();

            if ($property !== null) {
                $data[$property_key] = $property;
            }
        }

        return $data;
    }
}