<?php
include 'connection.php';

if(isset($_GET['sn'])){    
    $sn = $_GET['sn'];
}

$news_query = "SELECT * FROM `news` WHERE `sn` = $sn LIMIT 1";
$result = mysqli_query($conn, $news_query);

$row = mysqli_fetch_assoc($result);
$img = $row['image'];
$title = $row['title'];
$desc = $row['description'];

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
</head>

<body>

    <?php include 'nav.php' ?>
    <div class="container w-100 col-lg-8">
        <div class="container container_left p-4 col-lg-9">
            <div class="container mb-4">
                <h2 style="text-align: center;"><?php echo $title ?></h2>
            </div>
            <div class="container d-flex justify-content-center mb-4">
                <img src="<?php echo $img ?>" alt="img">
            </div>
            <div class="container">
                <p><?php echo $desc ?></p>
            </div>
        </div>
    </div>


    <?php include 'footer.php' ?>
</body>

</html>