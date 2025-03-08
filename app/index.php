<?php
session_start();

include 'connection.php';

// Fetch news
$news_query = "SELECT * FROM `news`";
$result = mysqli_query($conn, $news_query);


// Handle search request
$search_result = null;
$search_message = ''; // Variable to store search validation message
$roll_no = ''; // Initialize roll number variable
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $roll_no = mysqli_real_escape_string($conn, $_GET['search']); // Sanitize input
    $search_query = "SELECT * FROM seat_plan WHERE roll_no = '$roll_no'";
    $search_result = mysqli_query($conn, $search_query);

    if (!$search_result || mysqli_num_rows($search_result) === 0) {
        $search_message = "No seat details found for roll number: $roll_no";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php' ?>

    <!-- Main Content -->
    <div class="container flex-column flex-sm-row d-flex w-100 col-lg-7 gap-4 mt-3">
        <!-- Search Section -->
        <div class="container container_left col-lg-4 ps-2 pe-2" style="max-height: 400px;">
            <div class="row justify-content-center">
                <div class="container p-2">
                    <h4 class="ps-3 pt-2">Search My Seat</h4>
                    <hr>
                    <form method="GET" action="" class="d-flex flex-column flex-sm-row ps-3 pe-3 pb-3" role="search" autocomplete="off">
                        <input class="form-control search me-0 me-sm-2 mb-2 mb-sm-0" type="search" name="search" placeholder="Enter Roll Number" aria-label="Search" value="<?php echo htmlspecialchars($roll_no); ?>">
                        <button class="btn btn-search btn-outline-secondary" type="submit">Search</button>
                    </form>
                </div>
            </div>

            <!-- Display Search Results or Validation Message -->
            <div class="container p-3 overflow-auto">
                <?php if ($search_result && mysqli_num_rows($search_result) > 0): ?>
                    <?php $student = mysqli_fetch_assoc($search_result); ?>
                    <div class="card border p-3">
                        <p class="card-text"><strong>Name:</strong> <?php echo $student['name']; ?></p>
                        <p class="card-text"><strong>Roll No:</strong> <?php echo $student['roll_no']; ?></p>
                        <p class="card-text"><strong>Room No:</strong> <?php echo $student['room_no']; ?></p>
                        <p class="card-text"><strong>Bench:</strong> <?php echo $student['bench_no']; ?></p>
                        <p class="card-text"><strong>Side:</strong> <?php echo $student['side']; ?></p>
                    </div>
                <?php elseif (!empty($search_message)): ?>
                    <div class="alert alert-warning" role="alert">
                        <?php echo $search_message; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">Enter your roll number in the search box and click "Search" to find your seat planning.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent News Section -->
        <div class="container container_right p-2">
            <div class="container p-2">
                <h4>Recent News</h4>
                <hr>
                <ul class="list-group" style="max-height: 296px; overflow-y:auto;">
                    <?php $counter = 0; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php if ($counter === 5) break; ?>
                        <li class="list-group-item"><?php echo "<a href='news_view.php?sn={$row['sn']}'>{$row['title']}</a>"; ?></li>
                        <?php $counter++; ?>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>


    <?php include 'footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>