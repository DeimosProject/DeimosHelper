<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;

class Money extends AbstractHelper
{

    /**
     * Format amount of money based on locale
     *
     * @param  string $amount
     * @param  string $locale [ de tr pt it nl fr ru en ]
     *
     * @return string
     */
    public function format($amount, $locale = 'en')
    {
        switch ($locale)
        {
            case 'de':
            case 'tr':
            case 'pt':
            case 'it':
            case 'nl':
                $amount = number_format($amount, 2, ',', '.');
                break;

            case 'fr':
            case 'ru':
                $amount = number_format($amount, 2, ',', ' ');
                break;

            case 'en':
                $amount = number_format($amount, 2, '.', ',');
                break;
        }

        return $amount;
    }

}