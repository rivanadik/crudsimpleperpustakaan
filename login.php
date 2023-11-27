<?php
include 'config.php';

session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['login_submit'])) {
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];

        // Set cookie to store username for 7 days
        setcookie("username", $user['username'], time() + (7 * 24 * 60 * 60), "/");

        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Woops! Email or Password is Incorrect.')</script>";
    }
}

// Handle "Forgot Password" link
if(isset($_GET['forgot_password'])){
    header("Location: forgot_password.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Login</title>
</head>

<body>
    <div class="container">
        <form action="login.php?forgot_password" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="login_email" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="login_password" required>
            </div>
            <div class="input-group">
                <button name="login_submit" class="btn">Login</button>
            </div>
        </form>
        <p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
    </div>
</body>

</html>