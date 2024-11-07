<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : ''; 

if($admin === ''){
    header('Location: login.php');
}

include "../app/connection.php";

$contact_query = "SELECT * FROM `contact_us`";
$result = mysqli_query($conn, $news_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
</head>

<body>
    <div class="main">
        <?php include "leftside.php" ?>



        <div class="right-side">
            <nav aria-label">
                <ol class="breadcrumb mt-4 ms-3">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                    <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact us</li>
                </ol>
            </nav>
        </div>
    </div>

    <?php include "sidebar.php" ?>


    

</body>

</html>