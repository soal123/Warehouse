<?php

use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;

$phrases = require_once ROOT.'/www/test/test-telegram/phrases.php';
require_once ROOT.'/www/test/test-telegram/keyboards.php';

$telegram = new Api('5974747501:AAELsrnA0c4isSPsLJWc5zWSKLo9hn4_iRw');

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
elseif ($text == '/start')
{
    $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Welcome',
            'reply_markup' => json_encode($keyboard1)
        ]);
}
elseif ($text == $phrases['keyboard_1'])
{
    $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Welcome',
            'reply_markup' => json_encode($keyboard1)
        ]);
}
elseif ($text == $phrases['keyboard_2'])
{
    $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Welcome',
            'reply_markup' => json_encode($keyboard2)
        ]);
}
elseif ($text == $phrases['close'])
{
    $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'Close keyboard',
            'reply_markup' => json_encode(['remove_keyboard' => true])
        ]);
}
elseif ($text == $phrases['inline_keyboard_1'])
{
    $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'inline keyboard',
            'reply_markup' => json_encode($inline_keyboard1)
        ]);
}
elseif ($text == '/test')
{
    $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'hello, this command /test',
            'parse_mode' => 'HTML'
        ]);
}
elseif ($text == '/photo')
{
    $telegram->sendPhoto([
            'chat_id' => $chat_id,
            'photo' => InputFile::create('https://loremflickr.com/640/360'),
            // 'photo' => InputFile::create(ROOT.'/www/images/pic3.jpg'),
            'caption' => 'same photo'
        ]);
    // f($result,'$result');
}
elseif ($text == '/doc')
{
    $result = $telegram->sendDocument([
            'chat_id' => $chat_id,
            // 'document' => InputFile::create('https://loremflickr.com/640/360'),
            'document' => InputFile::create(ROOT.'/www/images/pic3.jpg'),
            'caption' => 'same photo'
        ]);
    // f($result,'$result');
}
elseif (!empty($text))
{
    $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'hello, this <b>not</b> command',
            'parse_mode' => 'HTML'
        ]);
}



telegrammMessage('message accepted successful');



die;

