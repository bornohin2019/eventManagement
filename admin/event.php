<?php
include('connect.php');
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .form-group input[type="file"] {
            padding: 3px;
        }

        .btn-primary {
            background-color: #0069d9;
            border-color: #0062cc;
            padding: 10px 20px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .container {
            max-width: 900px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="form-container">
            <h3 class="text-center mb-4">Add New Event</h3>

            <form action="php/add-events.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <!-- Event Title -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="event-title">Event Title</label>
                            <input type="text" id="event-title" name="event_title" class="form-control" placeholder="Enter event title" required>
                        </div>
                    </div>

                    <!-- Event Date -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="event-date">Event Date</label>
                            <input type="date" id="event-date" name="event_date" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Event Location -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="event-location">Event Location</label>
                            <input type="text" id="event-location" name="event_location" class="form-control" placeholder="Enter event location" required>
                        </div>
                    </div>

                    <!-- Event Time -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="event-time">Event Time</label>
                            <input type="time" id="event-time" name="event_time" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Event Description -->
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="event-description">Event Description</label>
                            <textarea id="event-description" name="event_description" class="form-control" rows="4" placeholder="Enter event description" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Event Image -->
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="event-image">Event Image</label>
                            <input type="file" id="event-image" name="event_image" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Submit Button -->
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    include('footer.php');
    ?>

</body>

</html>
