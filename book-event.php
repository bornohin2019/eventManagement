<?php
include('connect.php');

if (!isset($_SESSION['uid'])) {
    die("User not logged in!");
}

$user_id = $_SESSION['uid'];  // Get the current user's ID from session
$event_id = $_GET['id'];      // Get the event ID from the URL

// Check if the user has already booked this event
$checkBookingSql = "SELECT * FROM bookings WHERE user_id = '$user_id' AND event_id = '$event_id'";
$checkResult = mysqli_query($conn, $checkBookingSql);

if (!$checkResult) {
    die("Query failed: " . mysqli_error($conn));  // For debugging
}

if (mysqli_num_rows($checkResult) > 0) {
    // The user has already booked this event
    $_SESSION['error'] = "<div class='alert alert-warning'>You have already booked this event!</div>";
    header("Location: booking.php");  // Redirect to booking page or event list
    exit;
} else {
    // The user has not booked this event, proceed with booking
    $bookSql = "INSERT INTO bookings (user_id, event_id) VALUES ('$user_id', '$event_id')";
    if (mysqli_query($conn, $bookSql)) {
        $_SESSION['success'] = "<div class='alert alert-success'>EVENT BOOKING SUCCESSFUL</div>";
        header("Location: booking.php");  // Redirect back to the event list or booking page
        exit;
    } else {
        $_SESSION['error'] = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        header("Location: booking.php");  // Redirect to the booking page with error message
        exit;
    }
}
