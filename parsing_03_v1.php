<?php
/*
    все уже приходит в нижнем регистре.
    примерная надпись:
        Джесси показать заказ (номер) \d
*/

$arr1 = ['один', 'два', 'три', 'четыре', 'пять', 'шесть', 'восемь', 'семь', 'девять'];
$arr2 = ['1', '2', '3', '4', '5', '6', '8', '7', '9'];
$str = str_replace($arr1, $arr2, $str);


$temp = preg_match('/^джесси (показать|покажи) заказ (номер )?(.*)$/', $str, $matches);
// f($str, 'str');
// f($temp, 'temp');
// f(($matches), '(matches)');


if ($temp)
    {
        $message = 'заказ: '.$matches['3'].PHP_EOL;
        $message .= 'кол-во | наименование'.PHP_EOL;
        $message .= '╟────┼────╢'.PHP_EOL;
        
        
        $sql = "SELECT movements.order_number, accessories.name, movements.count FROM movements JOIN accessories ON movements.id_delivery = accessories.id WHERE movements.order_number = ?";
        
        $result = $db->query($sql, [$matches['3']])->findAll();
        
        
        
        if ($result === [])
        {
            telegrammMessage('error.в таблице сопоставления ничего не найдено.',$chat_id);
            die;
        }
        foreach ($result as $key => $value)
            {
                $message .= $value['count'].'   '.$value['name'].PHP_EOL;
            }
        telegrammMessage($message,$chat_id);
    }