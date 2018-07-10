<?php
$conn = mysql_connect("localhost","root","") or die("Gagal koneksi");
$db = mysql_select_db("marshal",$conn) or die("Database tidak ditemukan");
?>