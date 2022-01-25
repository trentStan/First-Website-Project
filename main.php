<?php
session_start();
$admin = file_get_contents("admin.json");
$admin = json_decode($admin);


if(isset($_SESSION) && $_SESSION['email'] == $admin->email){
   /* $myfile = fopen("admin.php", "r+") or die("Unable to open file!");
    echo fread($myfile,filesize("admin.php"));
    fclose($myfile); */
    header('Location: admin.php');
}else if(isset($_SESSION) && !$_SESSION['email']== null){
    header('Location: customer.php');
}else {
    //$myfile = fopen("start.php", "r") or die("Unable to open file!");
    //echo fread($myfile,filesize("start.php"));
    //fclose($myfile); 
    header('Location: start.php');
} 

?>
