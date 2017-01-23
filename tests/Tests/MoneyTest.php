<?php

namespace Tests;

use Deimos\Helper\Traits\Helper;

class MoneyTest extends \DeimosTest\TestSetUp
{

    use Helper;

    protected $moneyValue = 1234.15;

    public function testFormatEn()
    {
        $this->assertEquals(
            $this->helper()->money()->format($this->moneyValue),
            number_format($this->moneyValue, 2, '.', ',')
        );
    }
    public function testFormatDe()
    {
        $this->assertEquals(
            $this->helper()->money()->format($this->moneyValue, 'de'),
            number_format($this->moneyValue, 2, ',', '.')
        );
    }
    public function testFormatRu()
    {
        $this->assertEquals(
            $this->helper()->money()->format($this->moneyValue, 'ru'),
            number_format($this->moneyValue, 2, ',', ' ')
        );
    }

}
