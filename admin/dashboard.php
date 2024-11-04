<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <button style="font-size: 30px;" class="btn mt-2 ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
        <i class="bi bi-list"></i>
    </button>


    <div style="background-color: #dae4ed; width: 250px;" class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header mb-4 d-flex justify-content-between">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Admin Pannel</h5>
            <button style="font-size: 30px;" class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                <i class="bi bi-list"></i>
            </button>
        </div>
        <div class="offcanvas-body d-flex flex-column justify-content-between">
            <div class="container top">
                <div class="sidebar-content mb-4 d-flex">Dashboard
                    <div class="right"><i class="bi bi-speedometer2 ms-2"></i></div>
                </div>
                <div class="sidebar-content mb-4 d-flex">News
                    <div class="right"><i class="bi bi-newspaper ms-2"></i></div>
                </div>
                <div class="sidebar-content mb-4 d-flex">Schedules
                    <div class="right"><i class="bi bi-calendar-check ms-2"></i></div>
                </div>
                <div class="sidebar-content mb-4 d-flex">Contact us
                    <div class="right"><i class="bi bi-person-rolodex ms-2"></i></div>
                </div>
                <div class="sidebar-content mb-4 d-flex">Users
                    <div class="right"><i class="bi bi-people ms-2"></i></div>
                </div>
            </div>
            <div class="container bottom mb-5">
                <div class="user-detail d-flex">
                    <div class="left"><i class="bi bi-person-circle me-2"></i>Super Admin</div>
                </div>
                <div class="container">
                    logout
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>