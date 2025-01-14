<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'events');
if (!$connect) {
    die("Can't Connect Server");
}


// $connect = mysqli_connect('db', 'root', 'rootpassword', 'events');
// if (!$connect) {
//     die("Can't Connect Server");
// }

$conn= $connect;
?>