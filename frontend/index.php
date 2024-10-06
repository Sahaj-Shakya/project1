<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <?php include 'nav.php' ?>

    <div class="container flex-column flex-sm-row d-flex w-100 col-lg-7 gap-5 mt-4">
        <div class="container container_left col-lg-4 ps-2 pe-2" style="max-height: 400px;">
            <div class="row justify-content-center">

                <div class="container p-2">
                    <h4 class="ps-3 pt-2">Seat Finder</h4>
                    <hr>
                    <form class="d-flex flex-column flex-sm-row ps-3 pe-3 pb-3" role="search">
                        <input class="form-control search me-0 me-sm-2 mb-2 mb-sm-0" type="search" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-search btn-outline-secondary" type="submit">Search</button>
                    </form>
                </div>


            </div>

            <p class="text-muted ps-3 pe-3">
                Enter your roll number in the search box and click "Search" to find your seat planning.
            </p>


        </div>


        <div class="container container_right p-2" style="max-height: 400px;">
            <div class="container p-2">
                <h4>Recent News</h4>
                <hr>
                <ul class="list-group">
                    <li class="list-group-item">Exam schedule for Fall 2024 released.</li>
                    <li class="list-group-item">Last date to change exam centers is October 10th.</li>
                    <li class="list-group-item">Exam center will be revealed in the last of this month. Please be patient by then. Thenk you!</li>
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
                <li class="list-group-item">Our university was founded in 1900.</li>
                <li class="list-group-item">We have over 300 student clubs and organizations.</li>
                <li class="list-group-item">The campus spans over 500 acres.</li>
            </ul>
        </div>
    </div>

    <?php include 'footer.php' ?>



</body>

</html>