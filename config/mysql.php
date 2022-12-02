<?php

$servername = 'mysql.tft.kinghost.net';
$username = 'tft';
$password = 'Teamfight1';
$db = 'tft';

$con = new mysqli($servername, $username, $password, $db);

if ($con->connect_error) {
  die('Connection failed: ' . $con->connect_error);
}

?>