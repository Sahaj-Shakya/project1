<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';
if ($admin === '') {
    header('Location: login.php');
    exit;
}

include '../app/connection.php';
include 'generate.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedRooms = $_POST['rooms'] ?? [];
    $selectedSemesters = $_POST['semesters'] ?? [];

    // Validate the number of selected rooms and semesters
    if (count($selectedRooms) !== 2 || count($selectedSemesters) !== 2) {
        $_SESSION['admin_message'] = 'Please select exactly 2 rooms and 2 semesters.';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }


    $students = fetchStudents($selectedSemesters, $conn);

    // Check if students were fetched for the selected semesters
    if (empty($students)) {
        $_SESSION['admin_message'] = 'No students found for the selected semesters. Please try again.';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    // Generate seat plan
    $seatPlan = planSeat($students); // Generate seat plan
    extract($seatPlan); 

    // Assign rooms to the seat plan
    $roomAssignments = assignRoom($a, $b, $c, $d, $selectedRooms);

    // Store the seat plan in the database
    $isStored = storeSeatPlan($roomAssignments, $conn, $selectedSemesters);

    if ($isStored) {
        $_SESSION['admin_message'] = 'Seat plan has been successfully stored in the database!';
    } else {
        $_SESSION['admin_message'] = 'There was an error saving the seat plan! Please try again.';
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}


$room_query = "SELECT * FROM `rooms`";
$room_result = mysqli_query($conn, $room_query);

/**
 * Fetches students from the database based on selected semesters.
 */
function fetchStudents($semesters, $conn) {
    $students = [];
    if (!empty($semesters)) {
        $semesterNumbers = array_map(function ($s) {
            return preg_replace('/\D/', '', $s); 
        }, $semesters);
        $semesterList = implode("','", $semesterNumbers);

        $query = "SELECT DISTINCT sn, name, semester, faculty, roll_no 
                  FROM students 
                  WHERE semester IN ('$semesterList')";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = [
                'sn' => $row['sn'],
                'name' => $row['name'],
                'semester' => $row['semester'],
                'faculty' => $row['faculty'],
                'roll_no' => $row['roll_no']
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
    <style>
        .semester-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 0.5rem 1rem;
        }
    </style>
</head>

<body>
    <div class="main">
        <?php include "leftside.php"; ?>

        <div class="right-side">
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
                        <form method="post" action="" onsubmit="return validateForm()">
                            <!-- Room Selection -->
                            <div class="mb-4">
                                <label class="form-label">Select Rooms (Exactly 2)</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php while ($row = mysqli_fetch_assoc($room_result)): ?>
                                        <div class="form-check">
                                            <input class="form-check-input room-checkbox" type="checkbox" name="rooms[]" value="<?php echo $row['sn']; ?>">
                                            <label class="form-check-label">Room <?php echo $row['room_no']; ?></label>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <small class="text-danger" id="room-error"></small>
                            </div>

                            <!-- Semester Selection -->
                            <div class="mb-4">
                                <label class="form-label">Select Semesters (Exactly 2)</label>
                                <div class="semester-grid">
                                    <?php for ($i = 1; $i <= 8; $i++): ?>
                                        <div class="form-check">
                                            <input class="form-check-input semester-checkbox" type="checkbox" name="semesters[]" value="bca-<?php echo $i; ?>">
                                            <label class="form-check-label">BCA <?php echo $i; ?> Semester</label>
                                        </div>
                                    <?php endfor; ?>

                                    <?php for ($i = 1; $i <= 8; $i++): ?>
                                        <div class="form-check">
                                            <input class="form-check-input semester-checkbox" type="checkbox" name="semesters[]" value="bbm-<?php echo $i; ?>">
                                            <label class="form-check-label">BBM <?php echo $i; ?> Semester</label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                <small class="text-danger" id="semester-error"></small>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Generate and Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "sidebar.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            // Validate rooms
            const roomCheckboxes = document.querySelectorAll('.room-checkbox:checked');
            if (roomCheckboxes.length !== 2) {
                document.getElementById('room-error').textContent = 'Please select exactly 2 rooms.';
                return false;
            } else {
                document.getElementById('room-error').textContent = '';
            }

            // Validate semesters
            const semesterCheckboxes = document.querySelectorAll('.semester-checkbox:checked');
            if (semesterCheckboxes.length !== 2) {
                document.getElementById('semester-error').textContent = 'Please select exactly 2 semesters.';
                return false;
            } else {
                document.getElementById('semester-error').textContent = '';
            }

            return true;
        }
    </script>
</body>

</html>