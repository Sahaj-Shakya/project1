<?php
include 'connection.php';

$news_query = "SELECT * FROM `news`";
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


    <?php while ($row = mysqli_fetch_assoc($result)) {
    $title = $row['title'];
    $description = $row['description'];
    $image = $row['image'];
    echo "<div class='container container_news mb-3'>";
        echo "<div class='container mb-2'>";
            echo "<div class='row mt-4'>";

                echo "<div class='container_img d-flex justify-content-center col-md-4 mb-3'>";
                    echo "<img style='width: 100%; max-height: 230px; object-fit: cover;' src='$image' class='img-fluid rounded' alt='News Image'>";
                echo "</div>";

                echo "<div class='container_details col-md-8 mb-3'>";
                    echo "<h4>$title</h4>";
                    echo "<p style='display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;'>$description</p>";
                    echo "<a href='#' class='btn btn-outline-primary'>See more</a>";
                echo "</div>";

            echo "</div>";
        echo "</div>";
    echo "</div>";
} ?>

    <?php include 'footer.php' ?>

</body>

</html>