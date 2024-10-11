<?php
session_start();
$username = $_SESSION['username'];
$user_email = $_SESSION['email'];
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucwords($username); ?></title>

</head>

<body>
    <?php include 'nav.php' ?>

    <div class="container w-100 col-lg-7=6">
        <div class="container align-items-center container_left p-4 col-lg-7">
            <h1 class="mb-5">User Details</h1>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <h5>Username</h5>
                    </div>
                    <div class="col-sm-9">
                        <h5>: <?php echo ucwords($username); ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <h5>Email address</h5>
                    </div>
                    <div class="col-sm-9">
                        <h5>: <?php echo $user_email; ?></h5>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>



</body>

</html>