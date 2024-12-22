<?php
session_start();
include "connect.php";
$id = isset($_POST['id']) ? htmlentities($_POST['id']) : '';
$catatan = isset($_POST['catatan']) ? htmlentities($_POST['catatan']) : '';

if (!empty($_POST['terima_orderitem'])) {
    if (empty($id)) {
        echo '<script>alert("ID pesanan tidak valid."); 
              window.location="../dapur";</script>';
        exit;
    }
    $stmt = $conn->prepare("UPDATE tb_list_order SET catatan = ?, status = 1 WHERE id_list_order = ?");
    $stmt->bind_param("si", $catatan, $id);

    if ($stmt->execute()) {
        echo '<script>alert("Pesanan berhasil diterima oleh Dapur."); 
              window.location="../dapur";</script>';
    } else {
        error_log("Error: " . $stmt->error);
        echo '<script>alert("Pesanan gagal diterima. Silakan coba lagi."); 
              window.location="../dapur";</script>';
    }
}
?>
