<?php
ob_start();
ob_clean();
include('connect.php');
include('header.php');

// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    echo "<script>
            alert('You must log in to view bookings.');
            window.location.href = 'login.php';
          </script>";
    exit();
}

// Fetch user ID from the session
$current_user_id = $_SESSION['uid'];

// Check if booking ID is provided
if (isset($_GET['booking_id']) && is_numeric($_GET['booking_id'])) {
    $booking_id = intval($_GET['booking_id']); // Validate booking ID as an integer

    // Fetch booking details for the specific booking ID
    $sql = "SELECT 
                bookings.id AS booking_id, 
                events.event_title, 
                events.event_date, 
                events.price, 
                bookings.status,
                user.name AS user_name,
                user.contact AS user_contact,
                user.email AS user_email
            FROM bookings 
            JOIN events ON bookings.event_id = events.id
            JOIN user ON bookings.user_id = user.userid
            WHERE bookings.id = ?";

    $stmt = $connect->prepare($sql);

    // Check if the statement prepared successfully
    if (!$stmt) {
        die("SQL Error: " . $connect->error);
    }

    $stmt->bind_param('i', $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any data is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display invoice
        echo "<h3 style='text-align:center;'>Invoice</h3>";
        echo "<div style='width: 60%; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: #f9f9f9;'>
                <p><strong>User Name:</strong> {$row['user_name']}</p>
                <p><strong>Contact:</strong> {$row['user_contact']}</p>
                <p><strong>Email:</strong> {$row['user_email']}</p>
                <p><strong>Event Title:</strong> {$row['event_title']}</p>
                <p><strong>Event Date:</strong> {$row['event_date']}</p>
                <p><strong>Price:</strong> {$row['price']}</p>
                <p><strong>Status:</strong> {$row['status']}</p>
              </div>";
        echo "<button class='btn-print' onclick='window.print();' style='margin-top: 20px; display: block; margin: 20px auto; padding: 10px 20px; background: #0056b3; color: white; border: none; border-radius: 5px; cursor: pointer;'>Print Invoice</button>";
    } else {
        echo "<p>Invoice not found.</p>";
    }
} else {
    echo "<p>Invalid booking ID.</p>";
}
