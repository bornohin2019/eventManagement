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

// Handle cancel action
if (isset($_GET['action']) && $_GET['action'] == 'cancel' && isset($_GET['id'])) {
    $booking_id = mysqli_real_escape_string($connect, $_GET['id']);

    // Update the booking status to "Cancelled"
    $cancel_sql = "UPDATE bookings SET status = 'Cancelled' WHERE id = '$booking_id' AND user_id = '$current_user_id'";
    if (mysqli_query($connect, $cancel_sql)) {
        echo "<script>
                alert('Booking has been cancelled successfully.');
                window.location.href = 'user-booking-list.php'; // Ensure this URL is correct
              </script>";
        exit();
    } else {
        echo "<script>alert('Error cancelling the booking. Please try again.');</script>";
    }
}

// Fetch bookings for the logged-in user
$sql = "SELECT bookings.id AS booking_id, 
               events.event_title, 
               events.event_date, 
               events.price, 
               bookings.status
        FROM bookings 
        JOIN events ON bookings.event_id = events.id
        WHERE bookings.user_id = '$current_user_id'
        ORDER BY bookings.booking_date DESC";

$result = mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Booking List</title>
</head>

<body>
    <h3>Your Bookings</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>SL</th>
                <th>Event Title</th>
                <th>Event Date</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $sl = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$sl}</td>
                            <td>{$row['event_title']}</td>
                            <td>{$row['event_date']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['status']}</td>
                            <td>";
                    if ($row['status'] != 'Cancelled') {
                        echo "<a href='user-booking-list.php?action=cancel&id={$row['booking_id']}' 
                              onclick='return confirm(\"Are you sure you want to cancel this booking?\")'>Cancel</a>";
                    } else {
                        echo "Cancelled";
                    }
                    echo "</td>
                          </tr>";
                    $sl++;
                }
            } else {
                echo "<tr><td colspan='6'>No bookings found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>