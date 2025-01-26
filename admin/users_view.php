<?php

session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';

if ($admin === '') {
    header('Location: login.php');
}

include '../app/connection.php';

if(isset($_GET['sn'])){
    $sn = $_GET['sn'];

    $query = "SELECT * FROM `user` WHERE `sn` = $sn";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        $_SESSION['admin_message'] = "No user found.";
        header('Location: users.php');
        exit();
    }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="main">
        <?php include "leftside.php" ?>

        <div class="right-side">
            <div class="bread d-flex justify-content-between">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4 ms-3">
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item"><a href="users.php">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View User</li>
                    </ol>
                </nav>
                <div class="add mt-4 me-3">
                    <a href="users.php" class="btn btn-secondary">Back to List</a>
                </div>
            </div>

            <div class="container border p-4 mt-5" style="border-radius: 10px; max-width: 800px;">
                <h4 class="text-center">User Info</h4>
                <hr>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" class="form-control" value="<?php echo $user['username']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" value="<?php echo $user['email']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" id="password" class="form-control" value="<?php echo $user['password']; ?>" disabled>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-danger" onclick="showConfirmation(<?php echo $sn; ?>)">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <?php include "sidebar.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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