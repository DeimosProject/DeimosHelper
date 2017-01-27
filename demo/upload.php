<form method="post" enctype="multipart/form-data">

    <input type="file" name="file[]" multiple/>

    <button type="submit">send form</button>

</form>

<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    $helper = new \Deimos\Helper\Helper(new \Deimos\Builder\Builder());

    $files = $helper->uploads()->get('file');

    var_dump($files);

    $uploads = $helper->uploads();

    var_dump($uploads);

}
