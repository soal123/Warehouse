<?php

if ($_SESSION['user role'] == 'admin')
{
    abort();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $password = $_POST['password'];
    $login = $_POST['login'];
    
    $sql = 'SELECT * FROM users WHERE login = ?';
    $result = $db->query($sql, [$login])->find();
    
    if ($result === [])
    {
        $_SESSION = [
            'user role' => 'guest',
            'error' => 'Wrong login or password'
            ];
        header('Location: '.PATH);
    }
    elseif (!password_verify($password, $result['password']))
    {
        $_SESSION = [
            'user role' => 'guest',
            'error' => 'Wrong login or password'
            ];
        header('Location: '.PATH);
    }
    elseif (password_verify($password, $result['password']))
    {
        $_SESSION = [
            'user role' => 'admin',
            'success' => 'Successful login'
            ];
        header('Location: '.PATH);
    }

}
else
{
    $sql = 'SELECT en, '.$_SESSION['language'].' FROM languages WHERE controller = ? OR controller = ?';
    $lang = $db->query($sql,['login','header'])->findAll(PDO::FETCH_KEY_PAIR);

    require VIEWS.'/login.tpl.php';
}

die;