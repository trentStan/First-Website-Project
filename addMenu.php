<?php

include 'database.php';

$name= $_POST['name'];
$starter= $_POST['starter'];
$meals= $_POST['meals'];
$dessert= $_POST['dessert'];
$drinks= $_POST['drinks'];
$price= floatval($_POST['ppp']);

$sql = "INSERT INTO `menu`(`name`, `starter`, `meals`, `dessert`, `drinks`, `pricePerPerson`)
             VALUES ('$name','$starter','$meals','$dessert','$drinks','$price')";
$result = $conn->query($sql);

if(!$result){

    echo 'Add menu failed: ' .  mysqli_error($conn);
}else{
    header('Location: admin.php?type=1');
}

?>