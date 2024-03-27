<?php

use warehouse\Pagination;

// start class Pagination:
$page = $_GET['page'] ?? 1;
$per_page = 12;
$total = (int)($db->query('SELECT COUNT(*) FROM `movements`')->getColumn());
$pagination = new Pagination((int)$page, $per_page, $total);
$start = $pagination->getStart();
// end class Pagination.

// language
$sql = 'SELECT `key array`, '.$_SESSION['language'].' FROM languages WHERE controller IN (?,?,?)';
$lang = $db->query($sql,['movements','header','flag'])->findAll(PDO::FETCH_KEY_PAIR);

$sql = 'SELECT `movements`.`id`, `movements`.`order_number`, `accessories`.`name`, `movements`.`count`, `movements`.`event date`, `movements`.`flag`, `movements`.`verified`, `movements`.`id_delivery` FROM `movements` JOIN `accessories` ON `movements`.`id_delivery` = `accessories`.`id` ORDER BY `movements`.`id` DESC LIMIT '.$start.', '.$per_page;
$result = $db->query($sql)->findAll();


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

// d($_SESSION);
if ($_SESSION['user role'] == 'admin')
{
    require VIEWS.'/movements.admin.tpl.php';
}
else
{
    require VIEWS.'/movements.tpl.php';
}
die;