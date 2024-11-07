<?php

include "../app/connection.php";

$schedules_query = "SELECT * FROM `schedules`";
$result = mysqli_query($conn, $schedules_query);

if(isset($_POST['submit'])){
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Schedules</title>
</head>

<body>
    <div class="main">
        <?php include "leftside.php" ?>



        <div class="right-side">
            <div class="bread d-flex justify-content-between">
                <nav aria-label">
                    <ol class="breadcrumb mt-4 ms-3">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
                        <li class="breadcrumb-item"><a href="schedules.php">Schedules</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Schedules</li>
                    </ol>
                </nav>
                <div class="add mt-4 me-3">
                    <a href="news_add.php" class="btn btn-primary">something</a>
                </div>
            </div>

            <div class="container border p-2 shadow mt-5" style="border-radius: 10px; max-width: 1100px;">
                <div class="container p-3">
                    <h4 class="text-center">Add Schedules</h4>
                    <hr>
                    <form method="post" action="schedules_add.php">
                        <div class="mb-3">
                            <label for="title" class="form-label">Schedule Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter title" required>
                        </div>

                        <div class="mb-3">
                            <label for="start" class="form-label">Start Date</label>
                            <input name="start" class="form-control" type="date" id="start" required>
                        </div>

                        <div class="mb-3">
                            <label for="end" class="form-label">End Date</label>
                            <input name="end" class="form-control" type="date" id="end" required>
                        </div>

                        <div class="mb-3">
                            <label for="img" class="form-label">Image</label>
                            <input name="img" type="file" class="form-control" id="img-input" required accept="image/*">

                            <div class="img-preview mt-2">
                                <img id="img-preview" src="#" alt="Image Preview" style="display: none; max-width: 20%; height: auto;" />
                            </div>
                        </div>


                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" name="submit" class="btn btn-outline-primary">Add</button>
                            <a href="schedules.php" class="btn btn-outline-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <?php include "sidebar.php" ?>



    <script>
        const imgInput = document.getElementById('img-input');
        const imgPreview = document.getElementById('img-preview');

        imgInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imgPreview.src = e.target.result; 
                    imgPreview.style.display = 'block'; 
                };

                reader.readAsDataURL(file);
            } else {
                imgPreview.style.display = 'none';
                imgPreview.src = '#';
            }
        });
    </script>

</body>

</html>