<?php

namespace Deimos\Helper;

use Deimos\Builder\Builder;

class Helper extends Builder
{

    /***
     * @var Builder
     */
    protected $builder;

    /**
     * Helper constructor.
     *
     * @param Builder $builder
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(Builder $builder)
    {
        if ($builder instanceof self)
        {
            throw new \InvalidArgumentException('Instanceof SELF');
        }

        $this->builder = $builder;
    }

    /**
     * @return Helpers\Arr
     */
    public function arr()
    {
        return $this->once(function ()
        {
            return new Helpers\Arr($this);
        });
    }

    /**
     * @return Helpers\Str
     */
    public function str()
    {
        return $this->once(function ()
        {
            return new Helpers\Str($this);
        });
    }

    /**
     * @return Helpers\Json
     */
    public function json()
    {
        return $this->once(function ()
        {
            return new Helpers\Json($this);
        });
    }

    /**
     * @return Helpers\File
     */
    public function file()
    {
        return $this->once(function ()
        {
            return new Helpers\File($this);
        });
    }

    /**
     * @return Helpers\Dir
     */
    public function dir()
    {
        return $this->once(function ()
        {
            return new Helpers\Dir($this);
        });
    }

    /**
     * @return Helpers\Money
     */
    public function money()
    {
        return $this->once(function ()
        {
            return new Helpers\Money($this);
        });
    }

    /**
     * @return Helpers\Math
     */
    public function math()
    {
        return $this->once(function ()
        {
            return new Helpers\Math($this);
        });
    }

}