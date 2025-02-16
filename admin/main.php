<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';
if ($admin === '') {
    header('Location: login.php');
    exit; // Ensure no further code is executed after redirection
}

include '../app/connection.php';
include 'generate.php'; // Include the file containing seat planning logic

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 1: Get selected rooms and semesters from the form
    $selectedRooms = $_POST['rooms'] ?? [];
    $selectedBca = $_POST['bca-semesters'] ?? [];
    $selectedBbm = $_POST['bbm-semesters'] ?? [];

    // Step 2: Validate input
    if (empty($selectedRooms) || empty($selectedBca) || empty($selectedBbm)) {
        $_SESSION['admin_message'] = 'Please select at least one room and one semester for both BCA and BBM.';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    // Step 3: Fetch students for the selected semesters
    $bcaStudents = fetchStudents($selectedBca, 'BCA', $conn);
    $bbmStudents = fetchStudents($selectedBbm, 'BBM', $conn);

    // Step 4: Generate seat plan
    $seatPlan = planSeat($bcaStudents, $bbmStudents);
    extract($seatPlan); // Extract 'a', 'b', 'c', 'd' from the generated seat plan

    // Step 5: Assign students to rooms
    $roomAssignments = assignRoom($a, $b, $c, $d, $selectedRooms);

    // Step 6: Store the seat plan in the database
    $isStored = storeSeatPlan($roomAssignments, $conn, $selectedBca, $selectedBbm);

    // Step 7: Set success or error message
    if ($isStored) {
        $_SESSION['admin_message'] = 'Seat plan has been successfully stored in the database!';
    } else {
        $_SESSION['admin_message'] = 'There was an error saving the seat plan! Please try again.';
    }

    // Step 8: Redirect back to the same page to display the message
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch rooms from the database for the form
$room_query = "SELECT * FROM `rooms`";
$room_result = mysqli_query($conn, $room_query);

// Function to fetch students for selected semesters
function fetchStudents($semesters, $program, $conn) {
    $students = [];
    if (!empty($semesters)) {
        $semesterNumbers = array_map(function ($s) {
            return preg_replace('/\D/', '', $s); // Extract semester number
        }, $semesters);
        $semesterList = implode("','", $semesterNumbers);

        // Query to fetch student roll_no, name, semester, and faculty
        $query = "SELECT roll_no, name, semester, faculty FROM students WHERE faculty = '$program' AND semester IN ('$semesterList')";
        $result = mysqli_query($conn, $query);

        // Store student roll_no, name, semester, and faculty
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = [
                'roll_no' => $row['roll_no'],
                'name' => $row['name'],
                'semester' => $row['semester'],
                'faculty' => $row['faculty']
            ];
        }
    }
    return $students;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Plan Seat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="main">
        <?php include "leftside.php"; ?>

        <div class="right-side">
            <!-- Display admin message -->
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
            <div class="container mt-4" style="max-width: 800px;">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Plan Seat</h5>
                    </div>
                    <div class="card-body">

                        <form method="post" action="">
                            <div class="mb-4">
                                <label class="form-label">Select Rooms</label>
                                <div class="d-flex flex-wrap">
                                    <?php while ($row = mysqli_fetch_assoc($room_result)): ?>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" name="rooms[]" value="<?php echo $row['room_no']; ?>">
                                            <label class="form-check-label">Room <?php echo $row['room_no']; ?></label>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Select BCA Semesters</label>
                                <div class="d-flex flex-wrap">
                                    <?php for ($i = 1; $i <= 8; $i++): ?>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" name="bca-semesters[]" value="bca-<?php echo $i; ?>">
                                            <label class="form-check-label">BCA <?php echo $i; ?> Semester</label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Select BBM Semesters</label>
                                <div class="d-flex flex-wrap">
                                    <?php for ($i = 1; $i <= 8; $i++): ?>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="checkbox" name="bbm-semesters[]" value="bbm-<?php echo $i; ?>">
                                            <label class="form-check-label">BBM <?php echo $i; ?> Semester</label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Generate and Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>