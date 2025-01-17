<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];
    $payment_method = $_POST['payment_method'];

    $sql = "INSERT INTO bookings (event_id, user_id, payment_method) VALUES ('$event_id', '1', '$payment_method')";
    if (mysqli_query($connect, $sql)) {
        echo "Payment successful!";
    } else {
        echo "Payment failed!";
    }
}

$event_id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM events WHERE id = $event_id");
$event = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book Event</title>
</head>

<body>
    <h2>Book Event: <?php echo $event['event_title']; ?></h2>
    <p>Price: $<?php echo number_format($event['price'], 2); ?></p>
    <form action="book-event.php" method="POST">
        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" required>
            <option value="Credit Card">Credit Card</option>
            <option value="Bkash">Bkash</option>
            <option value="Nagad">Nagad</option>
            <option value="Roket">Roket</option>
            <option value="Cash">Cash</option>
        </select>
        <button type="submit">Confirm Booking</button>
    </form>
</body>

</html>