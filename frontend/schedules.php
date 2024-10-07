<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Schedules</title>

    <style>
        .image_container {
            position: relative;
        }

        .image:hover {
            background-blend-mode: darken;
        }

        .icons{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            gap: 10px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .image_container:hover .icons {
            opacity: 1;
        }

        .icons i {
            font-size: 24px;
            color: white;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.35);
            padding: 10px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <?php include 'nav.php' ?>

    <div class="container d-flex flex-column flex-lg-row w-100 col-lg-7">
        <div class="container container_left col-lg-8 mb-2">
            <div class="d-flex flex-column flex-md-row align-items-start gap-3 p-3">
                <div class="container">
                    <h4 class="text mb-3">BCA 4th Sem Routine</h4>
                    <p>Date: 20 August - 30 August</p>
                    <p>Time: 3hrs</p>
                </div>
                <div class="image_container">
                    <img src="routine.jpg" class="img-thumbnail img-fluid full_img image" alt="Routine" style="max-width: 300px;">
                    
                    <div class="icons">
                        <a href=".full_img"><i class="bi bi-arrows-fullscreen"></i></a>
                        <a href="routine.jpg" download=""><i class="bi bi-download"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>

</body>

</html>