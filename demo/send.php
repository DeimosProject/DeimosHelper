<?php

include_once __DIR__ . '/../vendor/autoload.php';

$builder = new \Deimos\Builder\Builder();
$helper  = new \Deimos\Helper\Helper($builder);

$response = $helper->send()->to('http://ajax.deimos')
    ->file('filedata', dirname(__DIR__) . '/tests/Tests/files/640_v2.jpg')
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
    ->exec();

var_dump($response);
