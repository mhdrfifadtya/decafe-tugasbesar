<?php
include "connect.php"; 
$id = isset($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : "";
$message = "";

if (isset($_POST['delete_katmenu']) && !empty($id)) {
    $select = mysqli_query($conn, "SELECT kategori FROM tb_daftar_menu WHERE kategori = '$id'");
    if (mysqli_num_rows($select) > 0) {
        echo '<script>alert("Kategori yang dimasukkan sedang digunakan dan tidak dapat dihapus!"); 
              window.location="../katmenu";</script>';
    } else {
        $query = $conn->prepare("DELETE FROM tb_kategori_menu WHERE id_kat_menu = ?");
        $query->bind_param("s", $id);

        if ($query->execute()) {
            $message = '<script>alert("Data berhasil dihapus"); window.location="../katmenu";</script>';
        } else {
            $message = '<script>alert("Data gagal dihapus"); window.location="../katmenu";</script>';
        }
    }
} else {
    $message = '<script>alert("Data tidak valid atau permintaan tidak sah"); window.location="../katmenu";</script>';
}

echo $message;
?>
