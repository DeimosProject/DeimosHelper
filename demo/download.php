<?php

include_once __DIR__ . '/../vendor/autoload.php';

$helper = new \Deimos\Helper\Helper();

$name = $helper->str()->translit('MVC Example Администрирование локальных сетей.zip');

var_dump($helper->stream()->download(
    'https://fktpm.ru/get_file/0My03',
    $name
));

register_shutdown_function('unlink', $name);