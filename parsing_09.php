<?php
/*
пример команды:
Джесси крепеж в заказ 1200 собрано гайка а-в 647 шт
*/

$arr1 = ['штука', 'штуки', 'штук'];
$arr2 = ['шт', 'шт', 'шт'];
$str = str_replace($arr1, $arr2, $str);

$arr1 = ['одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'восемь', 'семь', 'девять'];
$arr2 = ['1', '2', '3', '4', '5', '6', '8', '7', '9'];
$str = str_replace($arr1, $arr2, $str);

$temp = preg_match('/^джесси крепеж в заказ (номер )?(\d{1,4}) собрано /', $str, $matches);
// f($str, 'str3');
// f($temp, 'temp');
// f(($matches), '(matches)');

if ($temp)
{
    // переменная для вывода сообщения в телеграмм
    $message = 'крепеж в заказ: '.$matches[2].PHP_EOL;

    $number_order = $matches[2];
    // удаляем часть строки, которая уже не нужна:
    $str = str_replace($matches[0], '', $str);
    f($str, 'str');

    $temp2 = mb_strpos($str, ' шт');
    f($temp2, 'temp2');
    while ($temp2)
        {
            // $str - это будет текущая строчка из которой постепенно будем удалять текст.
            // $number_order - номер заказа
            // $temp - содержит флаг соответствия шаблону [наименование]_[количество]_[штук]
            
            f($str, 'str');
            f(mb_substr($str,0,($temp2+4)), 'вырезанное слово');
            $temp = preg_match('/^(.*) (\d{1,4}) шт/', mb_substr($str,0,($temp2+4)), $matches);
            f($temp, 'temp');
            if ($temp)
            {
                f(($matches), '(matches)');
                // $matches['1'] - содержит название
                // $matches['2'] - содержит количество
                
                
                // $result = $db->query("SELECT * FROM parity WHERE `not_main_title` = '".$matches['1']."'");
                // $sql2 = "SELECT parity2.id_delivery FROM parity2 WHERE not_main_title = '".$matches['1']."'";
                $sql = "SELECT `accessories`.`name`, `parity2`.`id_delivery` FROM `parity2` JOIN `accessories` ON `parity2`.`id_delivery` = `accessories`.`id` WHERE `parity2`.`not_main_title` = ?";
                $result = $db->query($sql, [$matches['1']])->findAll();
                if ($result !== [])
                {
                    f($result['0']['name'],'result[0][name]');
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
                    f('пустой массив');
                    telegrammMessage('error. в таблице сопоставления ничего не найдено.',$chat_id);
                    die;
                }
                
                


                $message .= 'наименование: "'.$name.'", кол-во: "'.$matches['2'].'" шт.'.PHP_EOL;
                $sql = "INSERT INTO `movements` (`id`, `order_number`, `delivery`, `count`, `id_delivery`, `event date`, `fastener`) VALUES (NULL, ?, '', ?, ?, CURDATE(), 1)";
                $result = $db->query($sql, [$number_order, $matches['2'], $id_delivery]);
                if ($result === [])
                {
                    telegrammMessage('error.ошибка при вводе значения в БД.',$chat_id);
                    die;
                }

                $str = mb_substr($str, ($temp2 + 4));
                f($str, 'str');
            }
            else
            {
                telegrammMessage('error. не соответствие шаблону: [наименование]_[количество]_[штук]',$chat_id);
                die;
            }
            $temp2 = mb_strpos($str, ' шт');
            f($temp2, 'temp2');
        }
    telegrammMessage($message,$chat_id);
}