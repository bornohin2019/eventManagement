<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            font-size: 36px;
            font-weight: bold;
            color: #2c3e50;
            text-transform: uppercase;
            position: relative;
        }

        h2::after {
            content: "";
            display: block;
            width: 100px;
            height: 4px;
            background: #3498db;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .container {
            margin-top: 40px;
        }

        .alert h5 {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .alert p {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php
    // Include database connection
    include('connect.php');
    include('header.php');

    // SQL query to fetch total tickets sold and revenue
    $stats_sql = "SELECT 
                COUNT(b.id) AS total_tickets_sold, 
                SUM(e.price) AS total_revenue
            FROM 
                bookings b
            JOIN 
                events e ON b.event_id = e.id
            WHERE 
                b.status = 'Confirmed'";

    $stats_result = mysqli_query($conn, $stats_sql);
    $total_tickets_sold = 0;
    $total_revenue = 0;

    if ($stats_result && mysqli_num_rows($stats_result) > 0) {
        $stats_row = mysqli_fetch_assoc($stats_result);
        $total_tickets_sold = $stats_row['total_tickets_sold'];
        $total_revenue = $stats_row['total_revenue'];
    }
    ?>

    <h2>Event Management System</h2>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="alert alert-info text-center">
                    <h5>Total Tickets Sold</h5>
                    <p class="h4"><?php echo $total_tickets_sold; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-success text-center">
                    <h5>Total Sales</h5>
                    <p class="h4">$<?php echo number_format($total_revenue, 2); ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>