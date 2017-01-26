<?php

namespace Tests;

use Deimos\Helper\Helpers\Str\Str;
use Deimos\Helper\Traits\Helper;

class StrTest extends \DeimosTest\TestSetUp
{

    use Helper;

    public function testShorter()
    {
        $length = strlen('All their equipment and instruments are');
        $string = $this->helper()->str()->shorten('All their equipment and instruments are alive', $length, 0);
        $this->assertEquals($string, 'All their equipment and instruments 0');

        $length = strlen('В вечернем свете волны отчаянно бились');
        $string = $this->helper()->str()->shorten('В вечернем свете волны отчаянно бились о берег', $length, 0);
        $this->assertEquals($string, 'В вечернем свете волны отчаянно 0');
    }

    public function testUcFirst()
    {
        $string = 'i Watched the Storm, so beautiful yet terrific';

        $this->assertEquals(ucfirst($string), $this->helper()->str()->ucFirst($string));
    }

    public function testLcFirst()
    {
        $string = 'I Watched the Storm, so beautiful yet terrific';

        $this->assertEquals(lcfirst($string), $this->helper()->str()->lcFirst($string));
    }

    public function testToNumber()
    {
        $str = 'd2d5f0g-+@!HFV3445';

        $this->assertEquals($this->helper()->str()->toNumber($str), '2503445');
    }

    public function testTransliteration()
    {
        $sourceStr = '';
        $resultStr = '';

        $arr = [
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

        foreach ($arr as $key => $value)
        {
            $sourceStr .= $key;
            $resultStr .= $value;
        }

        $this->assertEquals($this->helper()->str()->translit($sourceStr), $resultStr);

        foreach (array_reverse($arr) as $key => $value)
        {
            $sourceStr .= $key;
            $resultStr .= $value;
        }

        $this->assertEquals($this->helper()->str()->translit($sourceStr), $resultStr);
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRandomException()
    {
        $this->helper()->str()->random(32, 0);
    }

    public function testRandom()
    {
        $str    = $this->helper()->str()->random(64, Str::RAND_ALPHA);
        $strNum = $this->helper()->str()->random(64, Str::RAND_ALL);
        $num    = $this->helper()->str()->random(64, Str::RAND_DIGITS);

        $this->assertRegExp('/[a-z]+/', $str);
        $this->assertRegExp('/[A-Z]+/', $str);

        $this->assertRegExp('/[a-z]+/', $strNum);
        $this->assertRegExp('/[A-Z]+/', $strNum);
        $this->assertRegExp('/[0-9]+/', $strNum);

        $strNum = $this->helper()->str()->random(64, Str::RAND_ALPHA_LOW | Str::RAND_DIGITS);

        $this->assertRegExp('/[a-z]+/', $strNum);
        $this->assertRegExp('/[^A-Z]+/', $strNum);
        $this->assertRegExp('/[0-9]+/', $strNum);

        $this->assertRegExp('/[0-9]+/', $num);
    }

    public function testUniqueId()
    {
        $this->assertRegExp('/[a-z0-9]+/', $this->helper()->str()->uniqid());
    }

    public function testFileSize()
    {
        $size = 500;
        $this->assertEquals(
            $size . ' B',
            $this->helper()->str()->fileSize($size)
        );
        $size = 50000;
        $this->assertEquals(
            round($size / 1024, 2) . ' KB',
            $this->helper()->str()->fileSize($size)
        );
        $size = 50000000;
        $this->assertEquals(
            round($size / 1024 / 1024, 2) . ' MB',
            $this->helper()->str()->fileSize($size)
        );
        $size = 500000000000;
        $this->assertEquals(
            round($size / 1024 / 1024 / 1024, 2) . ' GB',
            $this->helper()->str()->fileSize($size)
        );
        $size = 500000000000000;
        $this->assertEquals(
            round($size / 1024 / 1024 / 1024 / 1024, 2) . ' TB',
            $this->helper()->str()->fileSize($size)
        );
        $size = 500000000000000000;
        $this->assertEquals(
            round($size / 1024 / 1024 / 1024 / 1024 / 1024, 2) . ' PB',
            $this->helper()->str()->fileSize($size)
        );
    }

    public function testCapitalize()
    {
        $str1 = 'All Their Equipment And Instruments Are';
        $str2 = 'В Вечернем Свете Волны Oтчаянно Бились';

        $this->assertEquals(
            $str1,
            $this->helper()->str()->capitalize(
                mb_strtolower($str1)
            )
        );

        $this->assertEquals(
            $str2,
            $this->helper()->str()->capitalize(
                mb_strtolower($str2)
            )
        );

    }

    public function testLen()
    {
        $str1 = 'All their equipment and instruments are';
        $str2 = 'В вечернем свете волны отчаянно бились';

        $this->assertEquals(
            mb_strlen($str1),
            $this->helper()->str()->len($str1)
        );

        $this->assertEquals(
            mb_strlen($str2),
            $this->helper()->str()->len($str2)
        );

    }

    public function testPos()
    {
        $str1 = 'All their equipment and instruments are';
        $str2 = 'В вечернем свете волны отчаянно бились';

        $this->assertEquals(
            3,
            $this->helper()->str()->pos($str1, ' ')
        );

        $this->assertEquals(
            1,
            $this->helper()->str()->pos($str2, ' ')
        );

    }

    public function testRepeat()
    {
        $this->assertRegExp(
            '/[b]{8}/',
            $this->helper()->str()->repeat('b', 8)
        );
        $this->assertRegExp(
            '/[b]{16}/',
            $this->helper()->str()->repeat('bb', 8)
        );
    }

    public function testShuffle()
    {
        $str1 = 'All their equipment and instruments are';
        $str2 = 'В вечернем свете волны отчаянно бились';

        $this->assertNotEquals(
            $str1,
            $this->helper()->str()->shuffle($str1)
        );
        $this->assertNotEquals(
            $str2,
            $this->helper()->str()->shuffle($str2)
        );
    }

}
