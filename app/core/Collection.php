<?php

/**
* array replacement
*/
class Collection implements ArrayAccess, IteratorAggregate
{
    /**
     * @var array content of the collection
     */
    private $data;

    /**
     * @param array $array the data to convert into a collection
     */
    public function __construct(array $array)
    {
        $this->data = $array;
    }

    /**
     * gets a named key in the collection
     *
     * @param string $key name of the wanted key
     *
     * @return mixed the content of the key or false if the key doesn't exist
     */
    public function offsetGet($key)
    {
        if (isset($this->data[$key])) return $this->data[$key];
        else return false;
    }

    /**
     * sets a named key in the collection
     * @param string $key   name of the wanted key
     * @param mixed  $value the new value for the key
     */
    public function offsetSet($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * tests if a key exists
     * @param string $key name of the key to test
     * @return bool the result of the test
     */
    public function offsetExists($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * deletes a collection index
     * @param string $key name of the key to delete
     */
    public function offsetUnset($key)
    {
        unset($this->data[$key]);
    }

    /**
     * @return ArrayIterator iterator on the collection content
     */
    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }
}