<?php
/*
    все уже приходит в нижнем регистре.
    примерная надпись:
        Джесси показать движение шарнир М16
*/

// $temp = preg_match('/^джесси (показать|покажи) движение (.*)$/', $str, $matches);
$temp = preg_match('/^джесси движение (.*)$/', $str, $matches);

// f($str, 'str');
// f($temp, 'temp');
// f(($matches), '(matches)');
if ($temp)
    {
        
        // $sql = "SELECT accessories.name, parity2.id_delivery FROM parity2 JOIN accessories ON parity2.id_delivery = accessories.id WHERE parity2.not_main_title = '".$matches['1']."'";
        $sql = "SELECT movements.order_number, accessories.id, accessories.name, movements.count, `accessories`.`initial count` FROM accessories JOIN movements ON accessories.id = movements.id_delivery WHERE id_delivery = (SELECT id_delivery FROM parity2 WHERE not_main_title = ?)";      
        
        $result = $db->query($sql, [$matches['1']])->findAll();
        if ($result === [])
        {
            telegrammMessage('error.в таблице сопоставления ничего не найдено либо нету перемещений.',$chat_id);
            die;
        }
        $message = 'Движение позиции:'.PHP_EOL.'"'.$result[0]['name'].'"'.PHP_EOL.'начальное значение: '.$result[0]['initial count'].PHP_EOL;
        $message .= 'заказ | кол-во'.PHP_EOL;
        $message .= '╟────┼────╢'.PHP_EOL;
        
        // ff($result[0]['count_fact'], 'result_count_fact');
        // ff(gettype($result[0]['count_fact']), 'gettype(result_count_fact)');

        // foreach ($result as $temp_key => $temp_value)
        // {
        //     f($temp_key, 'temp_key');
        //     f($temp_value, 'temp_value');
        // }
        // $result = $db->query("SELECT * FROM movements WHERE delivery = '".$matches['2']."'")->fetchAll();
        $count = (int)$result[0]['initial count'];
        foreach ($result as $key => $value)
            {
                if ($value['order_number'] === 'Приход')
                    {
                        $count += (int)$value['count'];
                    }
                    else
                    {
                        $count -= (int)$value['count'];
                    }
                f($value, 'value');
                // $message .= $value['order_number'].'   '.$value['name'].'   '.$value['count'].' шт.'.PHP_EOL;
                $message .= '║░'.$value['order_number'].'│'.$value['count'].' шт.║'.PHP_EOL;
            }
        $message .= '╟────┼────╢'.PHP_EOL;
        $message .= 'конечное значение: '.(string)$count;
        
        telegrammMessage($message,$chat_id);
        
        $sql = "UPDATE `accessories` SET `current count`=? WHERE `id`=?";
        $result = $db->query($sql, [$count, $result[0]['id']]);
        f($result, 'result');
    }