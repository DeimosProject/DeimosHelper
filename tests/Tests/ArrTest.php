<?php

namespace Tests;

use Deimos\Helper\Exceptions\ExceptionEmpty;
use Deimos\Helper\Helpers\Arr;

class ArrTest
{

    public function map()
    {
        $array = [1,2,3,4];

        $arr =
    }

    public function filter(array $storage, callable $callback)
    {
        return array_filter($storage, $callback);
    }

    public function keyExists($key, array $storage)
    {
        return array_key_exists($key, $storage);
    }

    protected function findPath(array $storage, array $keys)
    {
        if (empty($keys))
        {
            throw new ExceptionEmpty('Not found keys');
        }

        $rows = &$storage;

        foreach ($keys as $key)
        {
            if (!$this->keyExists($key, $rows))
            {
                throw new ExceptionEmpty("Key {$key} not found");
            }

            $rows = $rows[$key];
        }

        return $rows;
    }

    protected function keys($key)
    {
        return explode('.', $key);
    }

    public function get(array $storage, $key, $default = null)
    {
        try
        {
            return $this->findPath($storage, $this->keys($key));
        }
        catch (ExceptionEmpty $empty)
        {
            return $default;
        }
    }

    public function getRequired(array $storage, $key = null)
    {
        return $this->findPath($storage, $this->keys($key));
    }
}