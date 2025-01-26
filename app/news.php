<?php
include 'connection.php';

$news_query = "SELECT * FROM `news` ORDER BY `sn` DESC";
$result = mysqli_query($conn, $news_query);


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
</head>

<body>
    <?php include 'nav.php' ?>


    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <?php
        $sn = $row['sn'];
        $title = $row['title'];
        $description = $row['description'];
        $image = $row['image'];
        ?>

        <div class='container container_news mb-3'>
            <div class='container mb-2'>
                <div class='row mt-4'>
                    <div class='container_img d-flex justify-content-center col-md-4 mb-3'>
                        <img style='width: 100%; max-height: 230px; object-fit: cover;' src='<?php echo $image ?>' class='img-fluid rounded' alt='News Image'>
                    </div>
                    <div class='container_details col-md-8 mb-3'>
                        <h4 style='display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;'><?php echo $title ?></h4>
                        <p style='display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;'><?php echo $description ?></p>
                        <a href='news_view.php?sn=<?php echo $sn; ?>' class='btn btn-outline-primary'>See more</a>
                    </div>
                </div>
            </div>
        </div>

    <?php endwhile; ?>

    <?php include 'footer.php' ?>

</body>

</html>