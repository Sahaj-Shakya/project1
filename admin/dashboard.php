<?php

include "../app/connection.php";

$total_query = "SELECT COUNT(*) AS total_users FROM user";
$total_result = mysqli_query($conn, $total_query);

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
                        <h6>9,982</h6>
                    </li>
                    <li class="list-group-item">
                        <a href="contactus.php">See Users</a>
                    </li>
                </ul>
            </div>

            <!-- add recent contact us -->
            <div class="card ms-5 mt-5 bg-secondary" style="max-width: 15rem;">
                <div class="card-header bg-secondary text-white">
                    <h5>Recent Contact Us</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>John Doe</strong> <br>
                        <small>Email: john@example.com</small><br>
                        <small>Message: Need assistance...</small>
                    </li>
                    <li class="list-group-item">
                        <strong>Jane Smith</strong> <br>
                        <small>Email: jane@example.com</small><br>
                        <small>Message: Issue with login...</small>
                    </li>
                    <li class="list-group-item">
                        <a href="contactus.php">See All</a>
                    </li>
                </ul>
            </div>


        </div>
    </div>

    <?php include "sidebar.php" ?>




</body>

</html>