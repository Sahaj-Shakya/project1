<?php

include "connection.php";

session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$user_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

$error = false;
$message = '';

function validate($name, $email, $phone, $subject, $user_message)
{
    global $error, $message;

    if (trim($name) === '' || trim($email) === '' || trim($phone) === '' || trim($subject) === '' || trim($user_message) === '') {
        $error = true;
        $message = 'Fill all the form fields.';
        return false;
    }

    if (strlen($subject) > 100) {
        $error = true;
        $message = 'Subject is too long.';
        return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $message = 'Invalid email address.';
        return false;
    }

    if (strlen($phone) !== 10 || !ctype_digit($phone)) {
        $error = true;
        $message = 'Invalid phone number.';
        return false;
    }

    return true;
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $user_message = $_POST['message'];

    if ($username !== '') {
        if (validate($name, $email, $phone, $subject, $user_message)) {
            
            $contact_us_query = "INSERT INTO `contact_us` (`name`, `email`, `phone`, `subject`, `message`, `created_at`) 
                                 VALUES ('$name', '$email', '$phone', '$subject', '$user_message', CURRENT_TIMESTAMP);";
            $contact_us_result = mysqli_query($conn, $contact_us_query);

            if ($contact_us_result) {
                $_SESSION['message'] = 'Message sent successfully!';
                header('Location: contact.php');
                exit;
            } else {
                $error = true;
                $message = 'Failed to send your message. Please try again later.';
            }
        }
    } else {
        $_SESSION['message'] = 'You have to login first!';
        header('Location: login.php');
        exit;
    }
}

?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
</head>

<body>
    <?php include 'nav.php' ?>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['message']; ?>
                        <?php unset($_SESSION['message']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
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


    <?php if ($username == ''): ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        Note: You have to be Signed In to contact us.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>


    <div class="container w-100 col-lg-7">
        <div class="container container_left p-4 col-lg-8">
            <h4 class="text mb-4 ">Contact us</h4>
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" name="name" class="form-control" id="name" placeholder="Enter name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" value="<?php echo $user_email ?>" class="form-control" id="email" placeholder="Enter email" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Contact</label>
                    <input minlength="10" maxlength="10" name="phone" type="tel" pattern="[0-9]{10}" class="form-control" id="phone" placeholder="Enter contact no." required>
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input name="subject" maxlength="350" type="text" class="form-control" id="subject" placeholder="Enter Subject" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea rows="6" cols="30" name="message" class="form-control" id="message" placeholder="Enter your message here.." required></textarea>
                </div>


                <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-outline-secondary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'footer.php' ?>

</body>

</html>