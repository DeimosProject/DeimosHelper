<form method="post" enctype="multipart/form-data">

    <input type="file" name="file[]" multiple/>

    <button type="submit">send form</button>

</form>

<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    $helper = new \Deimos\Helper\Helper(new \Deimos\Builder\Builder());

    $file = $helper->uploads()->simple('file');

    $file->save($file->name());

}
