<?php
session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'ewsd';
$port = '3306';

$con = new mysqli($host, $username, $password, $db, $port);
if ($con->connect_errno) {
    echo "Connection Failed";
}

// The Same As Admin -- remove some statistics