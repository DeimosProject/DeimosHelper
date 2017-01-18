<?php

namespace Deimos\Helper\Helpers\Arr;

use Deimos\Helper\AbstractHelper;
use Deimos\Helper\Exceptions\ExceptionEmpty;

class Arr extends AbstractHelper
{

    use KeyTrait;
    use StackTrait;

    /**
     * @param array    $storage
     * @param callable $callback
     *
     * @return array
     */
    public function map(array $storage, $callback)
    {
        return array_map($callback, $storage);
    }

    /**
     * @param array    $storage
     * @param callable $callback
     *
     * @return array
     */
    public function filter(array $storage, $callback)
    {
        return array_filter($storage, $callback, ARRAY_FILTER_USE_BOTH);
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
        return array_fill($start, $length, $string);
    }

    /**
     * @param mixed $begin
     * @param mixed $end
     * @param int   $step
     *
     * @return array
     */
    public function range($begin, $end, $step = 1)
    {
        return range($begin, $end, $step);
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
     * @param array  $storage
     * @param string $path
     * @param mixed  $value
     */
    public function set(array &$storage, $path, $value)
    {
        $keys = $this->keys($path);

        $rows = &$storage;
        foreach ($keys as $key)
        {
            if (!$this->keyExists($rows, $key))
            {
                $rows[$key] = [];
            }

            $rows = &$rows[$key];
        }

        $rows = $value;
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
                throw new ExceptionEmpty("Key '{$key}' not found");
            }

            $rows = &$rows[$key];
        }

        return $rows;
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