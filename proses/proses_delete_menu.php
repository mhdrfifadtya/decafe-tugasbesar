<?php
include "connect.php"; 
$id = isset($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : "";
$foto = isset($_POST['foto']) ? mysqli_real_escape_string($conn, $_POST['foto']) : "";
$message = "";

if (isset($_POST['delete_menu']) && !empty($id)) {
    $query = $conn->prepare("DELETE FROM tb_daftar_menu WHERE id = ?");
    $query->bind_param("s", $id);

    if ($query->execute()) {
        $foto_path = "../assets/img/$foto";
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }
        $message = '<script>alert("Data berhasil dihapus");
                    window.location="../menu"</script>';
    } else {
        $message = '<script>alert("Data gagal dihapus");
                    window.location="../menu"</script>';
    }
} else {
    $message = '<div class="alert alert-warning" role="alert">
                Data tidak valid atau permintaan tidak sah.
                </div>';
}

echo $message;
?>
