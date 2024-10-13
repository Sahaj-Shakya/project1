<?php

session_start();

session_unset();

header('Location: index.php');
session_start();
$_SESSION['message'] = 'User logged out.';
?>