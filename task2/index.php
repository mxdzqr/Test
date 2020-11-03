<?

$dir = 'feedback';

if (!is_dir($dir))
    mkdir($dir);

file_put_contents(  $dir . '/' . uniqid() . '.txt', json_encode($_POST));


