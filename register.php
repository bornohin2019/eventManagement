<?php

include('connect.php');
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `user`(`name`,`email`,`password`,`roleid`) VALUES ('$name','$email','$password','$contact','2')";

    if (mysqli_query($connect, $sql)) {
        echo "User registered successfully!";
        session_start();
        $_SESSION['mySession'] = $name;
        header('location:login.php');
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="border p-4 bg-light rounded" style="width: 100%; max-width: 400px;">
            <form action="register.php" method="post">
                <h3 class="text-center mb-4">Register</h3>
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="contact" class="form-control" id="contact" name="contact" placeholder="Enter your contact" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="register" class="btn btn-primary w-100 mb-3">Register</button>
            </form>
            <!-- Login button placed outside the form -->
            <a href="login.php" class="btn btn-secondary w-100">Login</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>