<?php
include 'connection.php';

session_start();
$username = $_SESSION['username'];
$user_email = $_SESSION['email'];

if ($username == false) {
    header('Location: login.php');
    exit();
}

$query = "SELECT `sn` FROM `user` WHERE `email` = '$user_email' LIMIT 1";
$result = mysqli_query($conn, $query);


if ($result) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['sn'];
}

$error = false;
$message = '';

function validate($username, $email)
{
    global $error, $message;

    if (trim($username) === '' || trim($email) === '') {
        $error = true;
        $message = 'Email or Username can\'t be empty!';
        return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $message = 'Invalid email address.';
        return false;
    }

    return true;
}

if (isset($_POST['save'])) {
    $new_username = $_POST['name'];
    $new_email = strtolower($_POST['email']);


    if ($username === $new_username && $user_email === $new_email) {
        header('Location: profile.php');
    } elseif ($new_email !== $user_email) {
        $email_query = "SELECT * FROM `user` WHERE `email` = '$new_email' LIMIT 1";
        $email_result = mysqli_query($conn, $email_query);
        $user = mysqli_fetch_assoc($email_result);

        if ($user) {
            $error = true;
            $message = 'This email is already registered.';
        } else {
            if (validate($new_username, $new_email)) {
                global $message;

                $update_query = "UPDATE `user` SET `username` = '$new_username', `email` = '$new_email' WHERE `user`.`sn` = '$id';";
                $update_result = mysqli_query($conn, $update_query);

                if ($update_result) {
                    $_SESSION['message'] = 'Profile updated.';
                    $_SESSION['username'] = $new_username;
                    $_SESSION['email'] = $new_email;

                    header('Location: profile.php');
                } else {
                    $error = true;
                    $message = "Error: " . mysqli_error($conn);
                }
            }
        }
    } else {
        if (validate($new_username, $new_email)) {
            global $message;

            $update_query = "UPDATE `user` SET `username` = '$new_username', `email` = '$new_email' WHERE `user`.`sn` = '$id';";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {
                $_SESSION['message'] = 'Profile updated.';
                $_SESSION['username'] = $new_username;
                $_SESSION['email'] = $new_email;

                header('Location: profile.php');
            } else {
                $error = true;
                $message = "Error: " . mysqli_error($conn);
            }
        }
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>

    <?php if ($error === true): ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php include 'nav.php' ?>

    <div class="d-flex justify-content-center align-items-center" style="margin-top: 100px;">
        <div class="card container_login p-4 col-lg-4 col-md-6 col-sm-8">
            <h4 class="mb-3">Edit</h4>
            <form action="edit_profile.php" method="post" onsubmit="disableSubmitButton()">
                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input name="name" type="text" class="form-control" id="name" value="<?php echo $username ?>" placeholder="Enter username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" value="<?php echo $user_email ?>" placeholder="Enter email" required>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-2">
                    <button name="save" id="submitButton" class="btn btn-outline-primary">Save</button>
                    <a href="profile.php" class="btn btn-outline-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function disableSubmitButton() {
            document.getElementById('submitButton').disabled = true;
        }
    </script>

</body>

</html>