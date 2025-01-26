<?php
include 'connection.php';

$schedules_query = "SELECT * FROM `schedules` ORDER BY `sn` DESC";
$result = mysqli_query($conn, $schedules_query);


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Schedules</title>

</head>

<body>
    <?php include 'nav.php'; ?>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <?php
        $title = $row['title'];
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];
        $time = $row['time'];
        $img = $row['image'];
        ?>
        <div class="container container_left col-lg-6 col-md-8 mb-2 p-3">
            <div class="d-flex flex-column flex-lg-row align-items-start gap-3 pt-3 pb-3">
                <div class="container">
                    <h4 class="text mb-4"><?php echo $title; ?></h4>
                    <div class="row mb-2">
                        <div class="col-4 col-md-3 text-start"><strong>Start Date</strong></div>
                        <div class="col"><span>: <?php echo $start_date; ?></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-3 text-start"><strong>End Date</strong></div>
                        <div class="col"><span>: <?php echo $end_date; ?></span></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4 col-md-3 text-start"><strong>Time</strong></div>
                        <div class="col"><span>: <?php echo $time; ?></span></div>
                    </div>
                </div>
                <div class="image_container">
                    <img src="<?php echo $img; ?>" class="img-thumbnail img-fluid full_img image" alt="Routine" style="max-width: 350px; height: auto;">
                    <div class="icons mt-2 d-flex gap-3">
                        <span><i title="full-screen" class="bi bi-zoom-in"></i></span>
                        <a href="<?php echo $img; ?>" download title="download"><i class="bi bi-download"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="image-popup">
            <img src="" alt="full screen image">

            <a title="download" href="examcenter.jpg" download=""><i class="bi bi-download" style="font-size: 25px;"></i></a>
            <span title="exit"><i class="bi bi-x-lg" style="font-size: 25px;"></i></span>

        </div>
    <?php endwhile; ?>

    <?php include 'footer.php'; ?>

    <script>
        document.querySelectorAll('.bi-zoom-in').forEach(icon => {
            icon.addEventListener('click', function() {
                const imgSrc = this.closest('.image_container').querySelector('img').getAttribute('src');
                const popup = document.querySelector('.image-popup');
                popup.style.display = 'flex';
                popup.querySelector('img').src = imgSrc;
                document.querySelector('nav').style.zIndex = '-1';
            });
        });

        document.querySelector('.image-popup span').addEventListener('click', function() {
            document.querySelector('.image-popup').style.display = 'none';
            document.querySelector('nav').style.zIndex = '1';
        });
    </script>


</body>

</html>