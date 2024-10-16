<?php

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
</head>

<body>

    <?php if ($error === true): ?>
        <div class="container col-4">
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <?php unset($_SESSION['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php include 'nav.php' ?>

    <div class="d-flex justify-content-center align-items-center" style="margin-top: 100px;">
        <div class="card container_login p-4 col-lg-4 col-md-6 col-sm-8">
            <h4 class="mb-3">Change Password</h4>
            <form action="change_password.php" method="post">
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Current Password</label>
                    <input maxlength="30" name="password" type="password" class="form-control" id="password" placeholder="Enter Current password" required>
                    <i class="bi bi-eye-slash position-absolute" id="toggleCurrentPassword" style="cursor: pointer; right: 10px; top: 43px;"></i>
                </div>
                <div class="mb-4 position-relative">
                    <label for="new-password" class="form-label">New Password</label>
                    <input maxlength="30" name="new_password" type="password" class="form-control" id="new-password" placeholder="Enter New password" required>
                    <i class="bi bi-eye-slash position-absolute" id="toggleNewPassword" style="cursor: pointer; right: 10px; top: 43px;"></i>
                </div>
                <div class="mb-4 position-relative">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input maxlength="30" name="confirm_password" type="password" class="form-control" id="confirm-password" placeholder="Confirm password" required>
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