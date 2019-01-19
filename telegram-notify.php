#!/usr/bin/php
<?php
// $apiToken = "";
// $chats = []    // chat_id list
include_once("../.telegram_notify_config.php");

if(isset($argv[1])){
  foreach ($chats as $chat_id) {
    $formatMessage = [
      'chat_id' => $chat_id,
      'parse_mode' => 'HTML',
      'text' => $argv[1],
      'disable_web_page_preview'=>true,
    ];

    $context = stream_context_create(['http' =>
      [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => json_encode( $formatMessage ),
      ]
    ]);

    $result = json_decode(file_get_contents( 'https://api.telegram.org/bot'.$apiToken.'/sendMessage' ,false,$context ), true);

    //var_dump($result);

    if( isset($result['ok']) && $result['ok']==true ){
      echo "Message sent to @".$result['result']['chat']['username']."\n";
    }

  }
}

?>
