<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connect.php"; // Pastikan koneksi database

// Ambil nilai POST
$id = isset($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : '';
$kode_order = isset($_POST['kode_order']) ? mysqli_real_escape_string($conn, $_POST['kode_order']) : '';
$meja = isset($_POST['meja']) ? mysqli_real_escape_string($conn, $_POST['meja']) : '';
$pelanggan = isset($_POST['pelanggan']) ? mysqli_real_escape_string($conn, $_POST['pelanggan']) : '';

// Periksa apakah ID tidak kosong
if (!empty($id)) {
    // Query DELETE
    $query = "DELETE FROM tb_list_order WHERE id_list_order = '$id'";
    if (mysqli_query($conn, $query)) {
        echo '<script>
            alert("Data berhasil dihapus.");
            window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '";
        </script>';
    } else {
        die("Gagal menghapus data: " . mysqli_error($conn));
    }
} else {
    die("ID tidak valid. Tidak ada data yang dihapus.");
}
?>
