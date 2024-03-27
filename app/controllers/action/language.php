<?php

$temp = file_get_contents('php://input'); // gettype($temp) = string
$update = json_decode($temp, JSON_OBJECT_AS_ARRAY); // gettype($update) = array
f($temp,'$temp');
f($update,'$update');

f($_POST,'language, $_POST');
f($_SERVER,'$_SERVER');

if ($_SESSION['language'] == 'en')
{
    $_SESSION['language'] = 'ru';
}
else
{
    $_SESSION['language'] = 'en';
}






