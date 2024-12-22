<?php
session_start();
include "connect.php";
$nama = isset($_POST['nama']) ? htmlentities($_POST['nama']) : '';
$username = isset($_POST['username']) ? htmlentities($_POST['username']) : '';
$level = isset($_POST['level']) ? intval($_POST['level']) : 0;
$no_handphone = isset($_POST['no_handphone']) ? htmlentities($_POST['no_handphone']) : '';
$alamat = isset($_POST['alamat']) ? htmlentities($_POST['alamat']) : '';
$password = md5('password');

if (!empty($_POST['input_user'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($select) > 0) {
        echo '<script>alert("Username yang dimasukkan telah ada!"); 
              window.location="../user";</script>';
    } else {

        $query = mysqli_query($conn, "INSERT INTO tb_user (nama, username, level, no_handphone, alamat, password) VALUES ('$nama', '$username', '$level', '$no_handphone', '$alamat', '$password')");
        if ($query) {
            echo '<script>alert("Data Berhasil Ditambahkan");
              window.location="../user";</script>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Gagal menyimpan data. Silakan coba lagi.</div>';
        }
    }
}
?>