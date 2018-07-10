<?php
require_once("perintah.php");
$bot_token		= "YOUR API TOKEN";
$telegram_api	= "https://api.telegram.org/bot".$bot_token;
$update_id 		= 0;
echo "Update 	: ".$update_id." ";
while (true) {
	$update 		= file_get_contents($telegram_api."/getupdates?offset=".$update_id);
	$update_array 	= json_decode($update, TRUE);
	if (sizeof($update_array["result"]) > 0) {
		$reply			= "";
		$pelanggan_id	= "";
		$text 			= $update_array["result"][0]["message"]["text"];
		$chat_id		= $update_array["result"][0]["message"]["chat"]["id"];
		$pelanggan_id = $update_array["result"][0]["message"]["chat"]["username"];
		$nama_depan		= $update_array["result"][0]["message"]["chat"]["first_name"];
		$nama_belakang	= $update_array["result"][0]["message"]["chat"]["last_name"];
		echo "\nAkun  	: ".$nama_depan." ".$nama_belakang." (@".$pelanggan_id.")";
		echo "\nPesan 	: ".$text;
		$reply = perintah($nama_depan, $nama_belakang, $text, $chat_id, $pelanggan_id);
		echo "\nBalas 	: ".$reply."\n\n";
		file_get_contents($telegram_api."/sendmessage?chat_id=".$chat_id."&text=".$reply."&parse_mode=Markdown");
		$update_id = $update_array["result"][0]["update_id"] + 1;
		echo "Update 	: ".$update_id." ";
	}
}
?>