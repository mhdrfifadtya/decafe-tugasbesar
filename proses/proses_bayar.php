<?php
session_start();
include "connect.php";

$kode_order = isset($_POST['kode_order']) ? htmlentities($_POST['kode_order']) : '';
$meja = isset($_POST['meja']) ? htmlentities($_POST['meja']) : '';
$pelanggan = isset($_POST['pelanggan']) ? htmlentities($_POST['pelanggan']) : '';
$total = isset($_POST['total']) ? htmlentities($_POST['total']) : '';
$uang = isset($_POST['uang']) ? htmlentities($_POST['uang']) : '';
$kembalian = $uang - $total;
$kembalian_formatted = number_format($kembalian, 2, ',', '.');

if (!empty($_POST['bayar'])) {
    if ($kembalian < 0) {
        echo '<script>alert("Nominal Uang Tidak Mencukupi!"); 
              window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_bayar (id_bayar, nominal_uang, total_bayar) VALUES ('$kode_order','$uang', '$total')");
        if ($query) {
            echo '<script>alert("Pembayaran Berhasil \nUang Kembalian Rp.' . $kembalian_formatted . '");
                  window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";</script>';
        } else {
            echo '<script>alert("Pembayaran gagal");
                  window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";</script>';
        }
    }
}
