<?php
include('connect.php');
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `user` WHERE email = '$email' and password = '$password' ";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_array($result);

        $role = $data['roleid'];
        session_start();

        $_SESSION['uid'] = $data['userid'];
        $_SESSION['type'] = $role;

        if ($role == 1) {
            // Admin login successful, show alert and then redirect
            echo "<script>
                    alert('Admin Login successfully!');
                    window.location.href = 'admin/dashboard.php';
                  </script>";
            exit();
        } else if ($role == 2) {
            // For user login
            echo "<script>
                    alert('User Login successfully!');
                    window.location.href = 'main.php';
                  </script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
       <div  class="login border p-4 bg-light rounded">
         <form action="login.php" method="post">
            <h3 class="text-center">Login</h3>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
            </div>
            <br>
            <button type="submit" name="login" class="btn btn-primary w-100 mb-3">Login</button>
        </form>
        <a href="register.php" class="btn btn-secondary w-100">Register</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>