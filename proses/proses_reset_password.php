<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// session_start();
include "connect.php"; 

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$message = ""; // Inisialisasi

if (isset($_POST['reset_password'])) { // Menggunakan isset daripada empty
    $id = mysqli_real_escape_string($conn, $id); 
    $query = mysqli_query($conn, "UPDATE tb_user SET password = MD5('password') WHERE id = '$id'");
    
    if ($query) {
        echo "<script>alert('Password berhasil di reset'); window.location='../user';</script>";
    } else {
        echo "<script>alert('Gagal mereset password: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "No data received";
}
