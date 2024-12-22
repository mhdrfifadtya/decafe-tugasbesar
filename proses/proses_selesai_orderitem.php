<?php
session_start();
include "connect.php";

$id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
$catatan = isset($_POST['catatan']) ? htmlentities($_POST['catatan']) : '';


if (!empty($_POST['selesai_orderitem'])) {
    $query = mysqli_query($conn, "UPDATE tb_list_order SET catatan='$catatan', status=2 WHERE id_list_order='$id'");
    if ($query) {
        echo '<script>alert("Pesanan telah selesai, siap untuk disajikan!"); 
              window.location="../dapur";</script>';
    } else {
        echo '<script>alert("Gagal proses data: ' . $conn->error . '"); 
              window.location="../dapur";</script>';
    }
}
?>