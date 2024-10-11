<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Schedules</title>

</head>

<body>
    <?php include 'nav.php' ?>

    <div class="container d-flex flex-column w-100 col-lg-7">
        <div class="container container_left col-lg-8 mb-2">
            <div class="d-flex flex-column flex-lg-row align-items-start gap-3 pt-3 pb-3">
                <div class="container">
                    <h4 class="text mb-3">BCA 4th Sem Routine</h4>
                    <p>Date: 20 August - 30 August</p>
                    <p>Time: 3hrs</p>
                </div>
                <div class="image_container">
                    <img src="routine.jpg" class="img-thumbnail img-fluid full_img image" alt="Routine" style="max-width: 300px; height: 200px">

                    <div class="icons">
                        <span><i class="bi bi-zoom-in" title="full-screen"></i></span>
                        <a href="routine.jpg" download title="download"><i class="bi bi-download"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container container_left col-lg-8 mb-2">
            <div class="d-flex flex-column flex-lg-row align-items-start gap-3 pt-3 pb-3">
                <div class="container">
                    <h4 class="text mb-3">BCA 4th Sem Routine</h4>
                    <p>Date: 20 August - 30 August</p>
                    <p>Time: 3hrs</p>
                </div>
                <div class="image_container">
                    <img src="examcenter.jpg" class="img-thumbnail img-fluid full_img image" alt="Routine" style="max-width: 300px; height: 200px">

                    <div class="icons">
                        <span><i title="full-screen" class="bi bi-zoom-in"></i></span>
                        <a href="examcenter.jpg" download title="download"><i class="bi bi-download"></i></a>

                    </div>

                </div>
            </div>
        </div>

        <div class="container container_left col-lg-8 mb-2">
            <div class="d-flex flex-column flex-lg-row align-items-start gap-3 pt-3 pb-3">
                <div class="container">
                    <h4 class="text mb-3">BCA 4th Sem Routine</h4>
                    <p>Date: 20 August - 30 August</p>
                    <p>Time: 3hrs</p>
                </div>
                <div class="image_container">
                    <img src="routine.jpg" class="img-thumbnail img-fluid full_img image" alt="Routine" style="max-width: 300px; height: 200px">

                    <div class="icons">
                        <span><i class="bi bi-zoom-in" title="full-screen"></i></span>
                        <a href="routine.jpg" download title="download"><i class="bi bi-download"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="image-popup">
        <img src="" alt="full screen image">

            <a title="download" href="examcenter.jpg" download=""><i class="bi bi-download" style="font-size: 25px;"></i></a>
            <span title="exit"><i class="bi bi-x-lg" style="font-size: 25px;"></i></span>

    </div>






    <?php include 'footer.php' ?>


    <script>
        // Select all fullscreen icons and the popup elements
        document.querySelectorAll('.bi-zoom-in').forEach(icon => {
            icon.addEventListener('click', function () {
                const imgSrc = this.closest('.image_container').querySelector('img').getAttribute('src');
                const popup = document.querySelector('.image-popup');
                popup.style.display = 'flex';
                popup.querySelector('img').src = imgSrc;
                document.querySelector('nav').style.zIndex = '-1';
            });
        });

        // Close the popup when the close button is clicked
        document.querySelector('.image-popup span').addEventListener('click', function () {
            document.querySelector('.image-popup').style.display = 'none';
            document.querySelector('nav').style.zIndex = '1';
        });
    </script>

</body>

</html>