<?php

namespace Deimos\Helper;

use Deimos\Helper\Helpers\InterfaceHelper;

class Helper
{

    /***
     * @var \Deimos\Builder\Builder
     */
    protected $builder;

    /**
     * @var array
     */
    protected $helpers = [
        'arr'  => Helpers\Arr::class,
        'json' => Helpers\Json::class,
        'str'  => Helpers\Str::class,
    ];

    /**
     * Helper constructor.
     *
     * @param \Deimos\Builder\Builder $builder
     */
    public function __construct(\Deimos\Builder\Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param string $name
     *
     * @return InterfaceHelper
     *
     * @throws \InvalidArgumentException
     */
    protected function instance($name)
    {
        static $storage = [];

        if (empty($storage[$name]))
        {
            $instance = $this->helpers[$name];

            $storage[$name] = new $instance($this->builder);

            if (!($storage[$name] instanceof InterfaceHelper))
            {
                throw new \InvalidArgumentException('Error ' . $name . ' from ' . __CLASS__);
            }
        }

        return $storage[$name];
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

}