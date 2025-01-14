<?php
ob_start();
ob_clean();
include('../connect.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_title = mysqli_real_escape_string($conn, $_POST['event_title']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $event_time = mysqli_real_escape_string($conn, $_POST['event_time']);
    $event_location = mysqli_real_escape_string($conn, $_POST['event_location']);
    $event_description = mysqli_real_escape_string($conn, $_POST['event_description']);

    // Handle the file upload
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/';
        $file_name = basename($_FILES['event_image']['name']);
        $file_tmp_path = $_FILES['event_image']['tmp_name'];
        $file_path = $upload_dir . $file_name;

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($file_tmp_path, $file_path)) {
            $event_image = $file_name;
        } else {
            die("Failed to upload the image.");
        }
    } else {
        die("No image uploaded or an error occurred.");
    }

    // Insert the event into the database
    $sql = "INSERT INTO events (event_title, event_date, event_time, event_location, event_description, event_image)
            VALUES ('$event_title', '$event_date', '$event_time', '$event_location', '$event_description', '$event_image')";

    if (mysqli_query($conn, $sql)) {
        echo "Event added successfully!";
        header("Location: ../event.php"); // Redirect to events list (create this page to show all events)
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
