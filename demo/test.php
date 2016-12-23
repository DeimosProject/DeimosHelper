<?php

include_once __DIR__ . '/../vendor/autoload.php';

$builder = new \Deimos\Builder\Builder();
$helper  = new \Deimos\Helper\Helper($builder);

var_dump($helper->arr()->get([
    'name' => 'Max'
], 'name'));