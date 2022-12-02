<?php

$servername = 'mysql27-farm10.kinghost.net';
$username = 'tft01';
$password = 'K593ZXE89CBq5KL';
$db = 'tft01';

$con = new mysqli($servername, $username, $password, $db);

if ($con->connect_error) {
  die('Connection failed: ' . $con->connect_error);
}

?>