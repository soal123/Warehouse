<?php
/*константы нужны чтобы ими пользоваться в функциях!*/
const TOKEN = '';
const BASE_URL = 'https://api.telegram.org/bot' . TOKEN . '/';

error_reporting(-1);
ini_set('display_errors',0);
ini_set('log_errors','on');
ini_set('error_log',ROOT.'/errors.log');


function d($x, $str = '')
{
    echo '<pre>';
    if ($str)
    {
        // echo '<span style="background-color: #FF7F50; color: #0000FF;">'.PHP_EOL.$str.'</span> = ';
        // echo '<span style="background-color: #DFFF00; color: #0000FF;">'.PHP_EOL.$str.'</span> = ';
        echo '<span style="background-color: #FFBF00; color: #000080;">'.PHP_EOL.' '.$str.' </span> = ';
    }
    print_r($x);
    echo '</pre>';
}


function dd($x, $str = '')
{
    d($x, $str);
    die;
}

function f($x, $str = '')
{
    $output = PHP_EOL;
    if ($str)
    {
        $output .= $str.' = ';
    }
    $output .= print_r($x, true);
    file_put_contents((ROOT.'/log.txt'), ($output), FILE_APPEND);
}

function fv($x, $str = '')
{
    ob_start();
    echo PHP_EOL;
    if ($str)
        {
            echo $str.' = ';
        }
    var_dump($x);
    file_put_contents((ROOT.'/log.txt'), (ob_get_clean()), FILE_APPEND);
}

function fd($x, $str = '')
{
    f($x,$str);
    die;
}

function fvd($x, $str = '')
{
    fv($x,$str);
    die;
}

function v($x, $str = '')
{
    echo '<pre>';
    if ($str)
    {
        // echo '<span style="background-color: #FF7F50; color: #0000FF;">'.PHP_EOL.$str.'</span> = ';
        echo '<span style="background-color: #FFBF00; color: #000080;">'.PHP_EOL.$str.'</span> = ';
    }
    var_dump($x);
    echo '</pre>';
}

function vd($x, $str = '')
{
    v($x, $str);
    die;
}



function abort($error = 404)
{
    http_response_code($error);
    require VIEWS.'/errors/'.$error.'.tpl.php';
    die;
}


/*
its function will take away extra fields.
*/
function load($fillable = [])
{
    $data = [];
    foreach ($_POST as $key => $value)
    {
        if (in_array($key, $fillable))
        {
            $data[$key] = trim($value);
        }
    }
    return $data;
}


/*
    accepts name some field and check availability this field in array.
*/
function old($fieldname)
{
    return isset($_POST[$fieldname]) ? h($_POST[$fieldname]) : '';
}


/*
    replace special chars their essences
*/
function h($str)
{
    return htmlspecialchars($str,ENT_QUOTES);
}


/*
    redirect
*/
function redirect($url = '')
{
    if ($url)
        {
            $redirect = $url;
        }
        else
        {
            $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
        }
    header('Location: '.$redirect);
    die;
}


/*

*/
function get_alerts()
{
    if (!empty($_SESSION['success']))
    {
        require_once VIEWS.'/incs/alert_success.php';
        unset($_SESSION['success']);
    }
    if (!empty($_SESSION['error']))
    {
        require_once VIEWS.'/incs/alert_error.php';
        unset($_SESSION['error']);
    }
}





function sendRequest($method, $params = [])
{
	if (!empty($params))
    	{
    		$url = BASE_URL . $method . '?' . http_build_query($params);
    	}
    	else
    	{
    		$url = BASE_URL . $method;
    	}
	return json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);
}


function telegrammMessage($str, $chat_id = 5515319718)
{
    // $chat_id = $update['message']['chat']['id'];
// 	sendRequest('sendMessage', ['chat_id' => 5515319718, 'text' => $str]);
	
	if ($chat_id != 5515319718)
	{// send not me:
	    sendRequest('sendMessage', ['chat_id' => $chat_id, 'text' => $str]);
	    sendRequest('sendMessage', ['chat_id' => 5515319718, 'text' => 'отправлено с чат id: '.(string)$chat_id.PHP_EOL.$str]);
	}
	else
	{// send me:
	    sendRequest('sendMessage', ['chat_id' => $chat_id, 'text' => $str]);
	}
}


function check_chat_id(int $chat_id):bool
{
    global $db;
    
    $sql = 'SELECT COUNT(*) FROM telegram_subscribers WHERE `chat_id` = ?';
    return (bool)$db->query($sql,[$chat_id])->getColumn();
}


function add_subscriber(int $chat_id,array $data):bool
{
    global $db;
    
    $sql = 'INSERT INTO telegram_subscribers (chat_id, name, email) VALUES (?, ?, ?)';
    return (bool)$db->query($sql,[$chat_id, $data['name'], $data['email']]);
}


function delete_subscriber(int $chat_id):bool
{
    global $db;
    
    $sql = 'DELETE FROM telegram_subscribers WHERE chat_id = ?';
    return (bool)$db->query($sql,[$chat_id]);
}


function get_products(int $start, int $per_page):array
{
    global $db;
    $sql = 'SELECT * FROM telegram_products LIMIT '.$start.', '.$per_page;
    return $db->query($sql)->findAll();
}


function get_start(int $page, int $per_page):int
{
    return ($page-1)*$per_page;
}






