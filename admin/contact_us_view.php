<?php

session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';

if ($admin === '') {
    header('Location: login.php');
}

include "../app/connection.php";

if(isset($_GET['sn'])){

    $sn = $_GET['sn'];

    $contact_query = "SELECT * FROM `contact_us` WHERE `sn` = '$sn'";
    $result = mysqli_query($conn, $contact_query);
    
    if ($result->num_rows > 0) {
        $contact = $result->fetch_assoc();
    } else {
        $_SESSION['view_message'] = "No contact found with the specified ID.";
        header('Location: contact_us.php');
        exit();
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="main">
        <?php include "leftside.php" ?>

        <div class="right-side">
            <div class="bread d-flex justify-content-between">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4 ms-3">
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item"><a href="contact_us.php">Contact Us</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Contact</li>
                    </ol>
                </nav>
                <div class="add mt-4 me-3">
                    <a href="contact_us.php" class="btn btn-secondary">Back to List</a>
                </div>
            </div>

            <div class="container border p-4 mt-5" style="border-radius: 10px; max-width: 800px;">
                <h4 class="text-center">View Contact</h4>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" value="<?php echo $contact['name']; ?>" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" value="<?php echo $contact['email']; ?>" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone No</label>
                        <input type="text" id="phone" class="form-control" value="<?php echo $contact['phone']; ?>" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="text" id="date" class="form-control" value="<?php echo substr($contact['created_at'], 0, 10); ?>" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <textarea id="subject" class="form-control" rows="2" style="resize: none;" disabled><?php echo $contact['subject']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" class="form-control" rows="5" disabled><?php echo $contact['message']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "sidebar.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

