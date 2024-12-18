<?php
session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';

if ($admin === '') {
    header('Location: login.php');
}

include "../app/connection.php";


$error = false;
$message = '';

function validate($title, $desc)
{
    global $error, $message;
    if (trim($title) === '' || trim($desc) === '') {
        $error = true;
        $message = 'Fill all the form fields.';
        return false;
    }

    if (strlen($title) > 255) {
        $error = true;
        $message = 'Title is too long.';
        return false;
    }

    return true;
}

function validate_img($new_img)
{

    global $error, $message;
    $extentions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $file_extension = strtolower(pathinfo($new_img, PATHINFO_EXTENSION));

    if (!in_array($file_extension, $extentions)) {
        $error = true;
        $message = 'Invalid image file type.';
        return false;
    }

    return true;
}

if (isset($_GET['sn'])) {
    $sn = $_GET['sn'];

    $news_query = "SELECT * FROM `news` WHERE `sn` = '$sn' LIMIT 1;";
    $news_result = mysqli_query($conn, $news_query);

    $row = mysqli_fetch_assoc($news_result);

    $sn = $row['sn'];
    $old_title = $row['title'];
    $old_desc = $row['description'];
    $old_img = $row['img'];
} else {
    header('Location: news.php');
}

if (isset($_POST['submit'])) {
    $new_title = $_POST['title'];
    $new_desc = $_POST['description'];
    $new_img = $_FILES['img']['name'] ?? '';

    // if($new_title === $old_title && $new_desc === $old_desc && $new_img === ''){
    //     header('Location: news.php');
    //     exit;
    // }

    if ($new_img !== '') {
        $img_tmp = $_FILES['img']['tmp_name'];

        $target_directory = '../images/';
        $target_file = $target_directory . basename($new_img);

        if (validate($new_title, $new_desc)) {
            if (validate_img($new_img)) {
                if (move_uploaded_file($img_tmp, $target_file)) {
                    $update_query = "UPDATE `news` SET `title` = '$new_title', `description` = '$new_desc', `image` = '$target_file', `created/edited_by` = '$admin' WHERE `news`.`sn` = $sn;";
                    $update_result = mysqli_query($conn, $update_query);

                    if ($update_result) {
                        $_SESSION['admin_message'] = 'News Edited.';
                        header('Location: news.php');
                        exit;
                    } else {
                        $_SESSION['admin_message'] = 'Something went wrong!.';
                        header('Location: news.php');
                        exit;
                    }
                } else {
                    $error = true;
                    $message = 'File can\'t be uploaded';
                }
            } else {
                $error = true;
                $message = 'Something wrong with image.';
            }
        } else {
            $error = true;
            $message = 'Something went wrong.';
        }
    } 
    if ($new_img === '') {
        if (validate($new_title, $new_desc)) {
            $update_query = "UPDATE `news` SET `title` = '$new_title', `description` = '$new_desc', `created/edited_by` = '$admin' WHERE `news`.`sn` = $sn;";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {
                $_SESSION['admin_message'] = 'News Edited.';
                header('Location: news.php');
                exit;
            } else {
                $_SESSION['admin_message'] = 'Something went wrong!.';
                header('Location: news.php');
                exit;
            }
        } else {
            $error = true;
            $message = 'Something wrong with image.';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit News</title>
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
                        <li class="breadcrumb-item"><a href="news.php">News</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit News</li>
                    </ol>
                </nav>
                <div class="add mt-4 me-3">
                    <a href="news_add.php" class="btn btn-primary">something</a>
                </div>
            </div>

            <?php if ($error === true): ?>
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                <?php echo $message ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="container border p-2 shadow mt-5" style="border-radius: 10px; max-width: 1000px;">
                <div class="container p-3">
                    <h4 class="text-center">Edit News</h4>
                    <hr>
                    <form method="post" action="news_edit.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">News Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $old_title; ?>" placeholder="Enter title" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">News Description</label>
                            <textarea rows="7" cols="30" name="description" class="form-control" id="description" placeholder="Enter description" required><?php echo htmlspecialchars($old_desc); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="img" class="form-label">Image (Previous image won't change if left empty)</label>
                            <input name="img" type="file" class="form-control" id="img-input" accept="image/*">

                            <div class="img-preview mt-2">
                                <img id="img-preview" src="<?php echo $old_img; ?>" alt="Image Preview" style="display: none; max-width: 20%; height: auto;" />
                            </div>
                        </div>


                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" name="submit" class="btn btn-outline-primary">Update</button>
                            <a href="news.php" class="btn btn-outline-danger">Cancel</a>
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