<?php

$data = json_decode(file_get_contents('php://input'),true);

if (isset($data['search']))
{
    $search = trim($data['search']);
    $sql = "SELECT `id`, `name`, `initial count`, `sort`, `current count`, `separate in order`, `fact`, `count_1c`, `place` FROM `accessories` WHERE name LIKE ? ORDER BY `sort` ASC";
    // d($sql,'$sql');
    $result = $db->query($sql,["%{$search}%"])->findAll();
    
    // d($result,'$result');
    // die;
    
    require_once VIEWS.'/ajax/search.tpl.php';
    die;
}




fv($data,'$data');

echo 'данные получены.';




die;

