<?php
/*
    add order in table by address: /orders
*/

$sql = 'SELECT `order number` FROM `orders` WHERE `id` = (SELECT MAX(`id`) FROM `orders`)';
$result = $db->query($sql)->find();
// fv($result,'$result');
if ($result !== false)
{
    $order_number = $result['order number'] + 1;
    $sql = 'INSERT INTO `orders`(`id`, `order number`, `order shipped`) VALUES (null,?,0)';
    $result = $db->query($sql,[$order_number]);
}
if ($result !== false)
{
    echo json_encode($order_number);
}



die;