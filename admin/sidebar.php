<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div style="background-color: #dae4ed; width: 240px;" class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header mb-4 d-flex justify-content-between">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Admin Pannel</h5>
            <button style="font-size: 30px;" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                <i class="bi bi-list"></i>
            </button>
        </div>
        <div class="offcanvas-body d-flex flex-column justify-content-between">
            <div class="container top">
                <a href="dashboard.php" class="sidebar-content mb-4 d-flex" <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'style="color: black;"' : ''; ?>>
                    <p>Dashboard</p>
                    <div class="right"><i class="bi bi-speedometer2 ms-2"></i></div>
                </a>
                <a href="students.php" class="sidebar-content mb-4 d-flex" <?php echo basename($_SERVER['PHP_SELF']) == 'students.php' ? 'style="color: black;"' : ''; ?>>
                    <p>Students</p>
                    <div class="right"><i class="bi bi-person-vcard ms-2"></i></div>
                </a>
                <a href="room.php" class="sidebar-content mb-4 d-flex" <?php echo basename($_SERVER['PHP_SELF']) == 'room.php' ? 'style="color: black;"' : ''; ?>>
                    <p>Rooms</p>
                    <div class="right"><i class="bi bi-houses ms-2"></i></div>
                </a>
                <a href="main.php" class="sidebar-content mb-4 d-flex" <?php echo basename($_SERVER['PHP_SELF']) == 'main.php' ? 'style="color: black;"' : ''; ?>>
                    <p>Main</p>
                    <div class="right"><i class="bi bi-shuffle ms-2"></i></div>
                </a>
                <a href="news.php" class="sidebar-content mb-4 d-flex" <?php echo basename($_SERVER['PHP_SELF']) == 'news.php' ? 'style="color: black;"' : ''; ?>>
                    <p>News</p>
                    <div class="right"><i class="bi bi-newspaper ms-2"></i></div>
                </a>
                <a href="schedules.php" class="sidebar-content mb-4 d-flex" <?php echo basename($_SERVER['PHP_SELF']) == 'schedules.php' ? 'style="color: black;"' : ''; ?>>
                    <p>Schedules</p>
                    <div class="right"><i class="bi bi-calendar-check ms-2"></i></div>
                </a>
                <a href="contact_us.php" class="sidebar-content mb-4 d-flex" <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'style="color: black;"' : ''; ?>>
                    <p>Contact us</p>
                    <div class="right"><i class="bi bi-envelope-at ms-2"></i></div>
                </a>
                <a href="users.php" class="sidebar-content mb-4 d-flex" <?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'style="color: black;"' : ''; ?>>
                    <p>Users</p>
                    <div class="right"><i class="bi bi-people ms-2"></i></div>
                </a>
            </div>
            <div class="container bottom mb-4">
                <div class="user-detail d-flex justify-content-between align-items-center">
                    <div class="left d-flex align-items-center">
                        <div class="profile d-flex align-items-center">
                            <i class="bi bi-person-circle me-2"></i>
                            <p class="m-0 text-nowrap"><?php echo $admin; ?></p>
                        </div>
                        <a href="logout.php" title="logout" class="btn ms-3" style="color: red;">
                            <i class="bi bi-box-arrow-left m-0"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>