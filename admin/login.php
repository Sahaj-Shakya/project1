<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : ''; 

if($admin != ''){
    header('Location: dashboard.php');
}

include "../app/connection.php";

if (isset($_POST['login'])) {

    $username = $_POST['name'];
    $password = $_POST['password'];

    $user_query = "SELECT * FROM `admin` WHERE `name` = '$username' AND `password` = '$password' LIMIT 1";
    $result = mysqli_query($conn, $user_query);


    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['admin'] = $row['name'];

        header('Location: dashboard.php');
    } else {
        $message = "Incorrect email or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php if (isset($_SESSION['admin_message'])): ?>
        <div class="container mt-5">
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

    <div class="d-flex justify-content-center align-items-center" style="margin-top: 150px;">
        <div class="card container_login p-4 col-lg-4 col-md-6 col-sm-8 shadow">
            <h4 class="text-center mb-4 ">Login to Admin Pannel</h4>
            <form method="post" action="login.php">

                <div class="mb-3">
                    <label for="name" class="form-label">User name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter username" required>
                </div>

                <div class="mb-4 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <input maxlength="20" name="password" type="password" class="form-control" id="password" placeholder="Enter password" required>
                    <i class="bi bi-eye-slash position-absolute" id="togglePassword" style="cursor: pointer; right: 10px; top: 40px;"></i>
                </div>

                <div class="d-grid">
                    <button name="login" type="submit" class="btn btn-outline-secondary">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>