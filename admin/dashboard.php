<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : ''; 

if($admin === ''){
    header('Location: login.php');
}

include "../app/connection.php";

$total_query = "SELECT COUNT(*) AS total_users FROM user";
$total_result = mysqli_query($conn, $total_query);

$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total_users'];

$contact_query = "SELECT * FROM `contact_us` ORDER BY `created_at` DESC";
$contact_result = mysqli_query($conn, $contact_query);

$contact_rows = mysqli_fetch_all($contact_result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel</title>
</head>

<body>
    <div class="main">
        <?php include "leftside.php" ?>



        <div class="right-side">
            <nav aria-label">
                <ol class="breadcrumb mt-4 ms-3">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                    <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>

            <div class="card ms-5 mt-4 bg-secondary" style="max-width: 11rem;">
                <div class="card-header bg-secondary text-white">
                    <h5>Total Users</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h6><?php echo $total ?></h6>
                    </li>
                    <li class="list-group-item">
                        <a href="users.php">See Users</a>
                    </li>
                </ul>
            </div>

            <div class="card ms-5 mt-5 bg-secondary" style="max-width: 24rem;">
                <div class="card-header bg-secondary text-white">
                    <h5>Recent Contact Us</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <?php $counter = 0;?>
                    <?php foreach ($contact_rows as $contact_row): ?>
                        <?php

                        if ($counter === 3) break;
                        $name = $contact_row['name'];
                        $email = $contact_row['email'];
                        $subject = $contact_row['subject'];
                        $message = $contact_row['message'];
                        ?>

                            <li class="list-group-item">
                                <strong><?php echo $name; ?></strong> <br>
                                <small><span style="font-weight: 500;">Email: </span><?php echo $email; ?></small><br>
                                <small><span style="font-weight: 500;">Subject: </span><?php echo $subject; ?></small><br>
                                <small style='display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;'><span style="font-weight: 500;">Message: </span><?php echo $message; ?></small>
                            </li>
                        <?php $counter ++; ?>

                    <?php endforeach; ?>
                    <li class="list-group-item">
                        <a href="contact_us.php">See All</a>
                    </li>
                </ul>
            </div>


        </div>
    </div>

    <?php include "sidebar.php" ?>




</body>

</html>