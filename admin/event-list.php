<?php
include('connect.php');
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
   
</head>

<body>
    <div class="container mt-4">
        <h3 class="text-center mb-4">Event List</h3>

        <!-- Add New Event Button -->
        <div class="text-end mb-3">
            <a href="add-event.php" class="btn btn-success">Add New Event</a>
        </div>

        <!-- Event Table -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Event Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM events ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "
                        <tr>
                            <td>{$row['id']}</td>
                            <td>{$row['event_title']}</td>
                            <td>{$row['event_date']}</td>
                            <td>{$row['event_time']}</td>
                            <td>{$row['event_location']}</td>
                            <td>{$row['event_description']}</td>
                            <td><img src='uploads/{$row['event_image']}' alt='{$row['event_title']}' width='100'></td>
                            <td>
                                <a href='delete-event.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this event?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No events found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>
