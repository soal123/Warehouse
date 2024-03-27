<?php

// use warehouse\Db;

// $db_config = require CONFIG.'/config.php';
// $db = (Db::getInstance())->getConnection($db_config);

// $_SESSION['language'] = 'ru';
$sql = 'SELECT `key array`, '.$_SESSION['language'].' FROM languages WHERE controller IN (?,?)';
$lang = $db->query($sql,['main','header'])->findAll(PDO::FETCH_KEY_PAIR);


$sql = "SELECT `id`, `name`, `initial count`, `sort`, `current count`, `separate in order`, `fact`, `count_1c`, `place` FROM `accessories` ORDER BY `sort` ASC";
$result = $db->query($sql)->findAll();


require_once VIEWS.'/main.tpl.php';
die;