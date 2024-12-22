<?php
session_start();
include "connect.php";

$id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
$name = isset($_POST['nama']) ? htmlentities($_POST['nama']) : '';
$username = isset($_POST['username']) ? htmlentities($_POST['username']) : '';
$level = isset($_POST['level']) ? htmlentities($_POST['level']) : '';
$no_handphone = isset($_POST['no_handphone']) ? htmlentities($_POST['no_handphone']) : '';
$alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : '';

if (isset($_POST['edit_user'])) {
    $select_id = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = '$id'");
    if (mysqli_num_rows($select_id) == 0) {
        echo '<script>alert("ID pengguna tidak ditemukan."); 
              window.location="../user";</script>';
        exit;
    }
    $select_username = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' AND id != '$id'");
    if (mysqli_num_rows($select_username) > 0) {
        echo '<script>alert("Username yang dimasukkan telah digunakan!"); 
              window.location="../user";</script>';
    } else {
        $stmt = $conn->prepare("UPDATE tb_user SET 
                                nama = ?, 
                                username = ?, 
                                level = ?, 
                                no_handphone = ?, 
                                alamat = ? 
                                WHERE id = ?");
        $stmt->bind_param('sssssi', $name, $username, $level, $no_handphone, $alamat, $id);

        if ($stmt->execute()) {
            echo '<script>alert("Data Berhasil Diperbarui"); 
                  window.location.href="../user";</script>';
        } else {
            echo '<script>alert("Gagal memperbarui data: ' . $stmt->error . '");</script>';
        }
    }
}
?>
