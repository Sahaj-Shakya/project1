<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>

<body>
    <?php include 'nav.php' ?>


    <div class="d-flex justify-content-center align-items-center" style="margin-top: 100px;">
        <div class="card container_register p-4 col-lg-4 col-md-6 col-sm-8">
            <h4 class="text mb-4 ">Register</h4>
            <form>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" required>
                </div>

                <div class="mb-4">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" placeholder="Confirm password" required>
                </div>
                
                
                <p style="margin-bottom: 5px;">Already registered? <a href="login.php" style="text-decoration: underline;">Login</a></p>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-secondary">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>