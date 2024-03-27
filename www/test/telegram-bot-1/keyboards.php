<?php


$keyboard1 = [
        'keyboard' => [
                [['text' => $phrases['contact'], 'request_contact' => true], ['text' => $phrases['location'], 'request_location' => true]],
                [$phrases['close'], $phrases['keyboard_2']]
            ],
        'resize_keyboard' => true, // false - big button, true - small button
        'one_time_keyboard' => true, // false - not curl up keyboard, true - after press button curl up keyboard
        'input_field_placeholder' => 'select something'
    ];
    
$keyboard2 = [
        'keyboard' => [
                [$phrases['help'], $phrases['about']],
                [$phrases['keyboard_1'], $phrases['inline_keyboard_1']]
            ],
        'resize_keyboard' => true, // false - big button, true - small button
        'one_time_keyboard' => true, // false - not curl up keyboard, true - after press button curl up keyboard
        'input_field_placeholder' => 'select something'
    ];
    
$inline_keyboard1 = [
        'inline_keyboard' => [
                [['text' => $phrases['url'], 'url' => 'https://www.google.com/'], ['text' => $phrases['callback_button'], 'callback_data' => 'this callback query']]
            ]
    ];