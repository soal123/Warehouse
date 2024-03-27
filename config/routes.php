<?php

$router->get('','main.php');
// $router->post('','telegram.php');
$router->post('fromJessica','telegram.php');

$router->get('fromTelegramApp','telegram/app-main.php');
$router->get('fromTelegramApp-page','telegram/page.php');


$router->get('main','main.php');
$router->get('orders','orders.php');
$router->get('movements','movements.php');
$router->get('login','login.php');

$router->get('logout','logout.php');
$router->get('item','item.php');
$router->get('order','order.php');
$router->get('flags','flags.php');

// actions:
$router->get('compare','action/compare.php');
$router->get('verification','action/verification.php');

$router->get('movement/create','movement-create.php');
$router->post('movement/create','movement-create.php');
$router->post('login','login.php');

$router->post('ajax/order','ajax/order.php');
$router->post('ajax/movement','ajax/movement.php');
$router->post('ajax/order/create','ajax/order-create.php');
$router->post('ajax/item/edit','ajax/item-edit.php');
$router->post('search','ajax/search.php');

$router->post('action/language','action/language.php');
// $router->post('movement','movement/store.php');
// $router->delete('movement','movement/destroy.php');



// $routes = 
// [
//     '' => 'main.php',
//     'main' => 'main.php',
//     'orders' => 'orders.php',
//     'login' => 'login.php',
//     'logout' => 'logout.php',
//     'item' => 'item.php',
//     'order' => 'order.php',
//     'ajax/order' => 'ajax/order.php',
//     'order/create' => 'order-create.php',
//     'movement/create' => 'movement-create.php'
// ];