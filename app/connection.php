<?php

    $server = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'project11';

    $conn = mysqli_connect($server, $username, $password, $dbname);

    
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }   

?>