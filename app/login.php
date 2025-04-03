<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : ''; 

if($username != ''){
    header('Location: index.php');
}

include 'connection.php';

$message = '';


if(isset($_POST['login'])){

    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1";
    $result = mysqli_query($conn, $query);


    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];


        $_SESSION['email'] = $email;
        header('Location: index.php');
    } else {
        $message = "Incorrect email or password.";
    }

}
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

</head>

<body>

    <?php include 'nav.php'?>

    <?php if ($message != ''): ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <!-- <?php if (isset($_SESSION['message'])): ?>
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
    <?php endif; ?> -->

    <div class="d-flex justify-content-center align-items-center" style="margin-top: 150px;">
        <div class="card container_login p-4 col-lg-4 col-md-6 col-sm-8">
            <h4 class="text mb-4 ">Login</h4>
            <form method="post" action="login.php">

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Enter email" required>
                </div>

                <div class="mb-4 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <input maxlength="20" name="password" type="password" class="form-control" id="password" placeholder="Enter password" required>
                    <i class="bi bi-eye-slash position-absolute" id="togglePassword" style="cursor: pointer; right: 10px; top: 43px;"></i>
                </div>
                
                <p style="margin-bottom: 5px;">Not registered yet? <a href="register.php" style="text-decoration: underline;">Register now</a></p>
                <div class="d-grid">
                    <button name="login" type="submit" class="btn btn-outline-secondary">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPassword = document.querySelector('#confirm-password');

        toggleConfirmPassword.addEventListener('click', function(e) {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>

</body>

</html>