<?php

namespace Deimos\Helper\Helpers\Uploads;

use Deimos\Helper\AbstractHelper;

class Uploads extends AbstractHelper
{

    /**
     * @var array
     */
    protected $storage = [];

    /**
     * @param string $name
     *
     * @return Simple[]
     */
    public function get($name)
    {
        if (!isset($this->storage[$name]))
        {
            $files = &$this->files();

            if (empty($files[$name]))
            {
                return [];
            }

            foreach ($this->keys($name) as $index => $value)
            {
                $this->simple($name, $index);
            }
        }

        return $this->storage[$name];
    }

    /**
     * @return array
     */
    public function &files()
    {
        return $_FILES;
    }

    /**
     * @param string $name
     *
     * @return array
     */
    protected function keys($name)
    {
        $files = &$this->files();

        return array_keys((array)$files[$name]['name']);
    }

    /**
     * @param string $name
     * @param int    $index
     *
     * @return Simple|null
     */
    public function simple($name, $index = 0)
    {
        if (!isset($this->storage[$name][$index]))
        {
            $files = &$this->files();

            if (empty($files[$name]))
            {
                return null;
            }

            $this->storage[$name][$index] = new Simple($files[$name], $index);
        }

        return $this->storage[$name][$index];
    }

}