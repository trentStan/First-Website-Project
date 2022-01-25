<?php

include 'database.php';

$menuID = floatval($_POST['menuID']);

$sql = "DELETE FROM `menu` WHERE `idMenu` = '$menuID'";

$result = $conn->query($sql);

if(!$result){
    echo mysqli_error($conn);
}else{
    header('Location: admin.php');
}

?>