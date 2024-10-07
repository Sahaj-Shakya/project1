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

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" required>
                </div>
                
                <p style="margin-bottom: 5px;">Not registered yet? <a href="register.php" style="text-decoration: underline;">Register now</a></p>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-secondary">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>