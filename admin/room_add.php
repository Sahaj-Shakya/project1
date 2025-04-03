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

if (isset($_POST['add_room'])) {
    $room_no = trim($_POST['room_no']);

    if ($room_no === '') {
        $error = true;
        $message = 'Room number is required.';
    } else {
        // Check if the room number already exists
        $check_query = "SELECT * FROM `rooms` WHERE `room_no` = '$room_no' LIMIT 1";
        $check_result = mysqli_query($conn, $check_query);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            $error = true;
            $message = 'Room number already exists.';
        } else {
            // Insert the new room into the database
            $insert_query = "INSERT INTO `rooms` (`room_no`) VALUES ('$room_no')";

            if (mysqli_query($conn, $insert_query)) {
                $_SESSION['admin_message'] = 'Room added successfully!';
                header('Location: room.php');
                exit;
            } else {
                $error = true;
                $message = 'Error adding room. Please try again.';
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
    <title>Add New Room</title>
</head>

<body>
    <div class="main">
        <?php include "leftside.php"; ?>

        <div class="right-side">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-4 ms-3">
                    <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                    <li class="breadcrumb-item"><a href="room.php">Rooms List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Room</li>
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

                <h4 class="mb-4">Add New Room</h4>

                <form method="POST" class="border p-4">
                    <div class="mb-3">
                        <label for="room_no" class="form-label">Room Number</label>
                        <input type="text" name="room_no" id="room_no" class="form-control" value="<?php echo isset($room_no) ? htmlspecialchars($room_no) : ''; ?>" required>
                    </div>

                    <div class="container d-flex justify-content-end gap-2">
                        <button type="submit" name="add_room" class="btn btn-primary">Add Room</button>
                        <a href="room.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include "sidebar.php"; ?>
</body>

</html>
