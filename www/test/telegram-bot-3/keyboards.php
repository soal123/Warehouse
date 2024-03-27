<?php


$keyboard1 = 
    [
    'keyboard' => 
        [
            // 'text' => $phrases['btn_subscribe']
           [['text' => $phrases['btn_subscribe'], 'web_app' => ['url' => PATH.'/fromTelegramApp-page']]]
            // 'web_app' => ['url' => PATH.'/fromTelegramApp']
        ],
    'resize_keyboard' => true, // false - big button, true - small button
    // 'one_time_keyboard' => true, // false - not curl up keyboard, true - after press button curl up keyboard
    'input_field_placeholder' => $phrases['select_btn']
    ];
    
    
$keyboard2 = 
    [
    'keyboard' => 
        [
            // 'text' => $phrases['btn_subscribe']
           [['text' => $phrases['btn_unsubscribe']]]
            // 'web_app' => ['url' => PATH.'/fromTelegramApp']
        ],
    'resize_keyboard' => true, // false - big button, true - small button
    // 'one_time_keyboard' => true, // false - not curl up keyboard, true - after press button curl up keyboard
    'input_field_placeholder' => $phrases['select_btn']
    ];
    

$inline_keyboard1 = 
    [
    'inline_keyboard' => 
        [
            
            [['text' => $phrases['inline_btn'], 'web_app' => ['url' => PATH.'/fromTelegramApp']]]
            
        ]
    ];


