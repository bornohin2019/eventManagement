<?php
ob_start();
ob_clean();
include('connect.php');
// Check if form data is submitted
if (isset($_POST['user_id']) && isset($_POST['event_id'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);

    // Insert booking record into the bookings table
    $bookSql = "INSERT INTO bookings (user_id, event_id) VALUES ('$user_id', '$event_id')";
    if (mysqli_query($conn, $bookSql)) {
        echo "Event booked successfully!";
        header("Location: event-list.php");  // Redirect back to the event list
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid booking request.";
}
?>
