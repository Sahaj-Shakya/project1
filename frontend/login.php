<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <?php include 'nav.php'?>

    <div class="d-flex justify-content-center align-items-center" style="margin-top: 200px;">
        <div class="card container_login p-4 col-lg-4 col-md-6 col-sm-8">
            <h4 class="text mb-4 ">Login</h4>
            <form>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                </div>

                <div class="mb-4 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" required>
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