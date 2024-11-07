<?php

session_start();
session_unset();

header('Location: login.php');
session_start();
$_SESSION['admin_message'] = 'User logged out.';
?>