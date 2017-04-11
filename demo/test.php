<?php

include_once __DIR__ . '/../vendor/autoload.php';

$helper  = new \Deimos\Helper\Helper();

var_dump($helper->arr()->get([
    'name' => 'Max'
], 'name'));
