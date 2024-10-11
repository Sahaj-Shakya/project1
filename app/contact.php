<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
</head>

<body>
    <?php include 'nav.php' ?>
    <?php if ($username == ''): ?>
        <div class="container col-4">
            <div class="alert alert-secondary alert-dismissible fade show" role="alert" style="color: rgba(255, 0, 0, 0.7);">
                Note: You have to be Signed In to contact us.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>

    <?php endif; ?>
    <div class="container container_left p-3 col-lg-6">
        <h4 class="text mb-4 ">Contact us</h4>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="name" class="form-control" id="name" placeholder="Enter name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" required>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea rows="6" cols="30" class="form-control" id="message" placeholder="Enter your message here.." required></textarea>
            </div>


            <div class="d-grid">
                <button type="submit" class="btn btn-outline-secondary">Submit</button>
            </div>
        </form>
    </div>

    <?php include 'footer.php' ?>
</body>

</html>