<?php

/*
Telegram Channel : @osClub
Developer : @LampStack
*/

ini_set("log_errors", "off");
error_reporting(0);


$apiKey = '7214348052:AAH5LWiCiDXzcEYYkyFdrGqihqUmqg82YS8';

$games_url = 'https://domain.com/games/';


function LampStack($method,$datas=[]){
global $apiKey;
$url = 'https://api.telegram.org/bot'.$apiKey.'/'.$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
return json_decode(curl_error($ch));
}else{
return json_decode($res);
}
}


$update = json_decode(file_get_contents('php://input'));
if(isset($update->message)) {
@$msg = $update->message->text;
@$from_id = $update->message->from->id;
@$message_id = $update->message->message_id;
}


if($msg === '/start'){
LampStack('sendPhoto',[
'chat_id' => $from_id,
'photo' => new CURLFILE('home.png'),
'caption' => '
Hi, welcome to FreeToPlay bot !

<b>Note : Some of games needs to rotate your device to landscape (reload the game after Rotation)</b>

+ Developed by @LampStack
+ Telegram Channel : @osClub

> Choose a game and enjoy :
',
'parse_mode' => 'HTML',
'reply_to_message_id' => $message_id,
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => 'Quiz Game', 'web_app' => ['url' => $games_url . 'quiz-game']], ['text' => 'Mr. Macagi', 'web_app' => ['url' => $games_url . 'mr-macagi']]],
[['text' => 'Shooter Zombie', 'web_app' => ['url' => $games_url . 'shooter-zombie']], ['text' => 'Melodys Adventure', 'web_app' => ['url' => $games_url . 'melodys-adventure']]],
[['text' => '9-Patch Pazzle', 'web_app' => ['url' => $games_url . '9-patch-pazzle']], ['text' => 'Watermelon', 'web_app' => ['url' => $games_url . 'watermelon']]],
[['text' => 'Color Ball', 'web_app' => ['url' => $games_url . 'color-ball']], ['text' => 'Fishing Frenzy', 'web_app' => ['url' => $games_url . 'fishing-frenzy']]],
[['text' => 'Floppy Bird', 'web_app' => ['url' => $games_url . 'floppy-bird']], ['text' => 'Machine Carnage', 'web_app' => ['url' => $games_url . 'machine-carnage']]],
[['text' => 'Ninja', 'web_app' => ['url' => $games_url . 'ninja']], ['text' => 'Runner', 'web_app' => ['url' => $games_url . 'runner']]],
[['text' => 'Jump', 'web_app' => ['url' => $games_url . 'jump']], ['text' => 'Zombie Killer', 'web_app' => ['url' => $games_url . 'zombie-killer']]],
]
])
]);
}