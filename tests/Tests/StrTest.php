<?php

namespace Tests;

use Deimos\Helper\Helpers\Str\Str;

class StrTest extends \DeimosTest\TestsSetUp
{

    public function testShorter()
    {
        $length = strlen('All their equipment and instruments are');
        $string = $this->helper->str()->shorten('All their equipment and instruments are alive', $length, 0);
        $this->assertEquals($string, 'All their equipment and instruments 0');

        $length = strlen('В вечернем свете волны отчаянно бились');
        $string = $this->helper->str()->shorten('В вечернем свете волны отчаянно бились о берег', $length, 0);
        $this->assertEquals($string, 'В вечернем свете волны отчаянно 0');
    }

    public function testUcFirst()
    {
        $string = 'i Watched the Storm, so beautiful yet terrific';

        $this->assertEquals(ucfirst($string), $this->helper->str()->ucFirst($string));
    }

    public function testLcFirst()
    {
        $string = 'I Watched the Storm, so beautiful yet terrific';

        $this->assertEquals(lcfirst($string), $this->helper->str()->lcFirst($string));
    }

    public function testToNumber()
    {
        $str = 'd2d5f0g-+@!HFV3445';

        $this->assertEquals($this->helper->str()->toNumber($str), '2503445');
    }

    public function testTransliteration()
    {
        $sourceStr = '';
        $resultStr = '';

        $arr = [
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
        ];

        foreach ($arr as $key => $value)
        {
            $sourceStr .= $key;
            $resultStr .= $value;
        }

        $this->assertEquals($this->helper->str()->transliteration($sourceStr), $resultStr);

        foreach (array_reverse($arr) as $key => $value)
        {
            $sourceStr .= $key;
            $resultStr .= $value;
        }

        $this->assertEquals($this->helper->str()->transliteration($sourceStr), $resultStr);
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRandomException()
    {
        $this->helper->str()->random(32, '123');
    }

    public function testRandom()
    {

        $str = $this->helper->str()->random(32, Str::RAND_ALPHA);
        $strNum = $this->helper->str()->random(32, Str::RAND_ALPHA_NUM);
        $num = $this->helper->str()->random(32, Str::RAND_NUM);

        $this->assertRegExp('/[a-zA-Z]+/', $str);
        $this->assertRegExp('/[a-zA-Z0-9]+/', $strNum);
        $this->assertRegExp('/[0-9]+/', $num);

    }

    public function testUniqueId()
    {
        $this->assertRegExp('/[a-z0-9]+/', $this->helper->str()->uniqid());
    }

    public function testFileSize()
    {
        $size = 500;
        $this->assertEquals(
            $size . ' B',
            $this->helper->str()->fileSize($size)
        );
        $size = 50000;
        $this->assertEquals(
            round($size/1024, 2) . ' KB',
            $this->helper->str()->fileSize($size)
        );
        $size = 50000000;
        $this->assertEquals(
            round($size/1024/1024, 2) . ' MB',
            $this->helper->str()->fileSize($size)
        );
        $size = 500000000000;
        $this->assertEquals(
            round($size/1024/1024/1024, 2) . ' GB',
            $this->helper->str()->fileSize($size)
        );
        $size = 500000000000000;
        $this->assertEquals(
            round($size/1024/1024/1024/1024, 2) . ' TB',
            $this->helper->str()->fileSize($size)
        );
        $size = 500000000000000000;
        $this->assertEquals(
            round($size/1024/1024/1024/1024/1024, 2) . ' PB',
            $this->helper->str()->fileSize($size)
        );
    }

    public function testCapitalize()
    {
        $str1 = 'All Their Equipment And Instruments Are';
        $str2 = 'В Вечернем Свете Волны Oтчаянно Бились';

        $this->assertEquals(
            $str1,
            $this->helper->str()->capitalize(
                mb_strtolower($str1)
            )
        );

        $this->assertEquals(
            $str2,
            $this->helper->str()->capitalize(
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
            $this->helper->str()->len($str1)
        );

        $this->assertEquals(
            mb_strlen($str2),
            $this->helper->str()->len($str2)
        );

    }

    public function testPos()
    {
        $str1 = 'All their equipment and instruments are';
        $str2 = 'В вечернем свете волны отчаянно бились';

        $this->assertEquals(
            3,
            $this->helper->str()->pos($str1, ' ')
        );

        $this->assertEquals(
            1,
            $this->helper->str()->pos($str2, ' ')
        );

    }

    public function testRepeat()
    {
        $this->assertRegExp(
            '/[b]{8}/',
            $this->helper->str()->repeat('b', 8)
        );
        $this->assertRegExp(
            '/[b]{16}/',
            $this->helper->str()->repeat('bb', 8)
        );
    }

    public function testShuffle()
    {
        $str1 = 'All their equipment and instruments are';
        $str2 = 'В вечернем свете волны отчаянно бились';

        $this->assertNotEquals(
            $str1,
            $this->helper->str()->shuffle($str1)
        );
        $this->assertNotEquals(
            $str2,
            $this->helper->str()->shuffle($str2)
        );
    }

}
