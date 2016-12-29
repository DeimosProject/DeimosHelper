<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;
use Deimos\Helper\Exceptions\ExceptionEmpty;

class Arr extends AbstractHelper
{

    /**
     * @param array    $storage
     * @param callable $callback
     *
     * @return array
     */
    public function map(array $storage, callable $callback)
    {
        return array_map($callback, $storage);
    }

    /**
     * @param array    $storage
     * @param callable $callback
     *
     * @return array
     */
    public function filter(array $storage, callable $callback)
    {
        return array_filter($storage, $callback);
    }

    /**
     * @param     $string
     * @param     $length
     * @param int $start
     *
     * @return array
     */
    public function fill($string, $length, $start = 0)
    {
        return array_fill($string, $length, $start);
    }

    /**
     * @param mixed $begin
     * @param mixed $end
     *
     * @return mixed
     */
    public function range($begin, $end)
    {
        return $this->range($begin, $end);
    }

    /**
     * @param array $storage
     * @param mixed $needle
     *
     * @return bool
     */
    public function inStrict(array $storage, $needle)
    {
        return in_array($needle, $storage, true);
    }

    /**
     * @param array $storage
     * @param mixed $needle
     *
     * @return bool
     */
    public function in(array $storage, $needle)
    {
        return in_array($needle, $storage, false);
    }

    /**
     * @param array $storage
     *
     * @return array
     */
    public function shuffle(array &$storage)
    {
        return shuffle($storage);
    }

    /**
     * @param array $storage
     * @param       $mixed
     *
     * @return mixed
     */
    public function push(array &$storage, $mixed)
    {
        return array_push($storage, $mixed);
    }

    /**
     * @param array $storage
     *
     * @return mixed
     */
    public function pop(array &$storage)
    {
        return array_pop($storage);
    }

    /**
     * @param array $storage
     *
     * @return mixed
     */
    public function shift(array &$storage)
    {
        return array_shift($storage);
    }

    /**
     * @param array $storage
     * @param       $mixed
     *
     * @return mixed
     */
    public function unShift(array &$storage, $mixed)
    {
        return array_unshift($storage, $mixed);
    }

    /**
     * @param array $storage
     *
     * @return mixed
     */
    public function first(array $storage)
    {
        reset($storage);

        return current($storage);
    }

    /**
     * @param array $storage
     *
     * @return mixed
     */
    public function last(array $storage)
    {
        return end($storage);
    }

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
        return $this->filter($storage, function ($value, $key)
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
        return $this->filter($storage, function ($value, $key)
        {
            return $this->helper->math()->isEven($key);
        });
    }

    /**
     * @param array $storage
     *
     * @return array
     */
    public function odd(array $storage)
    {
        return $this->filter($storage, function ($value)
        {
            return $this->helper->math()->isOdd($value);
        });
    }

    /**
     * @param array $storage
     *
     * @return array
     */
    public function even(array $storage)
    {
        return $this->filter($storage, function ($value)
        {
            return $this->helper->math()->isEven($value);
        });
    }

    /**
     * @param array  $storage
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
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

    /**
     * @param array $storage
     * @param array $keys
     *
     * @return array|mixed
     * @throws ExceptionEmpty
     */
    protected function findPath(array $storage, array $keys)
    {
        if (empty($keys))
        {
            throw new ExceptionEmpty('Not found keys');
        }

        $rows = &$storage;

        foreach ($keys as $key)
        {
            if (!$this->keyExists($rows, $key))
            {
                throw new ExceptionEmpty("Key {$key} not found");
            }

            $rows = $rows[$key];
        }

        return $rows;
    }

    /**
     * @param array  $storage
     * @param string $key
     *
     * @return bool
     */
    public function keyExists(array &$storage, $key)
    {
        return array_key_exists($key, $storage);
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

    /**
     * @param array $storage
     * @param null  $key
     *
     * @return array|mixed
     * @throws ExceptionEmpty
     */
    public function getRequired(array $storage, $key = null)
    {
        return $this->findPath($storage, $this->keys($key));
    }

}