<?php
/*
    mark movement(verified/not verified) by address: /movements and /order?id=*
*/
// fv($_POST,'$_POST');
$id = (int)$_POST['id']; // this id movement
$verified = $_POST['verified'];
$item_id = (int)$_POST['item_id'];
// fv($verified,'$verified');

$sql = 'SELECT * FROM `movements` WHERE `id` = ?';
$result = $db->query($sql, [$id])->find();
// fv($result,'$result');

if ($result === false)
{
    echo json_encode(false);
    die;
}

if ($verified === $result['verified'])
{
    $sql = 'UPDATE `movements` SET `verified`= ? WHERE `id` = ?';
    // f($sql,'$sql');
    $result_2 = $db->query($sql, [!$verified, $id])->find();
    // fv($result_2,'$result_2');
    
    if (($result['flag'] == 2) && ($result['verified'] == 0))
    {  // separate and verified
        // f('dot 0');
        // f($result['count'],'$result[count]');
        // f($item_id,'$item_id');
        $sql = 'UPDATE `accessories` SET `separate in order`=`separate in order`-? WHERE `id`=?';
        $result_2 = $db->query($sql, [$result['count'], $item_id]);
        // fv($result_2,'$result_2');
    }
    elseif (($result['flag'] == 2) && ($result['verified'] == 1))
    {
        // f('dot 1');
        // f($result['count'],'$result[count]');
        // f($item_id,'$item_id');
        $sql = 'UPDATE `accessories` SET `separate in order`=`separate in order`+? WHERE `id`=?';
        $result_2 = $db->query($sql, [$result['count'], $item_id]);
        // fv($result_2,'$result_2');
    }
    
    echo json_encode([$id, !$verified]);
}
else
{
    echo json_encode(false);
    // f('info not matches');
}
die;