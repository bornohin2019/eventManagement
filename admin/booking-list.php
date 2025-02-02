<?php

ob_start();
ob_clean();
include('connect.php');
include('header.php');

// Fetch the booking details along with the user name and event title
$sql = "SELECT b.id AS booking_id, u.name AS user_name, u.contact AS user_contact, e.event_title, e.event_date, e.event_time, e.price, b.booking_date, b.status, b.user_id, e.id AS event_id
        FROM bookings b
        JOIN user u ON b.user_id = u.userid
        JOIN events e ON b.event_id = e.id
        ORDER BY b.booking_date DESC";

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
            // Fetch the details of the booking that was confirmed
            $booking_sql = "SELECT b.user_id, e.id AS event_id, e.price 
                            FROM bookings b
                            JOIN events e ON b.event_id = e.id
                            WHERE b.id = '$booking_id'";

            $booking_result = mysqli_query($conn, $booking_sql);
            if ($booking_result && mysqli_num_rows($booking_result) > 0) {
                $booking_row = mysqli_fetch_assoc($booking_result);
                $user_id = $booking_row['user_id'];
                $event_id = $booking_row['event_id'];
                $price = $booking_row['price'];

                // Insert the payment details
                $insert_sql = "INSERT INTO payment (amount, eventid, userid) 
                               VALUES ($price, $event_id, $user_id)";
                if (mysqli_query($conn, $insert_sql)) {
                    // Redirect after confirming and inserting payment record
                    header("Location: booking-list.php");
                    exit;
                } else {
                    echo "Error inserting payment record: " . mysqli_error($conn);
                }
            }
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
    }
     elseif ($action == 'delete') {
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
                    <th>SL</th>
                    <th>User Name</th>
                    <th>Contact</th>
                    <th>Event Title</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Price</th>
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
                            <td>{$row['booking_id']}</td>
                            <td>{$row['user_name']}</td>
                            <td>{$row['user_contact']}</td>
                            <td>{$row['event_title']}</td>
                            <td>{$row['event_date']}</td>
                            <td>{$row['event_time']}</td>
                            <td>{$row['price']}</td>
                            <td>{$status}</td>
                            <td>
                                <a href='booking-list.php?action=confirm&id={$row['booking_id']}' class='btn btn-success btn-sm' onclick='return confirm(\"Are you sure you want to confirm this booking?\")'>Confirm</a>
                                <a href='booking-list.php?action=cancel&id={$row['booking_id']}' class='btn btn-warning btn-sm' onclick='return confirm(\"Are you sure you want to cancel this booking?\")'>Cancel</a>
                                <a href='booking-list.php?action=delete&id={$row['booking_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this booking?\")'>Delete</a>
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
