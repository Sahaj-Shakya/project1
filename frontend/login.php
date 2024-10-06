<?php include 'bootstrap.php' ?>
<?php include 'nav.php' ?>

<div class="d-flex justify-content-center align-items-center" style="margin-top: 200px;">
    <div class="card container_login p-4 col-lg-4 col-md-6 col-sm-8">
        <h4 class="text mb-4 ">Login</h4>
        <form>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>

            <div class="mb-1">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
            </div>
            <p>Not registered yet? <a href="register.php" style="text-decoration: underline;">Register now</a></p>

            <div class="d-grid">
                <button type="submit" class="btn btn-outline-secondary">Login</button>
            </div>
        </form>
    </div>
</div>