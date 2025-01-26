<?php

session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';

if ($admin === '') {
    header('Location: login.php');
}

include '../app/connection.php';

$users_query = "SELECT * FROM `user`";
$users_result = mysqli_query($conn, $users_query);

$superuser_query = "SELECT * FROM `admin`";
$superuser_result = mysqli_query($conn, $superuser_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
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
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
                <div class="add mt-4 me-3">
                    <a href="admins.php" class="btn btn-primary">View Super Users</a>
                </div>
            </div>

            <?php if (isset($_SESSION['admin_message'])): ?>
                <div class="container mt-2">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['admin_message']; ?>
                                <?php unset($_SESSION['admin_message']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="container border p-2 mt-5" style="border-radius: 10px; max-width: 900px; overflow-y: scroll; max-height: 750px;">
                <div class="container p-3">
                    <h4 class="text-center">Users</h4>
                    <hr>
                    <?php while ($row = mysqli_fetch_assoc($users_result)): ?>
                        <?php
                        $sn = $row['sn'];
                        $username = $row['username'];
                        // $title = $row['email'];
                        ?>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between d-flex align-items-center">
                                <p style="max-width: 840px; font-size: large;"><?php echo $username ?></p>
                                <div class="actions">
                                    <a href="users_view.php?sn=<?php echo $sn; ?>" class="btn btn-warning">View</a>
                                    <button class="btn btn-danger" onclick="showConfirmation(<?php echo $sn; ?>)">Delete</button>
                                </div>
                            </li>
                        </ul>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include "sidebar.php" ?>


    <script>
        function showConfirmation(sn) {
            if (confirm("Confirm Delete?")) {
                // User clicked "Yes"
                window.location = `users_delete.php?sn=${sn}`
            }
        }
    </script>

</body>

</html>