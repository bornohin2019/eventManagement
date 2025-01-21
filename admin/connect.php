<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'events');
if (!$connect) {
    die("Can't Connect Server");
}

$conn = $connect;
