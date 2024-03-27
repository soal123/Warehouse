<?php
/*
пример команды:
Джесси сопоставить
*/




/*
Подключаем клиент Google таблиц
который мы устанавливали через композер
*/

require_once __DIR__ . '/vendor/autoload.php';
/* Наш ключ доступа к сервисному аккаунту */
$googleAccountKeyFilePath = __DIR__ . '/service_key.json';
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath);
// Создаем новый клиент
$client = new Google_Client();
// Устанавливаем полномочия
$client->useApplicationDefaultCredentials();
// Добавляем область доступа к чтению, редактированию, созданию и удалению таблиц
$client->addScope('https://www.googleapis.com/auth/spreadsheets');
$service = new Google_Service_Sheets($client);
// ID таблицы
// $spreadsheetId = '1NZd5ihaVcjET-kKXbAzBCnpSY5gxYuBktZV3S5zde-M'; // страница NewSpreadsheet
$spreadsheetId = '1JWnx34Akm1N521RVucXlnhi19VBogHZxIeAJG8sYdAk'; // страница Worksheep_accessories




// code:
$result_for_verified = '';
$cells = [];
/*displays numbers rows with not verified cells:*/
$ranges = 'позиции по 1С!A1:G1000';
// get values:

$response = $service->spreadsheets_values->batchGet($spreadsheetId, ['ranges' => $ranges, 'majorDimension' => 'ROWS'])->getValueRanges()[0]->getValues();
// d($response,'$response');
// f($response->getValues(), 'response_getValues');


// field zero to zero
$sql = "UPDATE `accessories` SET `zero` = 0 WHERE 1";
$db->query($sql);


for ($i=0; $i<count($response); $i++)
{
    $str = $response[$i][1]; // название
    $int = (int)str_replace(' ','',$response[$i][6]); // количество

    $sql = "SELECT `id` FROM `accessories` WHERE `title 1C` = ?";
    $result = $db->query($sql,[$str])->find();

    if ($result == false)
    {
        d('for "'.$str.'" nothing not found'.PHP_EOL);
        f('for "'.$str.'" nothing not found'.PHP_EOL);
    }
    else
    {
        $sql = "UPDATE `accessories` SET `count_1c` = ?, `zero`= 1 WHERE `id` = ?";
        // $result2 = $db->query($sql,[$int,$result['id']])->rowCount();  // rowCount() = 1, getColumn() = false
        $db->query($sql,[$int,$result['id']]);
    }
}

$sql = "UPDATE `accessories` SET `count_1c` = 0 WHERE `zero`= 0";
$db->query($sql);

// telegrammMessage('command 8 completed',5515319718);
die;

















