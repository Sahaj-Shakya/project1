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

if (isset($_GET['sn'])) {
    $sn = intval($_GET['sn']);

    // Fetch student data
    $query = "SELECT * FROM `students` WHERE `sn` = '$sn' LIMIT 1;";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $faculty = $row['faculty'];
        $roll_no = $row['roll_no'];
        $semester = $row['semester']; // Fetch semester data
    } else {
        $error = true;
        $message = 'Student not found.';
    }
} else {
    $error = true;
    $message = 'Invalid student ID.';
}

// Handle form submission for updating the student
if (isset($_POST['update_student'])) {
    $name = trim($_POST['name']);
    $roll_no = trim($_POST['roll_no']);
    $faculty = trim($_POST['faculty']);
    $semester = trim($_POST['semester']); // Get the semester value

    if ($name === '' || $roll_no === '' || $faculty === '' || $semester === '') {
        $error = true;
        $message = 'All fields are required.';
    } else {
        // Check if another student exists with the same roll number and faculty (excluding the current student)
        $check_query = "SELECT * FROM `students` WHERE `roll_no` = '$roll_no' AND `faculty` = '$faculty' AND `semester` = '$semester' AND `sn` != '$sn'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $error = true;
            $message = 'This roll number already exists in the same faculty and semester.';
        } else {
            // No conflict found, proceed with updating the student
            $update_query = "
                UPDATE `students`
                SET 
                    `name` = '$name',
                    `roll_no` = '$roll_no',
                    `faculty` = '$faculty',
                    `semester` = '$semester'  -- Update the semester
                WHERE `sn` = '$sn';
            ";

            if (mysqli_query($conn, $update_query)) {
                $_SESSION['admin_message'] = 'Details Updated Successfully!';
                header('Location: students.php');
            } else {
                $_SESSION['admin_message'] = 'Something went wrong!';
                header('Location: students.php');
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>

<body>
    <div class="main">
        <?php include "leftside.php"; ?>

        <div class="right-side">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-4 ms-3">
                    <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                    <li class="breadcrumb-item"><a href="students.php">Students List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
                </ol>
            </nav>

            <div class="container mt-4" style="max-width: 600px;">
                <!-- Display success or error message -->
                <?php if ($message): ?>
                    <div class="alert <?php echo $error ? 'alert-danger' : 'alert-success'; ?> alert-dismissible fade show" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($row)): ?>
                    <form method="POST" class="border p-4">
                        <h4 class="mb-4">Edit Student Detail</h4>
                        <div class="mb-3">
                            <label for="name" class="form-label">Student Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="roll_no" class="form-label">Roll No</label>
                            <input type="text" name="roll_no" id="roll_no" class="form-control" value="<?php echo htmlspecialchars($roll_no); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="faculty" class="form-label">Class Name</label>
                            <input type="text" name="faculty" id="faculty" class="form-control" value="<?php echo htmlspecialchars($faculty); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="text" name="semester" id="semester" class="form-control" value="<?php echo htmlspecialchars($semester); ?>" required>
                        </div>

                        <div class="container d-flex justify-content-end gap-2">
                            <button type="submit" name="update_student" class="btn btn-primary">Update Student</button>
                            <a href="students.php" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include "sidebar.php"; ?>
</body>

</html>
