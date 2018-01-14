<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once('./LINEBotTiny.php');

$channelAccessToken = '88CZI7bJyYo9KsWmoPV9yiBhoR2jbp7CoWyAf0ChjPUCgQDg3MO2uxULxMNp2Bwd399w55G21x8LSRLlFnOSaK4dioqm7NbfGhQ07DTbQqys/jw+/v4hptA3BuUnG9N5Pkd5TVV8jpgW9VcWsKDvgAdB04t89/1O/w1cDnyilFU=';
$channelSecret = '71d6f0dfc1f7dfcc89a5f3fc396f5b27';

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$replyToken = $client->parseEvents()[0]['replyToken'];
$message 	= $client->parseEvents()[0]['message'];
$msg_type = $message['type'];
$botname = "KerangAjaib"; //Nama bot

// foreach ($client->parseEvents() as $event) {
//     switch ($event['type']) {
//         case 'message':
//             $message = $event['message'];
//             switch ($message['type']) {
//                 case 'text':
//                     $client->replyMessage(array(
//                         'replyToken' => $event['replyToken'],
//                         'messages' => array(
//                             array(
//                                 'type' => 'text',
//                                 'text' => $message['text']
//                             )
//                         )
//                     ));
//                     break;
//                 default:
//                     error_log("Unsupporeted message type: " . $message['type']);
//                     break;
//             }
//             break;
//         default:
//             error_log("Unsupporeted event type: " . $event['type']);
//             break;
//     }
// };

function send($input, $rt){
    $send = array(
        'replyToken' => $rt,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $input
            )
        )
    );
    return($send);
}

function jawabs(){
    $list_jwb = array(
		'Ya',
		'Tidak',
		'Bisa jadi',
		'Mungkin',
		'Tentu tidak',
		'Coba tanya lagi'
		);
    $jaws = array_rand($list_jwb);
    $jawab = $list_jwb[$jaws];
    return($jawab);
}

if($msg_type == 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'apakah') {
        $balas = send(jawabs(), $replyToken);
    }
    else {
      // todo
    }
}
else {
  // todo
}

$result =  json_encode($balas);
file_put_contents($botname.'.json',$result);

$client->replyMessage($balas);
