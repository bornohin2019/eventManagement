<?php
include('connect.php');
include('header.php');

// Fetch all events
$sql = "SELECT id, event_title, event_date, event_time, event_location, event_description, event_image FROM events WHERE 1";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Events</title>

    <style>
        .event-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .event-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .event-card .card-body {
            padding: 16px;
        }

        .event-card .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .event-card .card-text {
            color: #555;
        }

        .event-card .btn-book {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }

        .event-card .btn-book:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h3 class="text-center mb-4">Available Events</h3>
        <?php
        if (isset($_SESSION['success'])) {
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
        <div class="row">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $event_image = 'admin/uploads/' . $row['event_image']; // Assuming the event images are stored in the 'uploads' folder
            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card event-card">
                            <img src="<?php echo $event_image; ?>" alt="Event Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['event_title']; ?></h5>
                                <p class="card-text"><?php echo substr($row['event_description'], 0, 100) . '...'; ?></p>
                                <p class="text-muted">Price: $<?php echo number_format($row['price'], 2); ?></p>
                                <p class="text-muted"><?php echo $row['event_location']; ?> | <?php echo $row['event_date']; ?> at <?php echo $row['event_time']; ?></p>
                                <a href="book-event.php?id=<?php echo $row['id']; ?>" class="btn btn-book">Book Now</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='col-12 text-center'><p>No events found</p></div>";
            }
            ?>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>