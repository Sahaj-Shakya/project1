<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';
if ($admin === '') {
    header('Location: login.php');
    exit;
}

include '../app/connection.php';

if (!isset($_GET['room_sn'])) {
    header('Location: room.php');
    exit;
}

$room_sn = intval($_GET['room_sn']); 

$query = "
    SELECT 
        seat_plan.*, 
        rooms.room_no,
        students.roll_no 
    FROM 
        seat_plan 
    JOIN 
        rooms 
    ON 
        seat_plan.room_sn = rooms.sn 
    JOIN 
        students 
    ON 
        seat_plan.roll_no = students.roll_no 
    WHERE 
        seat_plan.room_sn = ? 
    ORDER BY 
        bench_no, side
";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $room_sn);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch the room_no for display
$room_no = '';
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $room_no = $row['room_no'];
    mysqli_data_seek($result, 0); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Seat Plan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="main">
        <?php include "leftside.php"; ?>

        <div class="right-side">
            <div class="bread d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4 ms-3">
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item"><a href="room.php">Rooms</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Seat Plan for Room <?php echo htmlspecialchars($room_no); ?></li>
                    </ol>
                </nav>
                <a href="room.php" class="btn btn-primary mt-4 me-3">Back to Room List</a>
            </div>

            <div class="container mt-4" style="max-width: 800px; overflow-y: scroll; max-height: 800px;">
                <h4 class="mb-4">Room <?php echo htmlspecialchars($room_no); ?> Seat Plan</h4>

                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Roll No</th>
                            <th>Semester</th>
                            <th>Faculty</th>
                            <th>Bench No</th>
                            <th>Side</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn = 1;
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>{$sn}</td>
                                    <td>" . htmlspecialchars($row['name']) . "</td>
                                    <td>" . htmlspecialchars($row['roll_no']) . "</td>
                                    <td>" . htmlspecialchars($row['semester']) . "</td>
                                    <td>" . htmlspecialchars($row['faculty']) . "</td>
                                    <td>" . htmlspecialchars($row['bench_no']) . "</td>
                                    <td>" . htmlspecialchars($row['side']) . "</td>
                                  </tr>";
                                $sn++;
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No seats assigned for this room.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include "sidebar.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>