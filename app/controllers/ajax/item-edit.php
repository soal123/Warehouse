<?php
/*
    edit field fact in /item
*/



if ($_POST['field'] == 'fact')
{
    if ($_POST['value'] >= 0)
    {
        $sql = 'UPDATE `accessories` SET `fact`= ? WHERE `id` = ?';
        $result = $db->query($sql, [$_POST['value'], $_POST['id']])->rowCount();
        if ($result)
            {
                echo json_encode('ok');    
            }
            else
            {
                echo json_encode('false');    
            }
    }
    else
    {
        echo json_encode('false');    
    }
}
elseif ($_POST['field'] == 'place')
{
    if (mb_strlen($_POST['value']) < 50)
    {
        $sql = 'UPDATE `accessories` SET `place`= ? WHERE `id` = ?';
        $result = $db->query($sql, [$_POST['value'], $_POST['id']])->rowCount();
        if ($result)
            {
                echo json_encode('ok');    
            }
            else
            {
                echo json_encode('false');    
            }
    }
    else
    {
        echo json_encode('false');    
    }
}
else
{
    echo json_encode('false');    
}



die;