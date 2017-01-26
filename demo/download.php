<?php

include_once __DIR__ . '/../vendor/autoload.php';

$builder = new \Deimos\Builder\Builder();
$helper  = new \Deimos\Helper\Helper($builder);

var_dump($helper->stream()->download(
    'https://fktpm.ru/get_file/0My03',
    $helper->str()->translit('MVC Example Администрирование локальных сетей.zip')
));