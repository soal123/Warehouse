<?php
/*
пример команды:
Джесси заказ 15 выдано шарнир М16 две штуки
*/
f('file: parsing_01_v2.php');

$arr1 = ['штука', 'штуки', 'штук'];
$arr2 = ['шт', 'шт', 'шт'];
$str = str_replace($arr1, $arr2, $str);

$arr1 = ['один', 'одна', 'два', 'две', 'три', 'четыре', 'пять', 'шесть', 'восемь', 'семь', 'девять'];
$arr2 = ['1', '1', '2', '2', '3', '4', '5', '6', '8', '7', '9'];
$str = str_replace($arr1, $arr2, $str);

$temp = preg_match('/^джесси заказ (номер )?(\d{1,4}) выдан(а|о) /', $str, $matches);
f($str, 'str3');
f($temp, 'temp');
f(($matches), '(matches)');
f('dot 101');

if ($temp)
{
    // переменная для работы с google-api
    $values = [];
    // переменная для вывода сообщения в телеграмм
    $message = 'заказ: '.$matches[2].', внесено:'.PHP_EOL;
    
    $number_order = $matches[2];
    // удаляем часть строки, которая уже не нужна:
    $str = str_replace($matches[0], '', $str);
    // f($str, 'str');

    $temp2 = mb_strpos($str, ' шт');
    f($temp2, 'temp2');
    while ($temp2)
        {
            // $str - это будет текущая строчка из которой постепенно будем удалять текст.
            // $number_order - номер заказа
            // $temp - содержит флаг соответствия шаблону [наименование]_[количество]_[штук]
            
            f($str, 'str');
            // f(mb_substr($str,0,($temp2+4)), 'вырезанное слово');
            $temp = preg_match('/^(.*) (\d{1,4}) шт/', mb_substr($str,0,($temp2+4)), $matches);
            f($temp, 'temp');
            if ($temp)
            {
                f(($matches), '(matches)');
                // $matches['1'] - содержит название
                // $matches['2'] - содержит количество
                

                // $result = $db->query("SELECT id_delivery FROM parity WHERE not_main_title = '".$matches['1']."'")->fetchAll();
                // $sql2 = "SELECT parity2.id_delivery FROM parity2 WHERE not_main_title = '".$matches['1']."'";
                $sql = "SELECT `accessories`.`ZnFe`, `accessories`.`name`, `parity2`.`id_delivery` FROM `parity2` JOIN `accessories` ON `parity2`.`id_delivery` = `accessories`.`id` WHERE `parity2`.`not_main_title` = ?";
                // f($sql, 'sql');

                $result = $db->query($sql, [$matches['1']])->findAll();
                // $result = $db->query("SELECT * FROM parity WHERE not_main_title = '".$matches['1']."'")->fetchAll();
                if ($result !== [])
                {
                    f($result['0']['main_title'],'result[0][main_title]');
                    f($result[0], 'result[0]');
                    $name = $result['0']['name'];
                    $znfe = $result['0']['ZnFe'];
                    $id_delivery = $result['0']['id_delivery'];
                    f($name, 'name');
                }
                else
                {
                    telegrammMessage('error. в таблице сопоставления ничего не найдено.',$chat_id);
                    die;
                }
                
                

                $message .= '"'.$name.'", кол-во: "'.$matches['2'].'" шт.'.PHP_EOL;
                f($message, 'message');
                $sql = "INSERT INTO `movements` (`id`, `order_number`, `delivery`, `count`, `id_delivery`, `event date`, `fastener`) VALUES (NULL, ?, '', ?, ?, CURDATE(), NULL)";
                f($sql, 'sql');

                // $result = $db->query("INSERT INTO movements (id, order_number, delivery, count, id_delivery) VALUES (NULL, '".$number_order."', '', ".$matches['2'].", ".$id_delivery.")",[]); // work option
                $result = $db->query($sql, [$number_order, $matches['2'], $id_delivery]);

                // добавление информации в таблицу google
                // подготавливаем массив с данными для ввода:
                // (надо накидать value, а потому запустить googleapi)
                $values[] = [$number_order,"",$znfe,$name,$matches['2'],"","","","","","","not_verified"];

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
        }
        
    // f('performance telegramm message');
    // отправка сообщения в телеграмм:
    telegrammMessage($message,$chat_id);
    // f('after telegramm message');
    // telegrammMessage('сообщение от телеграмма',$chat_id);

    // запись значения в гугл-таблицу:
    // require_once 'googleapi_01.php';
    require_once 'googleapi_01_v1.php';
    
    f($str, 'str4');
}

f($str, 'str5');
