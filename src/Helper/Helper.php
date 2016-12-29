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
        return $this->instance('arr');
    }

    /**
     * @return Helpers\Str
     */
    public function str()
    {
        return $this->instance('str');
    }

    /**
     * @return Helpers\Json
     */
    public function json()
    {
        return $this->instance('json');
    }

    /**
     * @return Helpers\File
     */
    public function file()
    {
        return $this->instance('file');
    }

    /**
     * @return Helpers\Dir
     */
    public function dir()
    {
        return $this->instance('dir');
    }

    /**
     * @return Helpers\Money
     */
    public function money()
    {
        return $this->instance('money');
    }

    /**
     * @return Helpers\Math
     */
    public function math()
    {
        return $this->instance('math');
    }

    /**
     * @return Helpers\Arr
     */
    protected function buildArr()
    {
        return new Helpers\Arr($this);
    }

    /**
     * @return Helpers\Str
     */
    protected function buildStr()
    {
        return new Helpers\Str($this);
    }

    /**
     * @return Helpers\Json
     */
    protected function buildJson()
    {
        return new Helpers\Json($this);
    }

    /**
     * @return Helpers\File
     */
    protected function buildFile()
    {
        return new Helpers\File($this);
    }

    /**
     * @return Helpers\Dir
     */
    protected function buildDir()
    {
        return new Helpers\Dir($this);
    }

    /**
     * @return Helpers\Money
     */
    protected function buildMoney()
    {
        return new Helpers\Money($this);
    }

    /**
     * @return Helpers\Math
     */
    protected function buildMath()
    {
        return new Helpers\Math($this);
    }

}