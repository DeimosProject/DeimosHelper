<?php

namespace Deimos\Helper\Helpers\Arr;

trait KeyTrait
{

    /**
     * @param array $storage
     *
     * @return mixed
     */
    public function firstKey(array $storage)
    {
        reset($storage);

        return key($storage);
    }

    /**
     * @param array $storage
     *
     * @return mixed
     */
    public function lastKey(array $storage)
    {
        end($storage);

        return key($storage);
    }

    /**
     * @param array  $storage
     * @param string $key
     *
     * @return mixed
     */
    public function at(array $storage, $key)
    {
        return $storage[$key];
    }

    /**
     * @param array $storage
     *
     * @return array
     */
    public function oddKey(array $storage)
    {
        return $this->filter($storage, function (&$value, &$key)
        {
            return $this->helper->math()->isOdd($key);
        });
    }

    /**
     * @param array $storage
     *
     * @return array
     */
    public function evenKey(array $storage)
    {
        return $this->filter($storage, function (&$value, &$key)
        {
            return $this->helper->math()->isEven($key);
        });
    }

    /**
     * @param array  $storage
     * @param string $key
     *
     * @return bool
     */
    public function keyExists(array &$storage, $key)
    {
        return isset($storage[$key]) || array_key_exists($key, $storage);
    }

    /**
     * @param string $key
     *
     * @return array
     */
    protected function keys($key)
    {
        return explode('.', $key);
    }

}
