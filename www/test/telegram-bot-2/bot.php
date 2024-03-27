<?php

use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;


// $telegram = new Api('5974747501:AAELsrnA0c4isSPsLJWc5zWSKLo9hn4_iRw');
$telegram = new Api(TOKEN);

$response = $telegram->getMe();

$update = $telegram->getWebhookUpdate();
f($update,'$update');


$chat_id = $update['message']['chat']['id'] ?? 0;
$text = $update['message']['text'] ?? '';
$name = $update['message']['from']['first_name'] ?? 'Guest';



if (!$chat_id)
{
    die;
}
if ($text == '/help')
{
    $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'hello, this command /help, new word'
        ]);
}









telegrammMessage('message accepted successful');
die;