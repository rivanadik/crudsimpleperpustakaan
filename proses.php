<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

$id = $_GET['id'];
$proses = $_GET['proses'];
$namabuku = $_POST['namabuku'];
$jenisbuku = $_POST['jenisbuku'];
$pengarang = $_POST['pengarang'];
$tahunterbit = $_POST['tahunterbit'];
$penerbit = $_POST['penerbit'];

if ($proses == "tambah") {
    $sql = "INSERT INTO tbuku (namabuku, jenisbuku, pengarang, tahunterbit, penerbit) VALUES (?, ?, ?, ?, ?)";
    $data = $conn->prepare($sql);
    $hasil = $data->execute([$namabuku, $jenisbuku, $pengarang, $tahunterbit, $penerbit]);
    if ($hasil) {
        echo '<script>alert("Berhasil");window.location="dashboard.php";</script>';
    } else {
        echo '<script>alert("Gagal");window.location="dashboard.php";</script>';
    }
} elseif ($proses == "edit") {
    $sql = "UPDATE tbuku SET namabuku=?, jenisbuku=?, pengarang=?, tahunterbit=?, penerbit=? WHERE idbuku=?";
    $data = $conn->prepare($sql);
    $hasil = $data->execute([$namabuku, $jenisbuku, $pengarang, $tahunterbit, $penerbit, $id]);
    if ($hasil) {
        echo '<script>alert("Berhasil");window.location="dashboard.php";</script>';
    } else {
        echo '<script>alert("Gagal");window.location="dashboard.php";</script>';
    }
} elseif ($proses == 'hapus') {
    $sql = "DELETE FROM tbuku WHERE idbuku=?";
    $data = $conn->prepare($sql);
    $hasil = $data->execute([$id]);
    if ($hasil) {
        echo '<script>alert("Berhasil");window.location="dashboard.php";</script>';
    } else {
        echo '<script>alert("Gagal");window.location="dashboard.php";</script>';
    }
}
?>