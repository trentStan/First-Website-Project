<?php

include 'database.php';

$email = $_POST['email'];
$password = $_POST['psw'];

$admin = file_get_contents("admin.json");
$admin = json_decode($admin);

$sql = "SELECT `email` , `password` FROM `customer` WHERE `email`='$email'";
$result = $conn->query($sql);


if ($admin->email == $email && $admin->password == md5($password)) {
    session_start();
    $_SESSION['email'] = $admin->email;
    header("Location: admin.php");
    exit();
}

while ($row = $result->fetch_assoc()) {
    if ($email == $row['email'] && $password == $row['password']) {
        session_start();
        $_SESSION['email'] = $row['email'];
        header('Location: customer.php');
        exit();
    }
}

header("Location: start.php?error=1");

?>
