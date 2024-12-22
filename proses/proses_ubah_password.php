<?php
session_start();
include "connect.php";
$id = isset($_POST['id']) ? htmlentities($_POST['id']) : "";
$passwordlama = isset($_POST['passwordlama']) ? htmlentities($_POST['passwordlama']) : "";
$passwordbaru = isset($_POST['passwordbaru']) ? htmlentities($_POST['passwordbaru']) : "";
$repasswordbaru = isset($_POST['repasswordbaru']) ? htmlentities($_POST['repasswordbaru']) : "";
$user_stmt = $conn->prepare("SELECT id, password FROM tb_user WHERE username = ?");
$user_stmt->bind_param("s", $_SESSION['username_decafe']);
$user_stmt->execute();
$user_stmt->bind_result($id, $currentPasswordHash);
$user_stmt->fetch();
$user_stmt->close();

echo "Password Lama Hash dari Database: $currentPasswordHash<br>";
echo "ID User: $id <br>";

if (isset($_POST['ubah_password_validate'])) {
    $isPasswordValid = false;

    if ($currentPasswordHash === md5($passwordlama)) {
        $isPasswordValid = true;
    }

    if ($isPasswordValid) {
        if ($passwordbaru === $repasswordbaru) {
            $newPasswordHash = md5($passwordbaru);
            echo "Password Hash Baru (md5): $newPasswordHash <br>";

            $update_stmt = $conn->prepare("UPDATE tb_user SET password = ? WHERE id = ?");
            $update_stmt->bind_param("si", $newPasswordHash, $id);
            
            if ($update_stmt->execute()) {
                echo '<script>alert("Password berhasil diubah!"); window.location.href = "../home";</script>';
            } else {
                echo '<script>alert("Gagal mengubah password: ' . $update_stmt->error . '"); window.history.back();</script>';
            }
            $update_stmt->close();
        } else {
            echo '<script>alert("Password baru tidak sama!"); window.history.back();</script>';
        }
    } else {
        echo '<script>alert("Password lama tidak sesuai!"); window.history.back();</script>';
    }
} else {
    header('location:../home');
}
?>
