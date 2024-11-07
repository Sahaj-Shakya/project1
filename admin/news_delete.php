session_start();
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : ''; 

if($admin === ''){
    header('Location: login.php');
}