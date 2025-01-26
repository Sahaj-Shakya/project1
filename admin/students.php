<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';

if ($admin === '') {
    header('Location: login.php');
    exit;
}

include "../app/connection.php";

$query = "SELECT * FROM `students` ORDER BY `faculty` ASC";
$result = mysqli_query($conn, $query);

$error = false;
$message = '';

if (!$result) {
    $error = true;
    $message = 'Failed to fetch student data.';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Students List</title>
</head>

<body>
    <div class="main">
        <?php include "leftside.php"; ?>

        <div class="right-side">
            <div class="bread d-flex justify-content-between">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4 ms-3">
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Students List</li>
                    </ol>
                </nav>
                <div class="add mt-4 me-3">
                    <a href="students_add.php" class="btn btn-primary">Add Students</a>
                </div>
            </div>

            <div class="container mt-4" style="max-width: 1000px; overflow-y: scroll; max-height: 800px;">
                <!-- Display success or error message -->
                <?php if ($message): ?>
                    <div class="alert <?php echo $error ? 'alert-danger' : 'alert-success'; ?> alert-dismissible fade show" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['admin_message'])): ?>
                    <div class="container mt-2">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                    <?php echo $_SESSION['admin_message']; ?>
                                    <?php unset($_SESSION['admin_message']); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <h4 class="mb-4">List of Students</h4>

                <!-- Display students table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Class Name</th>
                            <th>Student Name</th>
                            <th>Roll No</th>
                            <th>Semester</th> <!-- Added Semester Column -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php $counter = 1; ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo htmlspecialchars($row['faculty']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['roll_no']); ?></td>
                                    <td><?php echo htmlspecialchars($row['semester']); ?></td> <!-- Display Semester -->
                                    <td>
                                        <!-- Add actions for each student (view/edit/delete) -->
                                        <a href="students_edit.php?sn=<?php echo $row['sn']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm" onclick="showConfirmation(<?php echo $row['sn']; ?>)">Delete</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No students found.</td> <!-- Adjusted colspan -->
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include "sidebar.php"; ?>


    <script>
        function showConfirmation(sn) {
            if (confirm("Confirm Delete?")) {
                // User clicked "Yes"
                window.location = `students_delete.php?sn=${sn}`
            }
        }
    </script>
</body>

</html>
