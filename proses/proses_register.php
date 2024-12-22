<?php
session_start();
include "connect.php";

if (isset($_POST['submitRegister'])) {
    $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $no_handphone = mysqli_real_escape_string($conn, trim($_POST['no_handphone']));
    $alamat = mysqli_real_escape_string($conn, trim($_POST['alamat']));
    $password = isset($_POST['password']) ? md5(htmlentities($_POST['password'])) : '';
    $level = isset($_POST['level']) ? intval($_POST['level']) : 0;

    $query_check = "SELECT * FROM tb_user WHERE username = ?";
    $stmt_check = $conn->prepare($query_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo '<script>alert("Email sudah terdaftar!"); window.location="../register.php";</script>';
    } else {
        $query_insert = "INSERT INTO tb_user (nama, username, level, no_handphone, alamat, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($query_insert);
        $stmt_insert->bind_param("ssisss", $nama, $username, $level, $no_handphone, $alamat, $password);
        
        if ($stmt_insert->execute()) {
            echo '<script>alert("Pendaftaran berhasil, Silahkan Login!"); window.location="../login.php";</script>';
        } else {
            echo '<div class="alert alert-danger">Gagal mendaftar. Silakan coba lagi.</div>';
        }
    }

    $stmt_check->close();
    $stmt_insert->close();
    $conn->close();
}
?>
