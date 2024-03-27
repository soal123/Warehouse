<?php

// language
$sql = 'SELECT en, '.$_SESSION['language'].' FROM languages WHERE controller = ? OR controller = ?';
$lang = $db->query($sql,['orders','header'])->findAll(PDO::FETCH_KEY_PAIR);

$sql = 'SELECT * FROM `orders` ORDER BY `id` DESC';
$result = $db->query($sql)->findAll();


if ($_SESSION['user role'] == 'admin')
{
    require VIEWS.'/orders.admin.tpl.php';
}
else
{
    require VIEWS.'/orders.tpl.php';
}
die;