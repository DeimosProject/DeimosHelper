<?php

namespace DeimosTest;

class Uploads extends \Deimos\Helper\Helpers\Uploads\Uploads
{
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