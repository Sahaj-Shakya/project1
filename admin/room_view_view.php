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

$room_sn = $_GET['room_sn'];

// Seat plan for room
$query = "SELECT * FROM seat_plan WHERE room_sn = '$room_sn' ORDER BY bench_no, side";
$result = mysqli_query($conn, $query);
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
            <div class="bread d-flex justify-content-between">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4 ms-3">
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item"><a href="room.php">Rooms</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Seat Plan for Room <?php echo htmlspecialchars($room_sn); ?></li>
                    </ol>
                </nav>
            </div>

            <div class="container mt-4" style="max-width: 800px; overflow-y: scroll; max-height: 800px;">
                <h4 class="mb-4">Room <?php echo htmlspecialchars($room_sn); ?> Seat Plan</h4>

                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 120px;">Bench No</th>
                            <th colspan="2">Left</th>
                            <th colspan="2">Right</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $benches = [];
                        while ($row = mysqli_fetch_assoc($result)) {
                            $benches[$row['bench_no']][] = $row['roll_no'];
                        }

                        // Display bench
                        $sno = 1;
                        foreach ($benches as $bench_no => $roll_nos) {
                            echo "<tr>";
                            echo "<td>{$sno}</td>";
                            $sno++;

                            // Left side
                            for ($i = 0; $i < 2; $i++) {
                                echo "<td>" . (isset($roll_nos[$i]) ? htmlspecialchars($roll_nos[$i]) : '') . "</td>";
                            }

                            // Right side
                            for ($i = 2; $i < 4; $i++) {
                                echo "<td>" . (isset($roll_nos[$i]) ? htmlspecialchars($roll_nos[$i]) : '') . "</td>";
                            }

                            echo "</tr>";
                        }

                        if (empty($benches)) {
                            echo "<tr><td colspan='5' class='text-center'>No seats assigned for this room.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <a href="room.php" class="btn btn-primary mt-3">Back to Room List</a>
            </div>
        </div>
    </div>

    <?php include "sidebar.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>