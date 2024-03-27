<?php

use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
$phrases = require_once WWW.'/test/telegram-bot-3/phrases.php';
require_once WWW.'/test/telegram-bot-3/keyboards.php';





$telegram = new Api(TOKEN);

$response = $telegram->getMe();

$update = $telegram->getWebhookUpdate();
// f($update,'$update');


$text = $update['message']['text'] ?? '';
$name = $update['message']['from']['first_name'] ?? 'Guest';


if (isset($update['message']['chat']['id']))
{
    $chat_id = (int)$update['message']['chat']['id']; // integer
}
elseif (isset($update['user']['id']))
{
    $chat_id = (int)$update['user']['id'];
    $query_id = $update['query_id'] ?? '';
    $cart = $update['cart'] ?? [];
    $total_sum = $update['total_sum'];
    
    f($chat_id,'$chat_id');
    f($query_id,'$query_id');
    f($cart,'$cart');
    f($total_sum,'$total_sum');
}


if (!$chat_id)
{
    die;
}

if ($text == '/start')
{
    f('dot5');
    $keyboard = check_chat_id($chat_id) ? $keyboard2 : $keyboard1;
    $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => sprintf($phrases['start'],$name),
            // 'parse_mode' => 'HTML',
            'reply_markup' => json_encode($keyboard)
        ]);
    $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => $phrases['inline_keyboard'],
            // 'parse_mode' => 'HTML',
            'reply_markup' => json_encode($inline_keyboard1)
        ]);
}
elseif ($text == $phrases['btn_unsubscribe'])
{
    f('dot4');
    if (delete_subscriber($chat_id))
    {
        $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => $phrases['success_unsubscribe'],
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode($keyboard1)
            ]);
    }
    else
    {
        $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => $phrases['error_unsubscribe'],
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode($keyboard2)
            ]);
    }
}
elseif (isset($update['message']['web_app_data']))
{
    f('dot3');
    $btn = $update['message']['web_app_data']['button_text'];
    $data = json_decode($update['message']['web_app_data']['data'],1);
    fv($data,'$data');
    
    if (!check_chat_id($chat_id) && !empty($data['name']) && !empty($data['email']))
    {
        if (add_subscriber($chat_id, $data))
        {
            $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => $phrases['success_subscribe'],
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode($keyboard2)
            ]);
        }
        else
        {
            $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => $phrases['error_subscribe'],
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode($keyboard1)
            ]);
        }
    }
    else
    {
        $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => 'error',
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode($keyboard1)
            ]);
    }
    
    $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => ('Button: '.$btn.PHP_EOL.'<pre>'.print_r($data,1).'</pre>'),
            'parse_mode' => 'HTML'
        ]);
}
elseif (!empty($query_id))
{
    f('dot2');
    echo json_encode(['ok' => true, 'answer' => 'request received']);
    die;
}
else
{
    f('dot1');
    $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => 'error. end.',
                'parse_mode' => 'HTML'
            ]);
}










telegrammMessage('message accepted successful');
die;