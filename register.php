<?php
include 'config.php';

session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['register_submit'])) {
    $username = $_POST['register_username'];
    $email = $_POST['register_email'];
    $password = $_POST['register_password'];
    $cpassword = $_POST['register_cpassword'];

    if ($password === $cpassword) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                // Registration successful, redirect to login.php
                header("Location: login.php");
                exit;
            } else {
                echo "<script>alert('Woops! Something Went Wrong.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Already Exists.')</script>";
        }
    } else {
        echo "<script>alert('Password Not Matched.')</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Register</title>
</head>

<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="register_username" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="register_email" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="register_password" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="register_cpassword" required>
            </div>
            <div class="input-group">
                <button name="register_submit" class="btn">Register</button>
            </div>
        </form>
        <p class="login-register-text">Already have an account? <a href="login.php">Login Here</a>.</p>
    </div>
</body>

</html>