<?php

namespace Deimos\Helper\Helpers\Arr;

use Deimos\Helper\Exceptions\ExceptionEmpty;

trait StackTrait
{

    /**
     * @param array $storage
     * @param       $mixed
     *
     * @return int
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
     * @return int
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
     * 1, 3, 5...
     *
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
     * 0, 2, 4...
     *
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
     * @param array  $storage
     * @param string $key
     * @param int    $value
     */
    public function initOrPush(array &$storage, $key, $value)
    {
        if (empty($storage[$key]))
        {
            $storage[$key] = [];
        }

        $storage[$key][] = $value;
    }

}
