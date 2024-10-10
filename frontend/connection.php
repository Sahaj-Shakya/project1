<?php

    $server = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'project1';

    $conn = mysqli_connect($server, $username, $password, $dbname);

    
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }    

?>