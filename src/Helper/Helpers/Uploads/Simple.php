<?php

namespace Deimos\Helper\Helpers\Uploads;

class Simple
{

    /**
     * @var string
     */
    protected $tmpName;

    /**
     * @var int
     */
    protected $error;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * Simple constructor.
     *
     * @param array $files
     * @param int   $index
     */
    public function __construct(array &$files, $index)
    {
        $this->tmpName = $this->file($files, 'tmp_name', $index);
        $this->error   = $this->file($files, 'error', $index);
        $this->name    = $this->file($files, 'name', $index);
        $this->size    = $this->file($files, 'size', $index);
        $this->type    = $this->file($files, 'type', $index);
    }

    /**
     * @param array  $files
     * @param string $type
     * @param int    $index
     *
     * @return mixed
     */
    protected function file(array &$files, $type, $index)
    {
        if (is_array($files[$type]))
        {
            return $files[$type][$index];
        }

        return $files[$type];
    }

    /**
     * @return int
     */
    public function error()
    {
        return $this->error;
    }

    /**
     * @return int
     */
    public function size()
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function save($path)
    {
        if (is_uploaded_file($this->tmpName()))
        {
            return move_uploaded_file($this->tmpName(), $path);
        }

        return false;
    }

    /**
     * @return string
     */
    protected function tmpName()
    {
        return $this->tmpName;
    }

}