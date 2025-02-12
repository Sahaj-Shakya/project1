<?php 

session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';

if ($admin === '') {
    header('Location: login.php');
}

include '../app/connection.php';
include 'generate.php';



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
            <div class="bread d-flex justify-content-between">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4 ms-3">
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Main</li>
                    </ol>
                </nav>
            </div>

            <div class="container mt-4" style="max-width: 800px; max-height: 800px;">
                <!-- Display success or error message -->
                <?php if (isset($_SESSION['admin_message'])): ?>
                    <div class="alert alert-dismissible fade show <?php echo isset($error) && $error ? 'alert-danger' : 'alert-success'; ?>" role="alert">
                        <?php echo $_SESSION['admin_message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['admin_message']); ?>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Plan Seat</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-4">
                                <label class="form-label">Select Room</label>
                                <div class="d-flex flex-wrap">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-302" value="302">
                                        <label class="form-check-label" for="room-302">302</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-303" value="303">
                                        <label class="form-check-label" for="room-303">303</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-304" value="304">
                                        <label class="form-check-label" for="room-304">304</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-305" value="305">
                                        <label class="form-check-label" for="room-305">305</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-306" value="306">
                                        <label class="form-check-label" for="room-306">306</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-306" value="306">
                                        <label class="form-check-label" for="room-306">306</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-306" value="306">
                                        <label class="form-check-label" for="room-306">306</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-306" value="306">
                                        <label class="form-check-label" for="room-306">306</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-306" value="306">
                                        <label class="form-check-label" for="room-306">306</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-306" value="306">
                                        <label class="form-check-label" for="room-306">306</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-306" value="306">
                                        <label class="form-check-label" for="room-306">306</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-306" value="306">
                                        <label class="form-check-label" for="room-306">306</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-306" value="306">
                                        <label class="form-check-label" for="room-306">306</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-306" value="306">
                                        <label class="form-check-label" for="room-306">306</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="room-306" value="306">
                                        <label class="form-check-label" for="room-306">306</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Class Selection -->
                            <div class="mb-4">
                                <label class="form-label">Select Students</label>
                                <div class="d-flex flex-wrap">
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="kit-sem" value="kit-sem">
                                        <label class="form-check-label" for="kit-sem">bca first Semester</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="and-sem" value="and-sem">
                                        <label class="form-check-label" for="and-sem">bca first Semester</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="end-sem" value="end-sem">
                                        <label class="form-check-label" for="end-sem">bca first Semester</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="end-sem" value="end-sem">
                                        <label class="form-check-label" for="end-sem">bca first Semester</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="end-sem" value="end-sem">
                                        <label class="form-check-label" for="end-sem">bca first Semester</label>
                                    </div>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" id="end-sem" value="end-sem">
                                        <label class="form-check-label" for="end-sem">bca first Semester</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Generate</button>
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