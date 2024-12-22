<?php
session_start();
include "connect.php";
$id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
$kode_order = isset($_POST['kode_order']) ? htmlentities($_POST['kode_order']) : '';
$meja = isset($_POST['meja']) ? htmlentities($_POST['meja']) : '';
$pelanggan = isset($_POST['pelanggan']) ? htmlentities($_POST['pelanggan']) : '';
$menu = isset($_POST['menu']) ? htmlentities($_POST['menu']) : '';
$jumlah = isset($_POST['jumlah']) ? htmlentities($_POST['jumlah']) : '';
$catatan = isset($_POST['catatan']) ? htmlentities($_POST['catatan']) : '';

if (!empty($_POST['edit_orderitem'])) {
    $select = mysqli_query($conn, " SELECT * FROM tb_list_order WHERE menu = '$menu' && kode_order='$kode_order' && id_list_order != '$id' ");
    if (mysqli_num_rows($select) > 0) {
        echo '<script>alert("item yang di masukkan telah ada."); 
              window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";</script>';
    } else {
        $query = $conn->prepare("UPDATE tb_list_order SET menu = ?, jumlah = ?, catatan = ? WHERE id_list_order = ?");
        $query->bind_param("sisi", $menu, $jumlah, $catatan, $id);

        if ($query->execute()) {
            echo '<script>alert("Data Berhasil Diubah."); 
              window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";</script>';
        } else {
            echo '<script>alert("Data gagal diubah: ' . $conn->error . '"); 
              window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";</script>';
        }
    }
}
