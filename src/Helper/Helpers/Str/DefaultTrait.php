<?php

namespace Deimos\Helper\Helpers\Str;

trait DefaultTrait
{

    /**
     * @param string $string
     * @param int    $start
     * @param int    $length
     *
     * @return string
     */
    public function sub($string, $start, $length = null)
    {
        return mb_substr($string, $start, $length);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function upp($string)
    {
        return mb_convert_case($string, MB_CASE_UPPER);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function low($string)
    {
        return mb_convert_case($string, MB_CASE_LOWER);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function capitalize($string)
    {
        return mb_convert_case($string, MB_CASE_TITLE);
    }

    /**
     * @param string $string
     *
     * @return string mixed
     */
    public function toNumber($string)
    {
        return preg_replace('/\D/', '', $string);
    }

    /**
     * @param $string
     *
     * @return int
     */
    public function len($string)
    {
        return mb_strlen($string);
    }

    /**
     * @param string $string
     * @param string $needle
     * @param int    $offset
     *
     * @return int
     */
    public function pos($string, $needle, $offset = null)
    {
        return mb_strpos($string, $needle, $offset);
    }

    /**
     * @param string $string
     * @param int    $multiplier
     *
     * @return string
     */
    public function repeat($string, $multiplier)
    {
        return str_repeat($string, $multiplier);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function shuffle($string)
    {
        return $this->rand($string, $this->len($string));
    }

}
