<?php
session_start();
include "../app/connection.php";

$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : ''; 

if($admin === ''){
    header('Location: login.php');
}

if(isset($_GET)){
    $sn = $_GET['sn'];

    $query = "DELETE FROM `schedules` WHERE `schedules`.`sn` = $sn";
    $result = mysqli_query($conn, $query);

    if ($result){
        header('Location: schedules.php');
    }
    
}
?>