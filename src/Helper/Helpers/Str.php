<?php

namespace Deimos\Helper\Helpers;

class Str implements InterfaceHelper
{

    const DIGITS = '0123456789';
    const ALPHABET = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * translite cyr->lat
     */
    public function translit($str)
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

    /**
     * Shortens text to length and keeps integrity of words
     *
     * @param  string  $str
     * @param  integer $length
     * @param  string  $end
     * @return string
     */
    public function shorten($str, $length = 100, $end = '&#8230;')
    {

        if (strlen($str) > $length) {
            $str = substr(trim($str), 0, $length);
            $str = substr($str, 0, -strpos(strrev($str), ' '));
            $str = trim($str.$end);
        }

        return $str;
    }

    /**
     * Return random string
     *
     * @param  integer $length
     * @param  string  $type
     * @return string
     *
     * @throws \Exception
     */
    public function randomStr($length = 32, $type = 'alnum')
    {
        switch ($type)
        {
            case 'alpha':
                $pool = self::ALPHABET;
                break;
            case 'alnum':
            case 'alphanum':
                $pool = self::DIGITS . self::ALPHABET;
                break;
            case 'num':
            case 'numeric':
                $pool = self::DIGITS;
                break;
            case 'md5':
                return md5(uniqid(mt_rand(), true));
                break;
            default:
                throw new \Exception("Invalid random string type [{$type}].");
        }

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    /**
     * Legacy method for randomStr
     *
     * @param int    $length
     * @param string $type
     * @return string
     *
     * @throws \Exception
     */
    public function password($length = 32, $type = 'alnum') {

        return $this->randomStr($length, $type);
    }

    /**
     * Format amount of money based on locale
     *
     * @param  float $amount
     * @param  string $currency
     * @param  string $locale [ de tr pt it nl fr ru en ]
     * @return string
     */
    public function formatMoney($amount, $currency = '€', $locale = 'en')
    {
        $symbols = array('€', '$', '£', '¥', '₤', 'kr', '₺');
        switch ($locale) {
            case 'de':
            case 'tr':
            case 'pt':
                $amount = number_format($amount, 2, ',', '.');
                $space = ' ';
                $format = is_string($currency) ? $amount.$space.$currency : $amount;
                break;
            case 'it':
            case 'nl':
                $amount = number_format($amount, 2, ',', '.');
                $space = ' ';
                $format = is_string($currency) ? $currency.$space.$amount : $amount;
                break;
            case 'fr':
                $amount = number_format($amount, 2, ',', ' ');
                $space = ' ';
                $format = is_string($currency) ? $amount.$space.$currency : $amount;
                break;
            case 'ru':
                $amount = number_format($amount, 2, ',', ' ');
                $space = in_array($currency, $symbols) ? '' : ' ';
                $format = is_string($currency) ? $amount.$space.$currency : $amount;
                break;
            default:
            case 'en':
                $amount = number_format($amount, 2, '.', ',');
                $space = in_array($currency, $symbols) ? '' : ' ';
                $format = is_string($currency) ? $currency.$space.$amount : $amount;
                break;
        }
        return $format;
    }

    /**
     * Legacy method for 'formatMoney'
     *
     * @param  float    $amount
     * @param  string   $currency
     * @param  string $locale [ de tr pt it nl fr ru en ]
     * @return string
     */
    public function moneyFormat($amount, $currency = '€', $locale = 'en')
    {
        return $this->formatMoney($amount, $currency, $locale);
    }

    /**
     * @param int    $fileSize
     * @param int    $decimals
     * @param string $dec_point
     * @param string $thousands_sep
     *
     * @return float
     */
    public function toHumanFileSize($fileSize, $decimals = 2, $dec_point = '.', $thousands_sep = '')
    {

        $postfix = 'b';

        switch (true)
        {
            case $fileSize >= ((1<<40) * 10):
                $postfix = 'Tb';
                $fileSize /= (1<<40);
                break;
            case $fileSize >= ((1<<30) * 10):
                $postfix = 'Gb';
                $fileSize /= (1<<30);
                break;
            case $fileSize >= ((1<<20)* 10):
                $postfix = 'Mb';
                $fileSize /= (1<<20);
                break;
            case $fileSize >= ((1<<10)* 10):
                $postfix = 'Kb';
                $fileSize /= (1<<10);
                break;
        }

        return number_format($fileSize, $decimals, $dec_point, $thousands_sep) . $postfix;
    }

}
