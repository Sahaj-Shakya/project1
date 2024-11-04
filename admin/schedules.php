<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedules</title>
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
                        <li class="breadcrumb-item active" aria-current="page">Schedules</li>
                    </ol>
                </nav>
                <div class="add mt-4 me-3">
                    <a href="" class="btn btn-primary">Add Schedules</a>
                </div>
            </div>

            <div class="container border p-2" style="border-radius: 10px;">
                <div class="container p-3">
                    <h4 class="text-center">Schedules</h4>
                    <hr>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            <h5 class="d-flex align-items-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, optio.</h5>
                            <div class="actions">
                                <a href="" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-danger">Delete</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <h5 class="d-flex align-items-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, optio.</h5>
                            <div class="actions">
                                <a href="" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-danger">Delete</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <h5 class="d-flex align-items-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, optio.</h5>
                            <div class="actions">
                                <a href="" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-danger">Delete</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <h5 class="d-flex align-items-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, optio.</h5>
                            <div class="actions">
                                <a href="" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-danger">Delete</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include "sidebar.php" ?>


    

</body>

</html>