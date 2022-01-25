<?php
$email = $_POST['email'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$passw = $_POST['psw'];
$cellNum = $_POST['cellNum'];

session_start();

include 'database.php';
include 'email.php';

$check = $conn->query("SELECT `email` FROM `customer` WHERE email = '$email'");

while($row = $check->fetch_assoc()){
    if ($email == $row['email']) {
        header("Location: start.php?error=2");
    }
}

$sql = "INSERT INTO `customer`(`email`, `cellPhone`, `name`, `surname`, `password`) VALUES ('$email','$cellNum','$name','$surname','$passw')";
$result = $conn ->query($sql);

if($result){
    sendmail($email, 'Thank you for registering '. $name);
    $_SESSION['email'] = $email;
    header('Location: customer.php');
}else if(!$result){
    echo 'Registration failed';
    $a = 5;
    while ($a >= 0) {
        echo $a;
        sleep(1);
        $a--;
    }
    header('start.php');
}

?>