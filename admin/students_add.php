<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';

if ($admin === '') {
    header('Location: login.php');
    exit;
}

include "../app/connection.php";

$error = false;
$message = '';

if (isset($_POST['submit'])) {
    $faculty = $_POST['faculty'];
    $semester = $_POST['semester'];
    $file = $_FILES['csv_file'];

    if ($file['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $file['tmp_name'];
        $file_name = $file['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        if ($file_ext == 'csv') {
            if (($handle = fopen($file_tmp, 'r')) !== false) {
                // Skip the first row (headers)
                $headers = fgetcsv($handle);

                while (($data = fgetcsv($handle)) !== false) {
                    $name = $data[0]; // Student name
                    $roll_no = $data[1]; // Roll number

                    // Check if the roll number already exists in the entire students table
                    $check_query = "SELECT * FROM students WHERE roll_no = '$roll_no'";
                    $check_result = mysqli_query($conn, $check_query);

                    if (mysqli_num_rows($check_result) > 0) {
                        // Roll number already exists in the database
                        $error = true;
                        $message = "There already exist a roll no in the database.";
                        break;
                    }

                    // Insert student data if no conflict found
                    $query = "INSERT INTO students (name, faculty, roll_no, semester) VALUES ('$name', '$faculty', '$roll_no', '$semester')";
                    $result = mysqli_query($conn, $query);

                    if (!$result) {
                        $error = true;
                        $message = 'Error inserting student data into database: ' . mysqli_error($conn);
                        break;
                    }
                }

                fclose($handle);

                if (!$error) {
                    $_SESSION['admin_message'] = 'Added Successfully!';
                    header('Location: students.php');
                    exit; // Ensure no further code is executed after redirection
                }
            } else {
                $error = true;
                $message = 'Failed to read the CSV file.';
            }
        } else {
            $error = true;
            $message = 'Please upload a valid CSV file.';
        }
    } else {
        $error = true;
        $message = 'Please upload a CSV file.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Add Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="main">
        <?php include "leftside.php"; ?>

        <div class="right-side">
            <div class="bread d-flex justify-content-between">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4 ms-3">
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item"><a href="students.php">Students List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Students</li>
                    </ol>
                </nav>
                <div class="add mt-4 me-3">
                    <a href="students.php" class="btn btn-primary">Back</a>
                </div>
            </div>

            <div class="container border p-3 mt-4" style="max-width: 800px;">
                <!-- Display any messages -->
                <?php if ($message): ?>
                    <div class="alert <?php echo $error ? 'alert-danger' : 'alert-success'; ?> alert-dismissible fade show" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <!-- Form to upload CSV -->
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="faculty" class="form-label">Faculty</label>
                        <input type="text" class="form-control" id="faculty" name="faculty" required>
                    </div>

                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="text" class="form-control" id="semester" name="semester" required>
                    </div>

                    <div class="mb-3">
                        <label for="csv_file" class="form-label">Upload CSV File</label>
                        <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required>
                        <small class="form-text text-muted">
                            Download an <a href="example.csv" download>example CSV file</a> to see the required format.
                        </small>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include "sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>