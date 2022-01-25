<?php
session_start();
include 'database.php';

$dateOrdered = date_create(date('Y') . "-" . date('m') . "-" . date('d'));

    $menuID = $_POST['menuID'];
    $numServe = $_POST['numServe'];
    $decor= $_POST['decor'];
    $video = $_POST['video'];
    $photo = $_POST['photo'];
    $pa= $_POST['pa'];
    $eventDate = $_POST['eventDate'];
    $address = $_POST['address'];
    $total= floatval($_POST['total']);
    $email = $_SESSION['email'];

$sql = "INSERT INTO `order`(`dateOrdered`, `dateOfEvent`, `venueAddress`, `numPeople`, `decor`, `videography`, `photography`, `publicAddress`, `totalAmt`, `Menu_idMenu`, `Customer_email`) 
                VALUES ('$dateOrdered','$menuID','$address','$numServe','$decor','$video','$photo','$pa','$total','$menuID','$email')";

$conn->query($sql);

header('Location: customer.php?success=1');
