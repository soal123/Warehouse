<?php

/*
Подключаем клиент Google таблиц
который мы устанавливали через композер
v01 - если заказ последний то вставляем черную полосу после него и одно слово black
*/
f('file: googleapi_01_v01.php');
// require_once __DIR__ . '/vendor/autoload.php';

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

// Получение содержимого диапазона ячеек
// new code:
// get number order:
$order_number = (int)$values[0][0];

if ($order_number < 900)
    {
        $sheetId = 735844265;
        $worksheet_name = '2024!';
    }
    else
    {
        $sheetId = 0;
        $worksheet_name = '2023!';
    }


// list name = Worksheep_accessories
// get data (first column from table)
$range = $worksheet_name.'A1:A1000';

// f($range, '$range');
// f($spreadsheetId, '$spreadsheetId');
$response = $service->spreadsheets_values->get($spreadsheetId, $range)->getValues();
// f($response,'response');
// foreach ($response as $key => $value)
// {
//     f($key, 'key');
//     f($value, 'value');
// }


$the_end = false;

foreach ($response as $key => $value)
    {

        if ($value != [])
        {
            $str = 'строка '.$key.' = '.$value[0];
            // f($key, 'key');
            // f($value[0], 'value');
            // f($order_number, 'order_number');
            // f($str, 'str');

            if ((int)$value[0] < $order_number)
            {
                continue;
            }
            if ((int)$value[0] == $order_number)
            {

                $requests = [
                    new Google_Service_Sheets_Request([
                            'insertDimension' => 
                            	[
                	                'range' => 
                	                  	[
                	                      "sheetId" => $sheetId,
                		                  "dimension" => "ROWS",
                		                  "startIndex" => $key,
                		                  "endIndex" => ($key+count($values))
                	                    ]
                                ]
                        ]),
                    new Google_Service_Sheets_Request([
                            "repeatCell" => 
                		    	[
                		    		"range" => 
                		            	[
                		                  "sheetId" => $sheetId,
                						  "startRowIndex" => $key,
                						  "endRowIndex" => ($key+count($values)),
                						  "startColumnIndex" => 0,
                						  "endColumnIndex" => 26
                		                ],
                		             "cell" => 
                		             	[
                		             	  "userEnteredFormat" =>
                		             	  	[
                			             	  	"backgroundColor" =>
                			             	  		[
                			             	  			"red" => 1,
                			             	  			"green" => 1,
                			             	  			"blue" => 1
                			             	  		]
                		             	  	]
                		             	],
                		             "fields" => 'userEnteredFormat(backgroundColor)'
                		    	]
                        ])
                ];
                $batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(['requests' => $requests]);
                $response = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);

                /*
                    insert values in cells
                */
                $valueRange = new Google_Service_Sheets_valueRange();
                $valueRange->setMajorDimension('ROWS');
                $valueRange->setvalues($values);
                $options = ['valueInputOption' => 'USER_ENTERED'];
                $range_for_insert = $worksheet_name.'A'.(string)($key+1);
                $service->spreadsheets_values->update($spreadsheetId, $range_for_insert, $valueRange, $options);
                
                $the_end = true;
                break;
            }
            if ((int)$value[0] > $order_number)
            {
                $values[] = [0 => 'black'];
                /*
                    define how many need row
                */
                // count($values); // quantity: five row.


                $requests = [
                    new Google_Service_Sheets_Request([
                            'insertDimension' => 
                            	[
                	                'range' => 
                	                  	[
                	                      "sheetId" => $sheetId,
                		                  "dimension" => "ROWS",
                		                  "startIndex" => $key,
                		                  "endIndex" => ($key+count($values))
                	                    ]
                                ]
                        ]),
                    new Google_Service_Sheets_Request([
                            "repeatCell" => 
                		    	[
                		    		"range" => 
                		            	[
                		                  "sheetId" => $sheetId,
                						  "startRowIndex" => $key,
                						  "endRowIndex" => ($key+count($values)-1),
                						  "startColumnIndex" => 0,
                						  "endColumnIndex" => 26
                		                ],
                		             "cell" => 
                		             	[
                		             	  "userEnteredFormat" =>
                		             	  	[
                			             	  	"backgroundColor" =>
                			             	  		[
                			             	  			"red" => 1,
                			             	  			"green" => 1,
                			             	  			"blue" => 1
                			             	  		]
                		             	  	]
                		             	],
                		             "fields" => 'userEnteredFormat(backgroundColor)'
                		    	]
                        ]),
                    new Google_Service_Sheets_Request([
                            "repeatCell" => 
                		    	[
                		    		"range" => 
                		            	[
                		                  "sheetId" => $sheetId,
                						  "startRowIndex" => ($key+count($values))-1,
                						  "endRowIndex" => ($key+count($values)),
                						  "startColumnIndex" => 1,
                						  "endColumnIndex" => 26
                		                ],
                		             "cell" => 
                		             	[
                		             	  "userEnteredFormat" =>
                		             	  	[
                			             	  	"backgroundColor" =>
                			             	  		[
                			             	  			"red" => 0,
                			             	  			"green" => 0,
                			             	  			"blue" => 0
                			             	  		]
                		             	  	]
                		             	],
                		             "fields" => 'userEnteredFormat(backgroundColor)'
                		    	]
                        ])
                ];
                $batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(['requests' => $requests]);
                $response = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);

                /*
                    insert values in cells
                */
                $valueRange = new Google_Service_Sheets_valueRange();
                $valueRange->setMajorDimension('ROWS');
                $valueRange->setvalues($values);
                $options = ['valueInputOption' => 'USER_ENTERED'];
                $range_for_insert = $worksheet_name.'A'.(string)($key+1);
                $service->spreadsheets_values->update($spreadsheetId, $range_for_insert, $valueRange, $options);

                $the_end = true;
                break;
            }
        }
    }

// $requests2 = [
//     new Google_Service_Sheets_Request([
//             "repeatCell" => 
// 		    	[
// 		    		"range" => 
// 		            	[
// 		                  "sheetId" => $sheetId,
// 						  "startRowIndex" => 88,
// 						  "endRowIndex" => 89,
// 						  "startColumnIndex" => 1,
// 						  "endColumnIndex" => 26
// 		                ],
// 		             "cell" => 
// 		             	[
// 		             	  "userEnteredFormat" =>
// 		             	  	[
// 			             	  	"backgroundColor" =>
// 			             	  		[
// 			             	  			"red" => 0,
// 			             	  			"green" => 0,
// 			             	  			"blue" => 1
// 			             	  		]
// 		             	  	]
// 		             	],
// 		             "fields" => 'userEnteredFormat(backgroundColor)'
// 		    	]
//         ])
// ];

// $batchUpdateRequest2 = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(['requests' => $requests2]);

// $response = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest2);




if (!$the_end)
{
    /* else wolk then add in end list */
    $values[] = [0 => 'black'];

    $valueRange = new Google_Service_Sheets_valueRange();
    $valueRange->setMajorDimension('ROWS');
    $valueRange->setvalues($values);
    
    $options = ['valueInputOption' => 'USER_ENTERED'];
    $range_for_insert = $worksheet_name.'A'.(string)(count($response)+1);
    
    $service->spreadsheets_values->update($spreadsheetId, $range_for_insert, $valueRange, $options);
}
