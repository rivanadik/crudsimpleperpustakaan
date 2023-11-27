<<?php
session_start();
include "config.php";

if (isset($_POST["submit"])) {
    $password1 = $_POST['password1']; 
    $password2 = $_POST['password2']; 
    $username = $_SESSION['username'];

    if ($password1 != $password2) {
        echo '<script> alert("Password tidak sama");</script>';
    } else {
        $password = password_hash($password1, PASSWORD_DEFAULT);
        try {
            $query = "UPDATE users SET password = :password WHERE username = :username";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            echo '<script> alert("Update berhasil");
                window.location="dashboard.php"
            </script>';
        } catch (PDOException $e) {
            echo "Error updating record: " . $e->getMessage();
        }
    }
}
?> <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Update Password</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous" />
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="container">
            <form method="post" action="">
                <h2 class="login-text">Masukkan Password Baru Anda</h2>
                <div class="input-group mb-3">
                    <label for="password1" class="form-label">Password Baru</label>
                    <input type="password" name="password1" class="form-control form-control-lg" placeholder="Password"
                        required="" />
                </div>
                <div class="input-group mb-3">
                    <label for="password2" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password2" class="form-control form-control-lg"
                        placeholder="Konfirmasi Password" required="" />
                </div>
                <div class="input-group mb-3">
                    <input type="submit" value="Ubah" name="submit" class="btn btn-success btn-lg w-100" />
                </div>
            </form>
        </div>
    </body>

    </html>