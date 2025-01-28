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
    $sql = "SELECT bookings.id AS booking_id, 
                   events.event_title, 
                   events.event_date, 
                   events.price, 
                   bookings.status
            FROM bookings
            JOIN events ON bookings.event_id = events.id
            WHERE bookings.id = ? AND bookings.user_id = ?";
    
    $stmt = $connect->prepare($sql);
    $stmt->bind_param('ii', $booking_id, $current_user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display invoice
        echo "<h3 style='text-align:center;'>Invoice</h3>";
        echo "<div style='width: 60%; margin: 0 auto;'>
                <p><strong>Event Title:</strong> {$row['event_title']}</p>
                <p><strong>Event Date:</strong> {$row['event_date']}</p>
                <p><strong>Price:</strong> {$row['price']}</p>
                <p><strong>Status:</strong> {$row['status']}</p>
              </div>";
        echo "<button class='btn-print' onclick='window.print();'>Print Invoice</button>";
    } else {
        echo "<p>Invoice not found.</p>";
    }
} else {
    echo "<p>Invalid booking ID.</p>";
}
?>