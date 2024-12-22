<?php
session_start();
include "connect.php";
$kode_order = isset($_POST['kode_order']) ? htmlentities($_POST['kode_order']) : '';
$meja = isset($_POST['meja']) ? htmlentities($_POST['meja']) : '';
$pelanggan = isset($_POST['pelanggan']) ? htmlentities($_POST['pelanggan']) : ''; 
$catatan = isset($_POST['catatan']) ? htmlentities($_POST['catatan']) : '';
$menu = isset($_POST['menu']) ? htmlentities($_POST['menu']) : '';
$jumlah = isset($_POST['jumlah']) ? htmlentities($_POST['jumlah']) : '';

if (!empty($_POST['input_orderitem'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_list_order WHERE menu = '$menu' && kode_order ='$kode_order'");
    if (mysqli_num_rows($select) > 0) { 
        echo '<script>alert("Item yang dimasukkan telah ada!"); 
              window.location="../?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'";</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_list_order (menu,kode_order,jumlah,catatan) VALUES ('$menu','$kode_order', '$jumlah','$catatan')");
        if ($query) {
            echo '<script>alert("Order Berhasil Ditambahkan");
                  window.location="../?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'";</script>';
        } else {
           '<script>alert("Order gagal Ditambahkan");
                  window.location="../?x=orderitem&order='.$kode_order.'&meja='.$meja.'&pelanggan='.$pelanggan.'";</script>';
        }
    }
}
?>
