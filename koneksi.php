<?php
date_default_timezone_set('Asia/Jakarta');
$server = 'localhost';
$user = 'root';
$password = '';
$database = 'kafe_pedalink';
$konek = mysqli_connect($server, $user, $password, $database);
if ($konek) {
	echo "";
} else {
	echo "GAGAL KONEK KE DATABASE";
}
