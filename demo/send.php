<?php

include_once __DIR__ . '/../vendor/autoload.php';

$builder = new \Deimos\Builder\Builder();
$helper  = new \Deimos\Helper\Helper($builder);

$bytes = 0;
$bytesIterator = 0;
$seconds = time();
$speed = 0;

echo
'Send file test',
PHP_EOL,
PHP_EOL,
PHP_EOL,
'in progress...',
PHP_EOL,
PHP_EOL;

/**
 * @link https://wiki.archlinux.org/index.php/Color_Bash_Prompt
 * @var array $colors
 */
$colors = [
    'bracket' =>
        [
            'beforeSymbol' => '[',
            'afterSymbol' => ']',
            'color' => '1;36m',
        ],
    'progress' =>
        [
            'symbol' => '#',
            'color' => '1;33m',
        ],
    'space' =>
        [
            'symbol' => '-',
            'color' => '1;34m',
        ],
];

exec('tput cols', $cols);
$cols = $cols[0];

$callbackHelper = [
    'helper' => $helper,
    'cols' => $cols,
    'colors' => $colors,
    'bytes' => &$bytes,
    'bytesIterator' => &$bytesIterator,
    'seconds' => &$seconds,
    'speed' => &$speed,
];

$response = $helper->send()->to('http://ajax.deimos')
    ->file('filedata', __DIR__ . '/blank')
    ->data([
        'a' => [
            __LINE__,
            __LINE__,
            __LINE__ => [
                __LINE__,
            ]
        ]
    ])
    ->method('POST')
    ->progress(function(...$p) use ($callbackHelper)
    {
        if (++$callbackHelper['bytesIterator'] % 20 === 0 && $p[3])
        {
            if (time() - $callbackHelper['seconds'])
            {
                $callbackHelper['speed'] = $callbackHelper['helper']->str()->fileSize($p[4] - $callbackHelper['bytes'], 0);
            }

            echo "\033[3A";

            $percents = ($p[4] / $p[3]); // live hack :D

            echo floor($percents * 100 + .1)
                . '% (speed: ~'
                . $callbackHelper['speed']
                . '/s; size: '
                . $callbackHelper['helper']->str()->fileSize($p[3])
                . ')        ';

            echo "\033[3B";
            echo "\033[0G";

            // progress
            $progress = floor(($callbackHelper['cols'] - 2) * $percents + .1);
            echo "\033[" . $callbackHelper['colors']['bracket']['color'] . $callbackHelper['colors']['bracket']['beforeSymbol']; // before progress

            echo "\033[" . $callbackHelper['colors']['progress']['color'];
            $i = 0;
            while ($i < $progress)
            {
                echo $callbackHelper['colors']['progress']['symbol']; // before progress
                $i++;
            }

            echo "\033[" . $callbackHelper['colors']['space']['color'];
            while ($i < $callbackHelper['cols'] - 2)
            {
                echo $callbackHelper['colors']['space']['symbol']; // before progress
                $i++;
            }

            echo "\033[" . $callbackHelper['colors']['bracket']['color'] . $callbackHelper['colors']['bracket']['afterSymbol']; // after progress
            echo "\033[0G\033[0m";

            if (time()-$callbackHelper['seconds'])
            {
                $callbackHelper['bytes'] = $p[4];
                $callbackHelper['seconds'] = time();
            }
        }
    })
    ->exec();

echo PHP_EOL,'complete!' , PHP_EOL;

var_dump($response);
