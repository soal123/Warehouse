<?php
// this /controllers/item.php

// use warehouse\Pagination;

$id=(int)$_GET['id'];

// // start class Pagination:
// $page = $_GET['page'] ?? 1;
// $per_page = 11;
// $total = (int)($db->query('SELECT COUNT(*) FROM `movements` WHERE `id_delivery` = ?',[$id])->getColumn());
// $pagination = new Pagination((int)$page, $per_page, $total);
// $start = $pagination->getStart();
// // end class Pagination.

// language
$sql = 'SELECT `key array`, '.$_SESSION['language'].' FROM languages WHERE controller IN (?,?,?)';
$lang = $db->query($sql,['item','header','flag'])->findAll(PDO::FETCH_KEY_PAIR);


// data from db 'accessories'
$sql = 'SELECT `code`, `ZnFe`, `name`, `title 1C`, `initial count`, `fact`, `count_1c`, `separate in order`, `place` FROM `accessories` WHERE `id` = ?';
$item_data = $db->query($sql,[$id])->find();
// d($item_data,'$item_data');

// $sql = "SELECT `movements`.`order_number`, `movements`.`event date`, `movements`.`flag`, `accessories`.`id`, accessories.name, movements.count, `accessories`.`initial count` FROM accessories JOIN movements ON accessories.id = movements.id_delivery WHERE id_delivery = (SELECT id_delivery FROM parity2 WHERE not_main_title = ?)";
$sql = 'SELECT `movements`.`id`, `movements`.`event date`, `movements`.`order_number`, `accessories`.`name`, `movements`.`count`, `movements`.`flag`, `movements`.`verified`, `accessories`.`initial count` FROM `movements` JOIN `accessories` ON `movements`.`id_delivery` = `accessories`.`id` WHERE `movements`.`id_delivery` = ? ORDER BY `movements`.`id` DESC';
$result = $db->query($sql,[$id])->findAll();
// d($result,'$result');

if ($result === [])
{
    $sql = "SELECT `accessories`.`id`, `accessories`.`name`, `accessories`.`initial count` FROM `accessories` WHERE `accessories`.`id` = ?";
    $result2 = $db->query($sql,[$id])->findAll();
    // echo 'перемещений не найдено';
}


$count = isset($result[0]['initial count']) ? $result[0]['initial count'] : 0;



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

// d($lang,'$lang');
// dd($str_flag,'$str_flag');


if ($_SESSION['user role'] == 'admin')
{
    require VIEWS.'/item.admin.tpl.php';
}
else
{
    require VIEWS.'/item.tpl.php';
}


$sql = "UPDATE `accessories` SET `current count`= ? WHERE `id` = ?";
$result2 = $db->query($sql,[$count, $id])->findAll();

die;