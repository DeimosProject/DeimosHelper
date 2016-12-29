<?php

namespace Tests;

use Deimos\Helper\Exceptions\ExceptionEmpty;

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

}
