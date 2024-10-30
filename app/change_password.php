<?php
include 'connection.php';

session_start();
$username = $_SESSION['username'];
$user_email = $_SESSION['email'];

if ($username == false) {
    header('Location: login.php');
    exit();
}

$query = "SELECT `sn`, `password` FROM `user` WHERE `email` = '$user_email' LIMIT 1";
$result = mysqli_query($conn, $query);


if ($result) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['sn'];
    $current_password = $row['password'];
}

$error = false;
$message = '';


function validate($current, $new, $confirm)
{
    global $error, $message;

    if (trim($current) === '' || trim($new) === '' || trim($confirm) === '') {
        $error = true;
        $message = 'Password can\'t be empty!';
        return false;
    }

    if ($new !== $confirm){
        $error = true;
        $message = 'Confirm password doesn\'t match!';
        return false;
    }

    if (strlen($new) > 20){
        $error = true;
        $message = 'Max character is 20!';
        return false;
    }


    return true;
}

if(isset($_POST['save'])){
    $current = $_POST['password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];


    if ($current === $current_password){
        if (validate($current, $new, $confirm)){
            global $message;
            $query = "UPDATE `user` SET `password` = '$new' WHERE `user`.`sn` = $id;";

            if (mysqli_query($conn, $query)) {
                $error = true;
                $_SESSION['message'] = 'Password Changed!';
                header('Location: profile.php');
            } else {
                $error = true;
                $message = "Error: " . mysqli_error($conn);
            }
        }
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
</head>

<body>

    <?php if ($error === true): ?>
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

    <?php include 'nav.php' ?>

    <div class="d-flex justify-content-center align-items-center" style="margin-top: 100px;">
        <div class="card container_login p-4 col-lg-4 col-md-6 col-sm-8">
            <h4 class="mb-4">Change Password</h4>
            <form action="change_password.php" method="post">
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Current Password</label>
                    <input maxlength="20" name="password" type="password" class="form-control" id="password" placeholder="Enter Current password" required>
                    <i class="bi bi-eye-slash position-absolute" id="toggleCurrentPassword" style="cursor: pointer; right: 10px; top: 43px;"></i>
                </div>
                <div class="mb-4 position-relative">
                    <label for="new-password" class="form-label">New Password</label>
                    <input maxlength="20" name="new_password" type="password" class="form-control" id="new-password" placeholder="Enter New password" required>
                    <i class="bi bi-eye-slash position-absolute" id="toggleNewPassword" style="cursor: pointer; right: 10px; top: 43px;"></i>
                </div>
                <div class="mb-4 position-relative">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input maxlength="20" name="confirm_password" type="password" class="form-control" id="confirm-password" placeholder="Confirm password" required>
                    <i class="bi bi-eye-slash position-absolute" id="toggleConfirmPassword" style="cursor: pointer; right: 10px; top: 43px;"></i>
                </div>


                <div class="d-flex justify-content-end gap-2 mt-2">
                    <button name="save" class="btn btn-outline-primary">Save</button>
                    <a href="profile.php" class="btn btn-outline-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const toggleCurrentPassword = document.querySelector('#toggleCurrentPassword');
        const currentPassword = document.querySelector('#password');

        toggleCurrentPassword.addEventListener('click', function() {
            const type = currentPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            currentPassword.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        const toggleNewPassword = document.querySelector('#toggleNewPassword');
        const newPassword = document.querySelector('#new-password');

        toggleNewPassword.addEventListener('click', function() {
            const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            newPassword.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPassword = document.querySelector('#confirm-password');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>

</body>

</html>