<?php

/**
* array replacement
*/
class Collection implements ArrayAccess, IteratorAggregate
{
    private $data;

    public function __construct(array $array)
    {
        $this->data = $array;
    }

    public function offsetGet($key)
    {
        if (isset($this->data[$key])) return $this->data[$key];
        else return false;
    }

    public function offsetSet($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function offsetExists($key)
    {
        return isset($this->data[$key]);
    }

    public function offsetUnset($key)
    {
        unset($this->data[$key]);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }
}