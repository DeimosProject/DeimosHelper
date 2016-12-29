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
    public function keyExists(array $storage, $key)
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