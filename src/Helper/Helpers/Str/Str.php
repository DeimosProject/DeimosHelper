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

    protected $transliterationTable = [
        'ОАО '  => 'OJSC ',
        'ЗАО '  => 'CJSC ',
        'ООО '  => 'LLC ',
        'ГОУ '  => 'SEE ',
        'МОУ '  => 'MEE ',
        'НОУ '  => 'NEE ',
        'фонд ' => 'Fund ',
        'союз ' => 'union ',

        'á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A',
        'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A',
        'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C',
        'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C',
        'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh',
        'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E',
        'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E',
        'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G',
        'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H',
        'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I',
        'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I',
        'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L',
        'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N',
        'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O',
        'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O',
        'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE',
        'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R',
        'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S',
        'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't',
        'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u',
        'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u',
        'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u',
        'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w',
        'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y',
        'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z',
        'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a',
        'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd',
        'е' => 'e', 'Е' => 'e', 'ё' => 'e', 'Ё' => 'e', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z',
        'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l',
        'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p',
        'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u',
        'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch',
        'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y',
        'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja'
    ];

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
            $str = \substr(trim($str), 0, $length);
            $str = \substr($str, 0, -\strpos(\strrev($str), ' '));
            $str = \trim($str . $end);
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
            $string .= $chars[\random_int(0, $max)];
        }

        return $string;
    }

    /**
     * @return string
     */
    public function uniqid()
    {
        return \uniqid(\random_int(\PHP_INT_MIN, \PHP_INT_MAX), true);
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

        return \round($size, $decimals) . ' ' . $postfix;
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
        $string = \strtr($string, $this->transliterationTable);

        return \iconv(\mb_internal_encoding(), 'ASCII//TRANSLIT', $string);
    }

}
