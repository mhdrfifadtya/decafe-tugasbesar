<?php
session_start();
include "connect.php";
$id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
$jenismenu = isset($_POST['jenis_menu']) ? htmlentities($_POST['jenis_menu']) : '';
$katmenu = isset($_POST['katmenu']) ? htmlentities($_POST['katmenu']) : '';

// Proses edit data
if (isset($_POST['edit_katmenu'])) {
    $select = mysqli_query($conn, "SELECT kategori_menu FROM tb_kategori_menu WHERE kategori_menu = '$katmenu'");
    if (mysqli_num_rows($select) > 0) {
        echo '<script>alert("Kategori Menu yang dimasukkan telah ada!"); 
              window.location="../katmenu";</script>';
    } else {
        $query = mysqli_query($conn, "UPDATE tb_kategori_menu SET 
                                    jenis_menu = '$jenismenu', 
                                    kategori_menu = '$katmenu' 
                                    WHERE id_kat_menu = '$id'"); 

        if ($query) {
            echo '<script>alert("Data Berhasil Diperbarui"); window.location.href="../katmenu";</script>';
        } else {
            echo '<script>alert("Gagal memperbarui data. Silakan coba lagi.");</script>';
        }
    }
}
