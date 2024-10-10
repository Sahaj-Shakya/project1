<?php
include 'connection.php';

$error = false;
$message = '';

function validate($username, $email, $password, $con_password)
{
    global $error, $message;

    if (trim($username) === '' || trim($email) === '' || trim($password) === '' || trim($con_password) === '') {
        $error = true;
        $message = 'Fill all the form fields.';
        return false;
    }

    if (strpos($password, ' ') !== false) {
        $error = true;
        $message = 'Password should not contain spaces.';
        return false;
    }

    if ($password !== $con_password) {
        $error = true;
        $message = 'Confirm password doesn\'t match';
        return false;
    }

    if (strlen($password) > 20) {
        $error = true;
        $message = 'Password should be of 20 characters max.';
        return false;
    }

    return true;
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $con_password = $_POST['confirm_password'];

    $email_query = "SELECT * FROM `user` WHERE `email` LIKE '$email' LIMIT 1";
    $email_result = mysqli_query($conn, $email_query);
    $user = mysqli_fetch_assoc($email_result);

    if ($user) {
        $error = true;
        $message = 'This email is already registered.';
    } else {
        if (validate($username, $email, $password, $con_password)) {
            global $message;
            $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";

            if (mysqli_query($conn, $query)) {
                $message = 'Registration Sucessfull';
                header('Location: login.php');
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
        }
    }
}

mysqli_close($conn);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>

<body>
    <?php if ($error === true): ?>
        <div class="container col-5">
            <div class="alert alert-secondary" role="alert">
                <?php echo $message; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php include 'nav.php' ?>

    <div class="d-flex justify-content-center align-items-center" style="margin-top: 100px;">
        <div class="card container_register p-4 col-lg-4 col-md-6 col-sm-8">
            <h4 class="text mb-4 ">Register</h4>
            <form method="post" action="register.php">

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input name="username" type="text" autocomplete="off" class="form-control" id="username" placeholder="Enter username" maxlength="30" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Enter email" required>
                </div>

                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <input maxlength="30" name="password" type="password" class="form-control" id="password" placeholder="Enter password" required>
                    <i class="bi bi-eye-slash position-absolute" id="togglePassword" style="cursor: pointer; right: 10px; top: 43px;"></i>
                </div>

                <div class="mb-4 position-relative">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input maxlength="30" name="confirm_password" type="password" class="form-control" id="confirm-password" placeholder="Confirm password" required>
                    <i class="bi bi-eye-slash position-absolute" id="toggleConfirmPassword" style="cursor: pointer; right: 10px; top: 43px;"></i>
                </div>


                <p style="margin-bottom: 5px;">Already registered? <a href="login.php" style="text-decoration: underline;">Login</a></p>
                <div class="d-grid">
                    <button name="register" type="submit" class="btn btn-outline-secondary">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle Password visibility for the "Password" field
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Toggle the eye icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        // Toggle Password visibility for the "Confirm Password" field
        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPassword = document.querySelector('#confirm-password');

        toggleConfirmPassword.addEventListener('click', function(e) {
            // Toggle the type attribute
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            // Toggle the eye icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>

</html>