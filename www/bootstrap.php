<?php

$container = new \warehouse\ServiceContainer();
$container->setService('\warehouse\Db',function()
{
    $db_config = require CONFIG.'/config.php';
    return (\warehouse\Db::getInstance())->getConnection($db_config);
});

\warehouse\App::setContainer($container);