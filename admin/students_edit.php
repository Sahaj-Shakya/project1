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

    // Fetch student data using prepared statement
    $query = "SELECT * FROM `students` WHERE `sn` = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $sn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $faculty = $row['faculty'];
        $roll_no = $row['roll_no'];
        $semester = $row['semester'];
        $original_roll_no = $roll_no; // Store the original roll number for comparison
    } else {
        $error = true;
        $message = 'Student not found.';
    }
} else {
    $error = true;
    $message = 'Invalid student ID.';
}

// Handle form submission for updating the student
if (isset($_POST['update_student']) && !$error) {
    $name = trim($_POST['name']);
    $roll_no = trim($_POST['roll_no']);
    $faculty = trim($_POST['faculty']);
    $semester = trim($_POST['semester']);
    
    // Validate inputs
    if (empty($name) || empty($roll_no) || empty($faculty) || empty($semester)) {
        $error = true;
        $message = 'All fields are required.';
    } elseif (!is_numeric($roll_no)) {
        $error = true;
        $message = 'Roll number must contain only numbers.';
    } elseif ($roll_no < 0) {
        $error = true;
        $message = 'Roll number cannot be a negative number.';
    } elseif (strlen($roll_no) > 10) { // Example: Limit roll number to 10 characters
        $error = true;
        $message = 'Roll number cannot exceed 10 characters.';
    } else {
        $need_to_check_duplicate = ($roll_no != $original_roll_no); // Only check for duplicates if roll number changed
        
        if ($need_to_check_duplicate) {
            // Check if another student exists with the same roll number
            $check_query = "SELECT * FROM `students` WHERE `roll_no` = ? AND `sn` != ?";
            $check_stmt = mysqli_prepare($conn, $check_query);
            mysqli_stmt_bind_param($check_stmt, "ii", $roll_no, $sn);
            mysqli_stmt_execute($check_stmt);

            
            $check_result = mysqli_stmt_get_result($check_stmt);

            if (mysqli_num_rows($check_result) > 0) {
                $error = true;
                $message = 'This roll number already exists';
            }
        }
        
        // If no duplicate error, proceed with updating
        if (!$error) {
            // No conflict found, proceed with updating the student
            $update_query = "UPDATE `students` SET `name` = ?, `roll_no` = ?, `faculty` = ?, `semester` = ? WHERE `sn` = ?";
            $update_stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($update_stmt, "sissi", $name, $roll_no, $faculty, $semester, $sn);
            
            if (mysqli_stmt_execute($update_stmt)) {
                $_SESSION['admin_message'] = 'Student details updated successfully!';
                header('Location: students.php');
                exit;
            } else {
                $error = true;
                $message = 'Error updating student: ' . mysqli_error($conn);
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
                <?php else: ?>
                    <div class="text-center">
                        <h4>Student not found</h4>
                        <a href="students.php" class="btn btn-primary mt-3">Back to Students List</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include "sidebar.php"; ?>
</body>

</html>