<?php

/*
Подключаем клиент Google таблиц
который мы устанавливали через композер
*/
f('file: parsing_05.php');
require_once __DIR__ . '/vendor/autoload.php';

/*
Наш ключ доступа к сервисному аккаунту
*/
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
$ranges = '2023!L2:L1000';
// get values:
$response = $service->spreadsheets_values->get($spreadsheetId, $ranges, ['majorDimension' => 'COLUMNS'])->getValues()[0];
// f(get_class_methods($response), 'get_class_methods_response');
// get color cell:
$response_2 = $service->spreadsheets->get($spreadsheetId, ['includeGridData' => true,
	// link on cell, background which need get
	'ranges' => $ranges])->getSheets()[0]->getData()[0]->getRowData();
// $response_3 = $response_2->getSheets()[0]->getData()[0]->getRowData();
// f($response_3[24]["values"][0]['effectiveFormat']['backgroundColor'], 'response_3[24]["values"][0][effectiveFormat][backgroundColor]');
foreach ($response as $key => $value)
{
	// f($key, 'key');
	// f($value, 'value');
	if ($value === 'not_verified')
	{
		if (($response_2[$key]['values'][0]['effectiveFormat']['backgroundColor']['blue'] === null) and 
			($response_2[$key]['values'][0]['effectiveFormat']['backgroundColor']['green'] === 1) and 
			($response_2[$key]['values'][0]['effectiveFormat']['backgroundColor']['red'] === null))
		{
			// print 'cell 2023!L'.(string)($key+2).' is not_verified!</br>';
			$cells[] = $key+2;
		}
	}
}
// f($cells, 'cells');
$ranges_test = [];
foreach ($cells as $value)
{
	$ranges_test[] = '2023!A'.(string)$value.':E'.(string)$value;
	// f($key_1, 'key_1');
	// f($value_1, 'value_1');
}
// f($ranges_test, 'ranges_test');

$response_3 = $service->spreadsheets_values->batchGet($spreadsheetId, ['ranges' => $ranges_test, 'majorDimension' => 'ROWS'])->getValueRanges();
// f(get_class_methods($response_3), 'get_class_methods_response_3');
// f($response_3, 'response_3');
foreach ($response_3 as $key => $value)
{
	// f($value['values'][0], 'value[values][0]');
	$result_for_verified .= $ranges_test[$key].' '.$value['values'][0][3].', кол-во: '.$value['values'][0][4].PHP_EOL;
}
// f($result_for_verified, '$result_for_verified');
// now me need get values



$cells = [];
/*displays numbers rows with not verified cells:*/
$ranges = '2024!L2:L1000';
// get values:
$response = $service->spreadsheets_values->get($spreadsheetId, $ranges, ['majorDimension' => 'COLUMNS'])->getValues()[0];
// f(get_class_methods($response), 'get_class_methods_response');
// get color cell:
$response_2 = $service->spreadsheets->get($spreadsheetId, ['includeGridData' => true,
	// link on cell, background which need get
	'ranges' => $ranges])->getSheets()[0]->getData()[0]->getRowData();
// $response_3 = $response_2->getSheets()[0]->getData()[0]->getRowData();
// f($response_3[24]["values"][0]['effectiveFormat']['backgroundColor'], 'response_3[24]["values"][0][effectiveFormat][backgroundColor]');
foreach ($response as $key => $value)
{
	// f($key, 'key');
	// f($value, 'value');
	if ($value === 'not_verified')
	{
		if (($response_2[$key]['values'][0]['effectiveFormat']['backgroundColor']['blue'] === null) and 
			($response_2[$key]['values'][0]['effectiveFormat']['backgroundColor']['green'] === 1) and 
			($response_2[$key]['values'][0]['effectiveFormat']['backgroundColor']['red'] === null))
		{
			// print 'cell 2023!L'.(string)($key+2).' is not_verified!</br>';
			$cells[] = $key+2;
		}
	}
}
// f($cells, 'cells');
$ranges_test = [];
foreach ($cells as $value)
{
	$ranges_test[] = '2024!A'.(string)$value.':E'.(string)$value;
	// f($key_1, 'key_1');
	// f($value_1, 'value_1');
}
// f($ranges_test, 'ranges_test');

$response_3 = $service->spreadsheets_values->batchGet($spreadsheetId, ['ranges' => $ranges_test, 'majorDimension' => 'ROWS'])->getValueRanges();
// f(get_class_methods($response_3), 'get_class_methods_response_3');
// f($response_3, 'response_3');
foreach ($response_3 as $key => $value)
{
	// f($value['values'][0], 'value[values][0]');
	$result_for_verified .= $ranges_test[$key].' '.$value['values'][0][3].', кол-во: '.$value['values'][0][4].PHP_EOL;
}
dd($result_for_verified, '$result_for_verified');
// f($result_for_verified, '$result_for_verified');
// telegrammMessage($result_for_verified,$chat_id);

die;
// now me need get values

