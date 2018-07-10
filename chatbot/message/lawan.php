<?php
	function notif_cari($data) {
		$bot_token		= "YOUR API TOKEN";
		$telegram_api	= "https://api.telegram.org/bot".$bot_token;
		$data 			= (object) $data;
		$message 		= "Saudara ".$data->nama." (@".$data->id.") sedang mencari lawan, dengan jadwal jam ".$data->jam." jika Anda tertarik untuk menjadi lawanya silahkan ketik lawan ".$data->jam.". Tawaran ini hanya berlaku untuk 1 menit.";
		file_get_contents($telegram_api."/sendmessage?chat_id=".$data->chat_id."&text=".$message);
	}

	function notif_lawan($data)
	{
		$bot_token		= "YOUR API TOKEN";
		$telegram_api	= "https://api.telegram.org/bot".$bot_token;
		$data 			= (object) $data;
		$message 		= "Selamat saudara ".$data->lawan_nama." (@".$data->lawan_tel_id.") menjadi lawan Anda.";
		file_get_contents($telegram_api."/sendmessage?chat_id=".$data->cari_chat_id."&text=".$message);
	}
?>