<?php
session_start();
// echo $_SESSION['username'];

$facts_file = '../scripts/new.txt'; 
$num_of_facts = 3;

$py_script = escapeshellcmd("python3 ../scripts/facts.py $facts_file $num_of_facts");

$output = shell_exec($py_script);

$output_array = json_decode($output, true);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

</head>

<body>
    <?php include 'nav.php' ?>

    <?php if ($_SESSION['message'] != ''): ?>
        <div class="container col-3">
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php unset($_SESSION['message']); ?>

    <?php endif; ?>

    <div class="container flex-column flex-sm-row d-flex w-100 col-lg-7 gap-5 mt-3">
        <div class="container container_left col-lg-4 ps-2 pe-2" style="max-height: 400px;">
            <div class="row justify-content-center">

                <div class="container p-2">
                    <h4 class="ps-3 pt-2">Search My Seat</h4>
                    <hr>
                    <form class="d-flex flex-column flex-sm-row ps-3 pe-3 pb-3" role="search">
                        <input class="form-control search me-0 me-sm-2 mb-2 mb-sm-0" type="search" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-search btn-outline-secondary" type="submit">Search</button>
                    </form>
                </div>


            </div>

            <p class="text-muted ps-3 pe-3" style="max-height: 296px; overflow-y:auto;">
                Enter your roll number in the search box and click "Search" to find your seat planning.
            </p>


        </div>


        <div class="container container_right p-2">
            <div class="container p-2">
                <h4>Recent News</h4>
                <hr>
                <ul class="list-group" style="max-height: 296px; overflow-y:auto;">
                    <li class="list-group-item">Exam schedule for Fall 2024 released.</li>
                    <li class="list-group-item">Last date to change exam centers is October 10th.</li>
                    <li class="list-group-item">Exam center will be revealed in the last of this month. Please be patient by then. Thenk you!</li>
                    <li class="list-group-item">Colleges will remain closed from baisakh to shrawan due to dashain and tihar. All the students are requested to celebrate dashain and tihar.</li>
                    <li class="list-group-item">Colleges will remain closed from baisakh to shrawan due to dashain and tihar. All the students are requested to celebrate dashain and tihar.</li>

                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="container container_trivia p-3">
            <h4>Did You Know?</h4>
            <hr>
            <ul class="list-group">
                <?php foreach($output_array as $line): ?>
                    <li class="list-group-item"><?php echo $line;?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <?php include 'footer.php' ?>



</body>

</html>