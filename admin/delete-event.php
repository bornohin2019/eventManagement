<?php
ob_start();
ob_clean();
// Include database connection
include('connect.php');
// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    // Get the event ID from the URL
    $id = intval($_GET['id']);

    // Fetch the event to check if it exists
    $sql_select = "SELECT event_image FROM events WHERE id = $id";
    $result = mysqli_query($conn, $sql_select);

    if (mysqli_num_rows($result) > 0) {
        // Delete the image file if it exists
        $event = mysqli_fetch_assoc($result);
        $image_path = "uploads/" . $event['event_image'];
        if (file_exists($image_path)) {
            unlink($image_path); // Delete the image file
        }

        // Delete the event record from the database
        $sql_delete = "DELETE FROM events WHERE id = $id";
        if (mysqli_query($conn, $sql_delete)) {
            // Redirect back to the event list with a success message
            header("Location: event-list.php?message=Event+deleted+successfully");
            exit;
        } else {
            echo "Error deleting event: " . mysqli_error($conn);
        }
    } else {
        echo "Event not found.";
    }
} else {
    echo "Invalid request.";
}
?>
