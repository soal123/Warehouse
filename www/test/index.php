<?php

require '../../core/functions.php';

// require_once 'app/A.php';
// require_once 'classes/A.php';

spl_autoload_register(function($class)
{
    $filename = $class.'.php';
    $filename = str_replace('\\',DIRECTORY_SEPARATOR,$filename);
    v($filename,'$filename');
    require_once $filename;
});


new app\A();
new classes\A();










