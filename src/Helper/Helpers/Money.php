<?php

namespace Deimos\Helper\Helpers;

use Deimos\Helper\AbstractHelper;

class Money extends AbstractHelper
{

    /**
     * Format amount of money based on locale
     *
     * @param  string $amount
     * @param  string $currency
     * @param  string $locale [ de tr pt it nl fr ru en ]
     *
     * @return string
     */
    public function format($amount, $currency = '€', $locale = 'en')
    {
        $symbols = array('€', '$', '£', '¥', '₤', 'kr', '₺');
        switch ($locale)
        {
            case 'de':
            case 'tr':
            case 'pt':
                $amount = number_format($amount, 2, ',', '.');
                $space  = ' ';
                $format = is_string($currency) ? $amount . $space . $currency : $amount;
                break;

            case 'it':
            case 'nl':
                $amount = number_format($amount, 2, ',', '.');
                $space  = ' ';
                $format = is_string($currency) ? $currency . $space . $amount : $amount;
                break;

            case 'fr':
                $amount = number_format($amount, 2, ',', ' ');
                $space  = ' ';
                $format = is_string($currency) ? $amount . $space . $currency : $amount;
                break;

            case 'ru':
                $amount = number_format($amount, 2, ',', ' ');
                $space  = in_array($currency, $symbols) ? '' : ' ';
                $format = is_string($currency) ? $amount . $space . $currency : $amount;
                break;

            default:
            case 'en':
                $amount = number_format($amount, 2, '.', ',');
                $space  = in_array($currency, $symbols) ? '' : ' ';
                $format = is_string($currency) ? $currency . $space . $amount : $amount;
                break;
        }

        return $format;
    }

}