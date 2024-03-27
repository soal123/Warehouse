<?php


// $method = $_SERVER['REQUEST_METHOD'];
// if ($method == 'GET')
// {
//     abort();
// }
// else
// { // method POST
//     /*
//         telegram ip:
//         91.108.6.98
//     */
//     if ($_SERVER['REMOTE_ADDR'] != '91.108.6.98')
//     {
//         die;
//     }
// }






$temp = file_get_contents('php://input'); // gettype($temp) = string
$update = json_decode($temp, JSON_OBJECT_AS_ARRAY); // gettype($update) = array
// f($update,'$update');
// f($_SERVER,'$_SERVER');

if (isset($update['message']['chat']['id']))
{
    $chat_id = (int)$update['message']['chat']['id']; // integer
}
elseif (isset($update['user']['id']))
{
    $chat_id = (int)$update['user']['id'];
    require_once WWW.'/test/telegram-bot-3/bot.php';
    die;
}


if ($chat_id != 5515319718)
    {
        die;
    }


$str = mb_strtolower($update['message']['text']);
// f($str, 'str');

$test = preg_match('/^(джесси заказ )/', $str, $matches);
if ($test)
{
    require ROOT.'/parsing_01_v2.php';
    die;
}
// $test = preg_match('/^(джесси (показать|покажи) движение )/', $str, $matches);
$test = preg_match('/^(джесси движение )/', $str, $matches);
if ($test)
{
    require ROOT.'/parsing_02_v2.php';
    die;
}
$test = preg_match('/^(джесси (показать|покажи) заказ )/', $str, $matches);
if ($test)
{
    require ROOT.'/parsing_03_v1.php';
    die;
}
$test = preg_match('/^(джесси сбор )/', $str, $matches);
if ($test)
{
    require ROOT.'/parsing_04_v2.php';
    die;
}
$test = preg_match('/^(джесси (проверить|проверка))/', $str, $matches);
if ($test)
{
    require ROOT.'/parsing_05.php';
    die;
}
$test = preg_match('/^(джесси приход)/', $str, $matches);
if ($test)
{
    require ROOT.'/parsing_06.php';
    die;
}
$test = preg_match('/^(джесси поставить факт)/', $str, $matches);
if ($test)
{
    require ROOT.'/parsing_07.php';
    die;
}
$test = preg_match('/^(джесси сопоставить)/', $str, $matches);
if ($test)
{
    require ROOT.'/parsing_08.php';
    die;
}
$test = preg_match('/^(джесси крепеж)/', $str, $matches);
if ($test)
{
    telegrammMessage('dot 02',5515319718);
    require ROOT.'/parsing_09.php';
    die;
}
else
{
    require_once WWW.'/test/telegram-bot-3/bot.php';
}

telegrammMessage('command not found',$chat_id);
die;