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
if (isset($_GET['action']) && is_numeric($_GET['action'])) {
    $cancel_id = intval($_GET['action']); // Validate booking ID as an integer

    // Use prepared statements to cancel the booking
    $cancel_sql = $connect->prepare("UPDATE bookings SET status = 'Cancelled' WHERE id = ? AND user_id = ?");
    $cancel_sql->bind_param('ii', $cancel_id, $current_user_id); // Bind booking ID and user ID as integers

    if ($cancel_sql->execute()) {
        echo "<script>
                alert('Booking has been cancelled successfully.');
                window.location.href = 'usar-booking-list.php'; // Redirect to the booking list page
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
        WHERE bookings.user_id = ?
        ORDER BY bookings.booking_date DESC";

$stmt = $connect->prepare($sql);
$stmt->bind_param('i', $current_user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Booking List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h3 {
            text-align: center;
            margin-top: 20px;
            color: #0056b3;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }

        table th {
            background-color: #0056b3;
            color: white;
            padding: 10px;
        }

        table td {
            padding: 10px;
            text-align: center;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:nth-child(odd) {
            background-color: #ffffff;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .btn-print {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #0056b3;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            width: 150px;
            text-transform: uppercase;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .btn-print:hover {
            background-color: #003f7f;
        }

        a {
            color: #0056b3;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
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
            if ($result->num_rows > 0) {
                $sl = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$sl}</td>
                            <td>{$row['event_title']}</td>
                            <td>{$row['event_date']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['status']}</td>
                            <td>";
                    if ($row['status'] != 'Cancelled') {
                        echo "<a href='usar-booking-list.php?action={$row['booking_id']}' 
                              onclick='return confirm(\"Are you sure you want to cancel this booking?\")'>Cancel</a> | ";
                    } else {
                        echo "Cancelled | ";
                    }
                    echo "<a href='invoice.php?booking_id={$row['booking_id']}'>Invoice</a>";
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
