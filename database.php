<?php

$user = "root";
$pass = "";
$db = "trieune";
$host = "localhost";
$conn = new mysqli($host, $user, $pass, $db);

if (!$conn) {
    die("database not connected") . mysqli_error($conn);
} 