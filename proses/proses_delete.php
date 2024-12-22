<?php
session_start();
include "connect.php"; 

$id = isset($_POST['id']) ? intval($_POST['id']) : "";

if (isset($_POST['delete_user']) && $id > 0) {
    // Menggunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("DELETE FROM tb_user WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("Data Berhasil Dihapus"); window.location="../user";</script>';
    } else {
        echo '<script>alert("Data Gagal Dihapus"); window.location="../user";</script>';
    }
    $stmt->close();
} else {
    // Jika id tidak valid atau tombol delete_user tidak diklik
    echo '<div class="alert alert-warning" role="alert">
            ID tidak valid atau permintaan tidak sah.
          </div>';
}

$conn->close();
?>
