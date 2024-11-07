<?php

include "../app/connection.php";

$news_query = "SELECT * FROM `news`";
$result = mysqli_query($conn, $news_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
</head>

<body>
    <div class="main">
        <?php include "leftside.php" ?>



        <div class="right-side">
            <div class="bread d-flex justify-content-between">
                <nav aria-label">
                    <ol class="breadcrumb mt-4 ms-3">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">News</li>
                    </ol>
                </nav>
                <div class="add mt-4 me-3">
                    <a href="news_add.php" class="btn btn-primary">Add News</a>
                </div>
            </div>

            <div class="container border p-2 mt-5" style="border-radius: 10px; max-width: 1100px;">
                <div class="container p-3">
                    <h4 class="text-center">News</h4>
                    <hr>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php
                        $sn = $row['sn'];
                        $title = $row['title'];
                        ?>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between d-flex align-items-center">
                                <p style="max-width: 840px; font-size:large;"><?php echo $title ?></p>
                                <div class="actions">
                                    <a href="news_edit.php?=<?php echo $sn; ?>" class="btn btn-warning">Edit</a>
                                    <a href="news_delete.php?=<?php echo $sn; ?>" class="btn btn-danger">Delete</a>
                                </div>
                            </li>
                        </ul>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

    </div>

    <?php include "sidebar.php" ?>




</body>

</html>