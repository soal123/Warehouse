<?php
die;
require 'core/functions.php';


// file_put_contents(__DIR__ . '/log.txt', file_get_contents('php://input'));

    require 'classes/Db.php';

    $db_config = require 'config.php';
    $db = new Db($db_config);
    // $posts = $db->query("SELECT * FROM metall")->fetchAll();
    // $posts = $db->query("UPDATE `u160427_metall`.`metall` SET `quantity` = '15' WHERE `metall`.`id` = 1");



/*
php://input :
нам посылает телеграмм запрос методом пост, но не привычным вам методом пост, когда есть ключи и значения,
а просто в теле запроса некий json содержится, в php есть специальный поток, или проще говоря дескриптор файловый php://input
для того чтобы целиком прочитать тело пост запроса
я использую это имя как бы файла php://input для того чтобы прочитать post запрос в его сыром виде, ни как в супер глобальном 
массиве post разложенный по ключам и значениям а весь целиком, затем делаю json_decode как вы видите и получают вот этот вот $update.
*/

// ff($_POST, 'post');
// ff($_GET, 'get');
// ff($_SERVER, 'server');
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    ff('method get');
    require 'index_2.php';
    die;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    ff('method post');
}

$temp = file_get_contents('php://input'); // gettype($temp) = string

$update = json_decode($temp, JSON_OBJECT_AS_ARRAY); // gettype($update) = array
// ff($update, 'update');
// ff($update['message']['chat']['id'], 'update[message][chat][id]');
$chat_id = $update['message']['chat']['id']; // integer
if ($chat_id != 5515319718)
    {
        
        die;
    }
ff($temp, 'temp');



// Пишем содержимое в файл
// file_put_contents('log1.txt', (PHP_EOL . '111_type posts =' . gettype($temp)), FILE_APPEND);
// file_put_contents('log1.txt', (PHP_EOL . $temp), FILE_APPEND);
// ff($temp);
// ff('privet');


$str = mb_strtolower($update['message']['text']);
// ff($str, 'str');
$test = preg_match('/^(джесси заказ )/', $str, $matches);
if ($test)
{
    require 'parsing_01_v2.php';
    die;
}
// $test = preg_match('/^(джесси (показать|покажи) движение )/', $str, $matches);
$test = preg_match('/^(джесси движение )/', $str, $matches);
if ($test)
{
    require 'parsing_02_v2.php';
    die;
}
$test = preg_match('/^(джесси (показать|покажи) заказ )/', $str, $matches);
if ($test)
{
    require 'parsing_03_v1.php';
    die;
}
$test = preg_match('/^(джесси сбор )/', $str, $matches);
if ($test)
{
    require 'parsing_04_v2.php';
    die;
}
$test = preg_match('/^(джесси (проверить|проверка))/', $str, $matches);
if ($test)
{
    require 'parsing_05.php';
    die;
}
$test = preg_match('/^(джесси приход)/', $str, $matches);
if ($test)
{
    require 'parsing_06.php';
    die;
}
$test = preg_match('/^(джесси поставить факт)/', $str, $matches);
if ($test)
{
    require 'parsing_07.php';
    die;
}
$test = preg_match('/^(джесси сопоставить)/', $str, $matches);
if ($test)
{
    require 'parsing_08.php';
    die;
}
$test = preg_match('/^(джесси крепеж)/', $str, $matches);
if ($test)
{
    require 'parsing_09.php';
    die;
}
telegrammMessage('command not found',$chat_id);
die;