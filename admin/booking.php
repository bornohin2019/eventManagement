<?php
include('connect.php');
include('header.php');

// Fetch users with roleid = 2
$usersSql = "SELECT `userid`, `name` FROM `user` WHERE `roleid` = 2";
$usersResult = mysqli_query($conn, $usersSql);

// Fetch events
$eventsSql = "SELECT `id`, `event_title`, `event_date`, `event_time` FROM `events` ORDER BY event_date DESC";
$eventsResult = mysqli_query($conn, $eventsSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking</title>
   
</head>

<body>
    <div class="container mt-4">
        <h3 class="text-center mb-4">Book Event for User</h3>

        <!-- Booking Form -->
        <form action="process-booking.php" method="POST">
            <!-- User Selection -->
            <div class="mb-3">
                <label for="user" class="form-label">Select User</label>
                <select name="user_id" id="user" class="form-select" required>
                    <option value="" disabled selected>Select User</option>
                    <?php
                    if (mysqli_num_rows($usersResult) > 0) {
                        while ($user = mysqli_fetch_assoc($usersResult)) {
                            echo "<option value='{$user['userid']}'>{$user['name']}</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No users found</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Event Selection -->
            <div class="mb-3">
                <label for="event" class="form-label">Select Event</label>
                <select name="event_id" id="event" class="form-select" required>
                    <option value="" disabled selected>Select Event</option>
                    <?php
                    if (mysqli_num_rows($eventsResult) > 0) {
                        while ($event = mysqli_fetch_assoc($eventsResult)) {
                            echo "<option value='{$event['id']}'>{$event['event_title']} - {$event['event_date']} at {$event['event_time']}</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No events found</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Book Event</button>
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>
