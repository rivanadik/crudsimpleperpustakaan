<?php

    $servername = "localhost";
    $username = "root";
    $password = "";

    //membuat koneksi ke database
    try {
        $conn = new PDO("mysql:host=$servername;dbname=dbcrud2023", $username, $password);
        // Pengaturan koneksi ke database
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

?>