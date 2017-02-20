<?php

include_once __DIR__ . '/../vendor/autoload.php';

$builder = new \Deimos\Builder\Builder();
$helper  = new \Deimos\Helper\Helper($builder);

$bytes = 0;
$bytesIterator = 0;
$seconds = time();
$speed = 0;

echo 'Send file test' , PHP_EOL , PHP_EOL , PHP_EOL , 'in progress...' , PHP_EOL;

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
    ->progress(function(...$p) use ($helper, &$bytes, &$bytesIterator, &$seconds, &$speed) // oh my eyes
    {
        if (++$bytesIterator % 20 === 0 && $p[3])
        {
            if (time() - $seconds)
            {
                $speed = $helper->str()->fileSize($p[4] - $bytes, 0);
            }

            echo "\033[2A";

            echo ceil($p[4] / $p[3] * 100)
                . '% (speed: ~'
                . $speed
                . '/s; size: '
                . $helper->str()->fileSize($p[3])
                . ')        ';

            echo "\033[2B";
            echo "\033[0G";

            if (time()-$seconds)
            {
                $bytes = $p[4];
                $seconds = time();
            }
        }
    })
    ->exec();

echo PHP_EOL,'complete!' , PHP_EOL;

var_dump($response);
