<?php

require CONFIG.'/routes.php';



// $method = $_SERVER['REQUEST_METHOD'];
// if ($method == 'POST')
// {
//     ff($_SERVER['REMOTE_ADDR'],'SERVER[REMOTE_ADDR]');
//     /*
//         telegram ip:
//         91.108.6.98
//     */
//     if ($_SERVER['REMOTE_ADDR'] == '91.108.6.98')
//     {
//         require CONTROLLERS.'/telegram.php';
//     }
//     else
//     {
//         $uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'],'/');
//         if (array_key_exists($uri,$routes))
//         {
//             require CONTROLLERS.'/'.$routes[$uri];
//         }
//         else
//         {
//             abort();
//         }
//     }
// }
// else
// { // method GET:
//     $uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'],'/');
//     if (array_key_exists($uri,$routes))
//     {
//         require CONTROLLERS.'/'.$routes[$uri];
//     }
//     else
//     {
//         abort();
//     }
// }