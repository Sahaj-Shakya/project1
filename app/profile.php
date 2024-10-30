<?php
include 'connection.php';

session_start();
$username = $_SESSION['username'];
$user_email = $_SESSION['email'];

if ($username == false) {
    header('Location: login.php');
    exit();
}


$query = "SELECT `sn` FROM `user` WHERE `email` = '$user_email' LIMIT 1";
$result = mysqli_query($conn, $query);


if ($result) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['sn'];
}

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucwords($username); ?></title>

</head>

<body>

<?php if ($_SESSION['message'] != ''): ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['message']; ?>
                        <?php unset($_SESSION['message']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php include 'nav.php' ?>

    <div class="d-flex justify-content-center align-items-center" style="margin-top: 100px;">
        <div class="card container_login p-4 col-lg-5 col-md-6 col-sm-8">
            <h1 class="mb-5">User Details</h1>
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <h5><strong>Username:</strong></h5>
                    </div>
                    <div class="col-sm-9">
                        <h5><?php echo ucwords($username); ?></h5>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <h5><strong>Email address:</strong></h5>
                    </div>
                    <div class="col-sm-9">
                        <h5><?php echo $user_email; ?></h5>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between gap-2 mt-4">
                    <div class="d-flex flex-row align-items-start gap-2">
                        <a href="edit_profile.php?id=<?php echo $id; ?>" class="btn btn-outline-warning">Edit</a>
                        <a href="change_password.php" class="btn btn-outline-primary">Change Password</a>
                    </div>
                    <div class="d-flex flex-row align-items-end">
                        <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>

</body>

</html>