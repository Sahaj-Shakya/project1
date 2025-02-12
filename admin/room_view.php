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
                        <li class="breadcrumb-item active" aria-current="page">Seat Plan</li>
                    </ol>
                </nav>
            </div>
            
            <div class="container mt-4" style="max-width: 800px; overflow-y: scroll; max-height: 800px;">
                <h4 class="mb-4">Room Seat Plan</h4>
                
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
                        <!-- Example rows (Replace with dynamic data in PHP) -->
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>12345</td>
                            <td>5th</td>
                            <td>Computer Science</td>
                            <td>3</td>
                            <td>Left</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>67890</td>
                            <td>6th</td>
                            <td>Electronics</td>
                            <td>5</td>
                            <td>Right</td>
                        </tr>
                        <!-- Dynamic rows will be added here -->
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
