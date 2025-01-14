<?php
ob_start();
session_start();
// Check if the current file is not login.php
// if (basename($_SERVER['PHP_SELF']) != 'login.php' && !isset($_SESSION['uid'])) {
//     echo "Access denied. Please log in to proceed.";
//     echo "<a href='login.php'>Login</a>";
//     die();  // Stop further execution
// }
$connect = mysqli_connect('localhost', 'root', '', 'events');
if (!$connect) {
    die("Can't Connect Server");
}
$conn = $connect;
?>
