<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';

if ($admin === '') {
    header('Location: login.php');
}

include "../app/connection.php";

$schedules_query = "SELECT * FROM `schedules`";
$result = mysqli_query($conn, $schedules_query);

$error = false;
$message = '';

function validate($title, $start_date, $end_date, $time, $img)
{
    global $error, $message;
    if (trim($title) === '' || trim($start_date) === '' || trim($end_date) === '' || trim($img) === '' || trim($time) === '') {
        $error = true;
        $message = 'Fill all the form fields.';
        return false;
    }

    if (strlen($title) > 255) {
        $error = true;
        $message = 'Title is too long.';
        return false;
    }

    $start_date_obj = DateTime::createFromFormat('Y-m-d', $start_date);
    $end_date_obj = DateTime::createFromFormat('Y-m-d', $end_date);
    if (!$start_date_obj || !$end_date_obj || $start_date_obj->format('Y-m-d') !== $start_date || $end_date_obj->format('Y-m-d') !== $end_date) {
        $error = true;
        $message = 'Invalid date format. Please use YYYY-MM-DD.';
        return false;
    }

    if ($start_date_obj > $end_date_obj) {
        $error = true;
        $message = 'Start date cannot be greater than end date.';
        return false;
    }

    $extentions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $file_extension = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    if (!in_array($file_extension, $extentions)) {
        $error = true;
        $message = 'Invalid image file type.';
        return false;
    }

    return true;
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $start_date = $_POST['start'];
    $end_date = $_POST['end'];
    $time = $_POST['time'];
    // $img = $_POST['img'];


    $img = $_FILES['img']['name'];
    // echo $img;
    $img_tmp = $_FILES['img']['tmp_name'];


    $target_directory = '../images/';
    $target_file = $target_directory . basename($img);

    if (validate($title, $start_date, $end_date, $time, $img)) {
        if (move_uploaded_file($img_tmp, $target_file)) {
            $insert_query = "INSERT INTO `schedules` (`title`, `start_date`, `end_date`, `time`, `image`, `created/edited_by`) VALUES ('$title', '$start_date', '$end_date', '$time', '$target_file', '$admin');";

            if (mysqli_query($conn, $insert_query)) {
                $_SESSION['admin_message'] = 'Schedule added!';
                header('Location: schedules.php');
            }
            //  else {
            //     $message = "Error: " . mysqli_error($conn);
            //     echo $message;
            // }
        } else {
            $_SESSION['admin_message'] = 'file is not uploaded!';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Schedules</title>
</head>

<body>
    <div class="main">
        <?php include "leftside.php" ?>



        <div class="right-side">
            <div class="bread d-flex justify-content-between">
                <nav aria-label">
                    <ol class="breadcrumb mt-4 ms-3">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item"><a href="schedules.php">Schedules</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Schedules</li>
                    </ol>
                </nav>
                <div class="add mt-4 me-3">
                    <a href="news_add.php" class="btn btn-primary">something</a>
                </div>
            </div>

            <?php if ($error === true): ?>
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                <?php echo $message ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="container border p-2 shadow mt-5" style="border-radius: 10px; max-width: 1000px;">
                <div class="container p-3">
                    <h4 class="text-center">Add Schedules</h4>
                    <hr>
                    <form method="post" action="schedules_add.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Schedule Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter title" required>
                        </div>

                        <div class="mb-3">
                            <label for="start" class="form-label">Start Date</label>
                            <input name="start" class="form-control" type="date" id="start" required>
                        </div>

                        <div class="mb-3">
                            <label for="end" class="form-label">End Date</label>
                            <input name="end" class="form-control" type="date" id="end" required>
                        </div>

                        <div class="mb-3">
                            <label for="time" class="form-label">Time</label>
                            <input name="time" class="form-control" type="text" maxlength="20" placeholder="Enter time(eg: 1am - 2am)" id="time" required>
                        </div>

                        <div class="mb-3">
                            <label for="img" class="form-label">Image</label>
                            <input name="img" type="file" class="form-control" id="img-input" required accept="image/*">

                            <div class="img-preview mt-2">
                                <img id="img-preview" src="#" alt="Image Preview" style="display: none; max-width: 20%; height: auto;" />
                            </div>
                        </div>


                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" name="submit" class="btn btn-outline-primary">Add</button>
                            <a href="schedules.php" class="btn btn-outline-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <?php include "sidebar.php" ?>



    <script>
        const imgInput = document.getElementById('img-input');
        const imgPreview = document.getElementById('img-preview');

        imgInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                    imgPreview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                imgPreview.style.display = 'none';
                imgPreview.src = '#';
            }
        });
    </script>

</body>

</html>