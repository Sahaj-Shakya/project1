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

// Fetch all rooms from the database
$query = "SELECT * FROM `rooms`";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $rooms = [];
}

// Handle delete room action
if (isset($_GET['delete_sn'])) {
    $delete_sn = intval($_GET['delete_sn']);

    // Delete room from the database
    $delete_query = "DELETE FROM `rooms` WHERE `sn` = '$delete_sn' LIMIT 1";
    if (mysqli_query($conn, $delete_query)) {
        $_SESSION['admin_message'] = 'Room deleted successfully!';
    } else {
        $_SESSION['admin_message'] = 'Error deleting room!';
    }

    header('Location: room.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rooms List</title>
</head>

<body>
    <div class="main">
        <?php include "leftside.php"; ?>

        <div class="right-side">
            <div class="bread d-flex justify-content-between">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4 ms-3">
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rooms</li>
                    </ol>
                </nav>
                <div class="add mt-4 me-3">
                    <a href="room_add.php" class="btn btn-primary">Add Room</a>
                </div>
            </div>

            <div class="container mt-4" style="max-width: 800px; overflow-y: scroll; max-height: 800px;">
                <!-- Display success or error message -->
                <?php if (isset($_SESSION['admin_message'])): ?>
                    <div class="alert alert-dismissible fade show <?php echo isset($error) && $error ? 'alert-danger' : 'alert-success'; ?>" role="alert">
                        <?php echo $_SESSION['admin_message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['admin_message']); ?>
                <?php endif; ?>

                <h4 class="mb-4">Rooms List</h4>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Room No</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($rooms) > 0): ?>
                            <?php $counter = 1; ?>
                            <?php foreach ($rooms as $room): ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo ($room['room_no']); ?></td>
                                    <td>
                                        <!-- Updated "View" button to use room_sn -->
                                        <a href="room_view.php?room_sn=<?php echo $room['sn']; ?>" class="btn btn-warning btn-sm">View</a>
                                        <a href="?delete_sn=<?php echo $room['sn']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this room?');">Delete</a>
                                    </td>
                                </tr>
                                <?php $counter++; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No rooms available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include "sidebar.php"; ?>
</body>

</html>