<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;

class Str extends AbstractHelper
{

    const DIGITS   = '0123456789';
    const ALPHABET = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    const RAND_ALPHA     = 1;
    const RAND_NUM       = 2;
    const RAND_ALPHA_NUM = self::RAND_ALPHA + self::RAND_NUM;
    const RAND_MD5       = 30;
    const RAND_SHA1      = 31;

    /**
     * Shortens text to length and keeps integrity of words
     *
     * @param  string  $str
     * @param  integer $length
     * @param  string  $end
     *
     * @return string
     */
    public function shorten($str, $length = 100, $end = '&#8230;')
    {

        if (strlen($str) > $length)
        {
            $str = substr(trim($str), 0, $length);
            $str = substr($str, 0, -strpos(strrev($str), ' '));
            $str = trim($str . $end);
        }

        return $str;
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
        return str_shuffle($string);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function ucFirst($string)
    {
        $first = $this->sub($string, 0, 1);
        $first = $this->upp($first);

        return $first . $this->sub($string, 1);
    }

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
     * Return random string
     *
     * @param  int $length
     * @param  int $type
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function random($length = 32, $type = self::RAND_ALPHA_NUM)
    {
        switch ($type)
        {
            case self::RAND_ALPHA:
                $pool = self::ALPHABET;
                break;

            case self::RAND_ALPHA_NUM:
                $pool = self::DIGITS . self::ALPHABET;
                break;

            case self::RAND_NUM:
                $pool = self::DIGITS;
                break;

            case self::RAND_MD5:
                return md5(uniqid(mt_rand(), true));
                break;

            case self::RAND_SHA1:
                return sha1(uniqid(mt_rand(), true));
                break;

            default:
                throw new \InvalidArgumentException("Invalid random string type [{$type}].");
        }

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    /**
     * @param int $size
     * @param int $decimals
     *
     * @return float
     */
    public function fileSize($size, $decimals = 2)
    {

        $postfix = 'B';

        switch (true)
        {
            case $size >= ((1 << 50) * 10):
                $postfix = 'PB';
                $size /= (1 << 50);
                break;

            case $size >= ((1 << 40) * 10):
                $postfix = 'TB';
                $size /= (1 << 40);
                break;

            case $size >= ((1 << 30) * 10):
                $postfix = 'GB';
                $size /= (1 << 30);
                break;

            case $size >= ((1 << 20) * 10):
                $postfix = 'MB';
                $size /= (1 << 20);
                break;

            case $size >= ((1 << 10) * 10):
                $postfix = 'KB';
                $size /= (1 << 10);
                break;
        }

        return round($size, $decimals) . ' ' . $postfix;
    }

    /**
     * transliteration cyr->lat
     *
     * @param $str
     *
     * @return string
     */
    public function transliteration($str)
    {

        return strtr($str, [
                'ОАО '  => 'OJSC ',
                'ЗАО '  => 'CJSC ',
                'ООО '  => 'LLC ',
                'ГОУ '  => 'SEE ',
                'МОУ '  => 'MEE ',
                'НОУ '  => 'NEE ',
                'фонд ' => 'Fund ',
                'союз ' => 'union ',

                'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
                'е' => 'e', 'ё' => 'e', 'з' => 'z', 'и' => 'i', 'й' => 'y',
                'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
                'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u',
                'ф' => 'f', 'х' => 'h', 'ъ' => '\'', 'ы' => 'i', 'э' => 'e',
                'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
                'Е' => 'E', 'Ё' => 'E', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y',
                'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
                'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U',
                'Ф' => 'F', 'Х' => 'H', 'Ъ' => '\'', 'Ы' => 'I', 'Э' => 'E',
                'ж' => 'zh', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh',
                'щ' => 'shch', 'ь' => '', 'ю' => 'yu', 'я' => 'ya',
                'Ж' => 'Zh', 'Ц' => 'Ts', 'Ч' => 'Ch', 'Ш' => 'Sh',
                'Щ' => 'Shch', 'Ь' => '', 'Ю' => 'Yu', 'Я' => 'Ya',
                '№' => 'N',
            ]
        );
    }

}
