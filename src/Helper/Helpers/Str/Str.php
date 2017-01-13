<?php

namespace Deimos\Helper\Helpers\Str;

use Deimos\Helper\AbstractHelper;

class Str extends AbstractHelper
{

    use DefaultTrait;

    const DIGITS        = '0123456789';
    const ALPHABET_LOW  = 'abcdefghijklmnopqrstuvwxyz';
    const ALPHABET_HIGH = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const ALPHABET      = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    const RAND_ALPHA_LOW  = 1;
    const RAND_ALPHA_HIGH = 2;
    const RAND_ALPHA      = 4;
    const RAND_DIGITS     = 8;
    const RAND_ALL        = 16;

    /**
     * @var array
     */
    protected $dictionary = [
        4 => self::ALPHABET . self::DIGITS,
        3 => self::DIGITS,
        2 => self::ALPHABET,
        1 => self::ALPHABET_HIGH,
        0 => self::ALPHABET_LOW,
    ];

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
     *
     * @return string
     */
    public function lcFirst($string)
    {
        $first = $this->sub($string, 0, 1);
        $first = $this->low($first);

        return $first . $this->sub($string, 1);
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
    public function random($length = 32, $type = self::RAND_ALL)
    {
        $string = '';

        // todo: make to halper?
        foreach ($this->dictionary as $pos => $item)
        {
            $key = (1 << $pos);
            if ($type >= $key)
            {
                $string .= $item;
                $type -= $key;
            }
        }

        if (empty($string))
        {
            throw new \InvalidArgumentException("Invalid random string type [{$type}].");
        }

        return $this->rand($string, $length);
    }

    /**
     * @param string $chars
     * @param int    $length
     *
     * @return string
     */
    protected function rand($chars, $length)
    {
        $string = '';
        $max    = $this->len($chars) - 1;

        for ($i = 0; $i < $length; $i++)
        {
            $string .= $chars[random_int(0, $max)];
        }

        return $string;
    }

    /**
     * @return string
     */
    public function uniqid()
    {
        return uniqid(mt_rand(), true);
    }

    /**
     * @param int $size
     * @param int $decimals
     *
     * @return float
     */
    public function fileSize($size, $decimals = 2)
    {

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

            default:
                $postfix = 'B';
        }

        return round($size, $decimals) . ' ' . $postfix;
    }

    /**
     * transliteration cyr->lat
     *
     * @param $string
     *
     * @return string
     */
    public function translit($string)
    {
        $string = strtr($string, [
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

        return iconv(mb_internal_encoding(), 'ASCII//TRANSLIT', $string);
    }

}
