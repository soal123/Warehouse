<?php
/*
    mark orders(shipped/not shipped) by address: /orders
*/


// f($_POST);
$order = $_POST['order'];
$shipped = $_POST['shipped'];

$sql = 'SELECT * FROM `orders` WHERE `order number` = ?';
$result = $db->query($sql, [$order])->find();

// f($result, 'result');

if ($result === [])
{
    die;
}

if ($shipped == $result['order shipped'])
{
    $sql = 'UPDATE `orders` SET `order shipped`= ? WHERE `order number` = ?';
    $result = $db->query($sql, [(!$shipped), $order])->findAll();
    echo json_encode([$order, !$shipped]);
}
else
{
    f('info not matches');
}
