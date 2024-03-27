<?php
// this /controllers/movement-create.php

use warehouse\Validator;

if ($_SESSION['user role'] != 'admin')
{
    abort();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    $fillable = ['flag','order_number','name','count'];
    $data = load($fillable);
    // dd($data,'$data');
    
    // validation
    $validator = new Validator();
    
    $validation = $validator->validate($data,
        [
            'flag' => [
                    'required' => true,
                    'min' => 1,
                    'max' => 2
                ],
            'order_number' => [
                    'min' => 1,
                    'max' => 4,
                    'numeric' => true,
                    'aboveZero' => true
                ],
            'name' => [
                    'required' => true,
                    'min' => 1,
                    'max' => 255,
                    'exists_in_DB' => true
                ],
            'count' => [
                    'required' => true,
                    'numeric' => true,
                    'aboveZero' => true
                ]
        ]);
    
    // v($validation->hasErrors(),'$validation->hasErrors()');
    
    if ($validation->hasErrors())
    { // true - errors is
        $_SESSION['error'] = 'DB Error';
        require VIEWS.'/movement-create.tpl.php';
        die;
    }


    if ($_POST['flag'] > 4)
    {
        $_POST['order_number'] = null;
    }

    
    
    // $sql = 'INSERT INTO `movements_temp1`(`id`,`order_number`, `delivery`, `count`, `id_delivery`, `event date`, `fastener`, `shipped`, `flag`, `verified`) 
    //                             VALUES (null,?,"",?,(SELECT `id_delivery` FROM `parity2` WHERE `not_main_title` = ?),CURDATE(),null,null,?,0)';
    // d($sql,'$sql');
    $sql = 'INSERT INTO `movements`(`id`,`order_number`, `delivery`, `count`, `id_delivery`, `event date`, `fastener`, `shipped`, `flag`, `verified`) 
                                VALUES (null,?,"",?,(SELECT `id_delivery` FROM `parity2` WHERE `not_main_title` = ?),CURDATE(),null,null,?,0)';

    $result = $db->query($sql,[$_POST['order_number'],$_POST['count'],$_POST['name'],$_POST['flag']]);
    
    
    if ($_POST['flag'] == 5)
        {
            $sql = 'UPDATE `accessories` SET `fact`=`fact` + ? WHERE `id` = (SELECT `id_delivery` FROM `parity2` WHERE `not_main_title` = ?)';    
        }
        else
        {
            $sql = 'UPDATE `accessories` SET `fact`=`fact` - ? WHERE `id` = (SELECT `id_delivery` FROM `parity2` WHERE `not_main_title` = ?)';
        }
    $result_fact_lower = $db->query($sql,[$_POST['count'],$_POST['name']])->rowCount();
    f($result_fact_lower,'$result_fact_lower');
    
    
    
    if ($result)
    {
        $_SESSION['success'] = 'OK';
        if ($data['flag'] == 1)
        {  // write in google sheet
            // $data['name'];
            $sql = 'SELECT `accessories`.`title 1C`, `accessories`.`name`, `accessories`.`ZnFe`, `accessories`.`code`  FROM `accessories` JOIN `parity2` ON `accessories`.`id` = `parity2`.`id_delivery` WHERE `parity2`.`not_main_title` = ?';
            $result = $db->query($sql,[$data['name']])->find();
            // d($result,'$result');
            $values[0] = [$data['order_number'],"",$result['ZnFe'],$result['title 1C'],$data['count'],$result['code'],"","","","","","not_verified"];
            // dd($values,'$values');
            require_once ROOT.'/googleapi_01_v1.php';
        }
        elseif ($data['flag'] == 2)
        {  // write separate
            f('dot 2');
            $sql = 'UPDATE `accessories` SET `separate in order`=`separate in order` + ? WHERE `id` = (SELECT `id_delivery` FROM `parity2` WHERE `not_main_title` = ?)';
            $result = $db->query($sql,[$_POST['count'],$_POST['name']]);
            fv($result,'$result_');
        }
    }
    else
    {
        $_SESSION['error'] = 'DB Error';
    }

    redirect(PATH.'/movement/create');
}
else
{   // if GET request
    $sql = 'SELECT en, '.$_SESSION['language'].' FROM languages WHERE controller IN (?,?,?)';
    $lang = $db->query($sql,['movement-create','header','flag'])->findAll(PDO::FETCH_KEY_PAIR);

    require VIEWS.'/movement-create.tpl.php';
}























die;