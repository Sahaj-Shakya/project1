<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : ''; 
?>

<?php include 'bootstrap.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body style="padding-top: 90px;">
    <nav class="navbar navbar-expand-md fixed-top" style="background-color: rgb(162, 161, 160);">
        <div class="container col-12">
            <a class="navbar-brand me-5" href="index.php"><img class="logo" src="images/exam.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse col-10 navbar-collapse justify-content-between" id="navbarScroll">
                <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll gap-2" style="--bs-scroll-height: 150px;">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'news.php' ? 'active' : ''; ?>" aria-current="page" href="news.php">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'schedules.php' ? 'active' : ''; ?>" aria-current="page" href="schedules.php">Schedules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>" aria-current="page" href="about.php">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>" aria-current="page" href="contact.php">Contact us</a>
                    </li>
                </ul>
                <?php if($username != ''): ?>
                <div class="auth d-flex align-items-center gap-2">
                <a href="profile.php"><i class="bi bi-person-circle icon"></i></a>
                <a href="profile.php"><?php echo ucwords($username); ?></a>
                </div>
                <?php else: ?>
                    <div class="auth d-flex align-items-center gap-2">
                    <a href="login.php"><i class="bi bi-person-circle icon"></i></a>
                    <a href="login.php">Sign in</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>