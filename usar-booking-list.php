<?php
ob_start();
ob_clean();
include('connect.php');
include('header.php');

// Fetch the booking details along with the user name and event title
$sql = "SELECT b.id, u.name AS user_name,u.contact AS user_contact, e.event_title, e.event_date, e.event_time, b.booked_at, b.status
        FROM bookings b
        JOIN user u ON b.user_id = u.userid
        JOIN events e ON b.event_id = e.id
        ORDER BY b.booked_at DESC";

$result = mysqli_query($conn, $sql);

// Handle actions based on the GET parameter
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $booking_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Perform the action based on the selected action
    if ($action == 'confirm') {
        // Confirm the booking
        $sql = "UPDATE bookings SET status = 'Confirmed' WHERE id = '$booking_id'";
        if (mysqli_query($conn, $sql)) {
            header("Location: booking-list.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif ($action == 'cancel') {
        // Cancel the booking
        $sql = "UPDATE bookings SET status = 'Cancelled' WHERE id = '$booking_id'";
        if (mysqli_query($conn, $sql)) {
            header("Location: booking-list.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif ($action == 'delete') {
        // Delete the booking
        $sql = "DELETE FROM bookings WHERE id = '$booking_id'";
        if (mysqli_query($conn, $sql)) {
            header("Location: booking-list.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking List</title>

</head>

<body>
    <div class="container mt-4">
        <h3 class="text-center mb-4">Booking List</h3>

        <!-- Booking Table -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Contact</th>
                    <th>Event Title</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Booked At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status = $row['status'] ? $row['status'] : 'Pending';
                        echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['user_name']}</td>
                             <td>{$row['user_contact']}</td>
                            <td>{$row['event_title']}</td>
                            <td>{$row['event_date']}</td>
                            <td>{$row['event_time']}</td>
                            <td>{$row['booked_at']}</td>
                            <td>{$status}</td>
                            <td>
                                <a href='booking-list.php?action=cancel&id={$row['id']}' class='btn btn-warning btn-sm' onclick='return confirm(\"Are you sure you want to cancel this booking?\")'>Cancel</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No bookings found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>
