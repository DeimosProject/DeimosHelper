<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class File extends AbstractHelper
{

    /**
     * @param string $path
     *
     * @return bool
     */
    public function touch($path)
    {
        return touch($path);
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function remove($path)
    {
        return unlink($path);
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function exists($path)
    {
        return file_exists($path);
    }

    /**
     * @param string $path
     *
     * @return int
     */
    public function size($path)
    {
        return filesize($path);
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function isReadable($path)
    {
        return is_readable($path);
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function isFile($path)
    {
        return (is_file($path) && !$this->helper->dir()->isDir($path));
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function isUploadedFile($path)
    {
        return is_uploaded_file($path);
    }

    public function uploadedKeyExist($key)
    {
        return isset($_FILES[$key]['tmp_name']);
    }

    /**
     * @param string $key
     * @param string $path
     *
     * @return bool
     *
     * @throws \InvalidArgumentException
     */
    public function saveUploadedFile($key, $path)
    {
        if(!$this->uploadedKeyExist($key) || !$this->isUploadedFile($_FILES[$key]['tmp_name']))
        {
            throw new \InvalidArgumentException();
        }

        return move_uploaded_file($_FILES[$key]['tmp_name'], $path);
    }

    /**
     * @param string $key
     * @param bool   $safety
     *
     * @return mixed
     */
    public function getUploadedFileName($key, $safety = true)
    {
        if(!$this->uploadedKeyExist($key))
        {
            throw new \InvalidArgumentException();
        }

        return $safety ? escapeshellcmd($_FILES[$key]['name']) : $_FILES[$key]['name'];
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getUploadedFileSize($key)
    {
        if(!$this->uploadedKeyExist($key))
        {
            throw new \InvalidArgumentException();
        }

        return $_FILES[$key]['size'];
    }

    /**
     * @param string $key
     *
     * @return mixed
     *
     * @link http://php.net/manual/features.file-upload.errors.php
     */
    public function getUploadedFileError($key)
    {
        if(!$this->uploadedKeyExist($key))
        {
            throw new \InvalidArgumentException();
        }

        return $_FILES[$key]['error'];
    }

}
