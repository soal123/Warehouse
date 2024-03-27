<?php
/*
пример команды:
Джесси поставить факт шарнир М16 две штуки
*/
f('file: parsing_07.php');

$arr1 = ['штука', 'штуки', 'штук'];
$arr2 = ['шт', 'шт', 'шт'];
$str = str_replace($arr1, $arr2, $str);

$arr1 = ['один', 'одна', 'два', 'две', 'три', 'четыре', 'пять', 'шесть', 'восемь', 'семь', 'девять'];
$arr2 = ['1', '1', '2', '2', '3', '4', '5', '6', '8', '7', '9'];
$str = str_replace($arr1, $arr2, $str);


$temp = preg_match('/^(джесси поставить факт )(.*)$/', $str, $matches);
// f(__DIR__, '__DIR__');

f($str, 'str3');
f($temp, 'temp');
f(($matches), '(matches)');


if ($temp)
{
    // переменная для работы с google-api
    // $values = [];
    // переменная для вывода сообщения в телеграмм
    $message = 'поставлено:'.PHP_EOL;

    // удаляем часть строки, которая уже не нужна:
    $str = str_replace($matches[1], '', $str);
    f($str, 'str');



    $temp2 = mb_strpos($str, ' шт');
    f($temp2, 'temp2');
    while ($temp2)
        {
            // $str - это будет текущая строчка из которой постепенно будем удалять текст.
            // $number_order - номер заказа
            // $temp - содержит флаг соответствия шаблону [наименование]_[количество]_[штук]
            
            f($str, 'str');
            // f(mb_substr($str,0,($temp2+4)), 'вырезанное слово');
            $temp = preg_match('/^(.*) (\d{1,5}) шт/', mb_substr($str,0,($temp2+4)), $matches);
            f($temp, 'temp');
            if ($temp)
            {
                f(($matches), '(matches)');
                // $matches['1'] - содержит название
                // $matches['2'] - содержит количество
                
                $sql = "SELECT `accessories`.`name`, `parity2`.`id_delivery` FROM `parity2` JOIN `accessories` ON `parity2`.`id_delivery` = `accessories`.`id` WHERE `parity2`.`not_main_title` = ?";
                // f($sql, 'sql');
                $result = $db->query($sql, [$matches['1']])->findAll();

                if ($result !== [])
                {
                    f($result['0']['main_title'],'result[0][main_title]');
                    f($result[0], 'result[0]');
                    $name = $result['0']['name'];
                    $id_delivery = $result['0']['id_delivery'];
                    f($name, 'name');
                    // foreach ($result as $value)
                    // {
                    //     f($value, 'value');
                    // }
                }
                else
                {
                    f('пустой массив, файл parsing_07, в таблице сопоставления ничего не найдено.');
                    telegrammMessage('error. в таблице сопоставления ничего не найдено.',$chat_id);
                    die;
                }
                
                

                $message .= '"'.$name.'", кол-во: "'.$matches['2'].'" шт.'.PHP_EOL;
                f($message, 'message');



                
                $sql = "UPDATE `accessories` SET `initial count`=? WHERE `id`=?";
                // f($sql, 'sql');
                
                $result = $db->query($sql, [$matches['2'], $id_delivery])->findAll();
                if ($result == false)
                {
                    f('result = false');
                }
                else
                {
                    f('result не = false');
                }



                $str = mb_substr($str, ($temp2 + 4));
                f($str, 'str');
            }
            else
            {
                telegrammMessage('error. не соответствие шаблону [наименование]_[количество]_[штук]',$chat_id);
                die;
            }
            $temp2 = mb_strpos($str, ' шт');
            f($temp2, 'temp2');
            foreach ($values as $value)
            {
                f($value, 'value');    
            }
        }
    telegrammMessage($message,$chat_id);
}