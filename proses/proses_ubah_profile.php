<?php
session_start();
include "connect.php"; 

if (isset($_POST['ubah_profile_validate']) && $_POST['ubah_profile_validate'] === 'submit') {
    $nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : "";
    $no_handphone = isset($_POST['no_handphone']) ? htmlentities($_POST['no_handphone']) : "";
    $alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : "";
    $username = isset($_POST['username']) ? htmlentities($_POST['username']) : "";

    if (empty($nama) || empty($no_handphone) || empty($alamat) || empty($username)) {
        echo '<script>alert("Semua data harus diisi!"); window.history.back();</script>';
        exit;
    }
    $stmt = $conn->prepare("UPDATE tb_user SET nama = ?, no_handphone = ?, alamat = ? WHERE username = ?");
    $stmt->bind_param("ssss", $nama, $no_handphone, $alamat, $username);
    if ($stmt->execute()) {
        echo '<script>alert("Data Profile Berhasil Diubah!"); window.history.back();</script>';
    } else {
        echo '<script>alert("Data Profile Gagal Diubah: ' . $stmt->error . '"); window.history.back();</script>';
    }

    $stmt->close();
} else {
    echo '<script>alert("Form tidak dikirim dengan benar!"); window.history.back();</script>';
}

$conn->close();
?>