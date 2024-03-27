<?php
// this controllers/order.php

$id=$_GET['id'];

// language
$sql = 'SELECT `key array`, '.$_SESSION['language'].' FROM languages WHERE controller IN (?, ?, ?)';
$lang = $db->query($sql,['order','header','flag'])->findAll(PDO::FETCH_KEY_PAIR);

// 
$sql = 'SELECT `movements`.`id`, `movements`.`event date`, `accessories`.`name`, `movements`.`count`, `movements`.`flag`, `movements`.`verified`, `movements`.`id_delivery` FROM `movements` JOIN `accessories` ON `movements`.`id_delivery` = `accessories`.`id` WHERE `movements`.`order_number` = ? ORDER BY `movements`.`id` DESC';
$result = $db->query($sql,[$id])->findAll();


// v($result,'$result');

if ($result === [])
{
    // $sql = "SELECT `accessories`.`id`, `accessories`.`name`, `accessories`.`initial count` FROM `accessories` WHERE `accessories`.`id` = (SELECT `parity2`.`id_delivery` FROM `parity2` WHERE not_main_title = ?)";
    // $result = $db->query($sql,[$id])->fetchAll();
    // echo 'перемещений не найдено';
    abort();
}

$str_flag = [
    '1' => $lang['in work'],
    '2' => $lang['separate'],
    '3' => $lang['fastener'],
    '4' => $lang['movement'],
    '5' => $lang['arrival'],
    '6' => $lang['needs production'],
    '7' => $lang['needs store'],
    '8' => $lang['needs office']
];



if ($_SESSION['user role'] == 'admin')
{
    require VIEWS.'/one.order.admin.tpl.php';
}
else
{
    require VIEWS.'/one.order.tpl.php';
}
die;