<?php

use warehouse\Db;
use warehouse\Router;

session_start();

define('ROOT',dirname(__DIR__));
define('WWW',ROOT.'/www');
define('CONFIG',ROOT.'/config');
define('CORE',ROOT.'/vendor/warehouse/core');
define('APP',ROOT.'/app');
define('CONTROLLERS',APP.'/controllers');
define('VIEWS',APP.'/views');
define('PATH','https://www.u160427.test-handyhost.ru');

require_once ROOT.'/vendor/autoload.php';
require_once CORE.'/functions.php';
// require_once WWW.'/bootstrap.php'; // test, not use.

$db_config = require CONFIG.'/config.php';
$db = (Db::getInstance())->getConnection($db_config);

// f($_SERVER,'$_SERVER');

$router = new Router();
require_once CONFIG.'/routes.php';


if (!isset($_SESSION['user role']))
{
    $_SESSION['user role'] = 'guest';
}
if (!isset($_SESSION['language']))
{
    $_SESSION['language'] = 'en';
}

$router->match();