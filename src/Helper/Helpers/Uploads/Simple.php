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
        $this->tmpName = $this->file($files, $index, 'tmp_name');
        $this->error   = $this->file($files, $index, 'error');
        $this->name    = $this->file($files, $index, 'name');
        $this->size    = $this->file($files, $index, 'size');
        $this->type    = $this->file($files, $index, 'type');
    }

    /**
     * @param array  $files
     * @param int    $index
     * @param string $type
     *
     * @return mixed
     */
    protected function file(array &$files, $index, $type)
    {
        if (isset($files[$type][$index]))
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