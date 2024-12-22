<?php
include "connect.php";

// Mendapatkan input dari form

$nama_menu = isset($_POST['nama_menu']) ? htmlentities($_POST['nama_menu']) : '';
$keterangan = isset($_POST['keterangan']) ? htmlentities($_POST['keterangan']) : '';
$kat_menu = isset($_POST['kat_menu']) ? htmlentities($_POST['kat_menu']) : '';
$harga = isset($_POST['harga']) ? htmlentities($_POST['harga']) : '';
$stok = isset($_POST['stok']) ? htmlentities($_POST['stok']) : '';
$kode_rand = rand(10000, 99999). "-";
$target_dir = "../assets/img/".$kode_rand;

// Cek apakah form di-submit dengan file yang diunggah
if (!empty($_POST['input_menu']) && isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $target_file = $target_dir . basename($_FILES['foto']['name']);
    $imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file adalah gambar
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek === false) {
        $message = "Ini bukan file gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;
        
        // Cek jika file sudah ada
        if (file_exists($target_file)) {
            $message = "Maaf, file yang dimasukkan sudah ada";
            $statusUpload = 0;
        } else {
            // Cek ukuran file
            if ($_FILES['foto']['size'] > 500000) { // 500KB
                $message = "File foto yang diupload terlalu besar";
                $statusUpload = 0;
            } else {
                // Cek ekstensi file
                if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
                    $message = "Maaf, hanya format JPG, PNG, JPEG, dan GIF yang diperbolehkan.";
                    $statusUpload = 0;
                }
            }
        }
    }

    // Jika ada kesalahan pada statusUpload, tampilkan pesan error
    if ($statusUpload == 0) {
        echo '<script>alert("' . $message . ', Gambar tidak dapat diupload"); 
              window.location="../daftarmenu";</script>';
    } else {
        // Cek apakah nama menu sudah ada
        $select = mysqli_query($conn, "SELECT * FROM tb_daftar_menu WHERE nama_menu = '$nama_menu'");
        if (mysqli_num_rows($select) > 0) {
            echo '<script>alert("Nama menu yang dimasukkan telah ada!"); 
                  window.location = "../daftarmenu";</script>';
        } else {
            // Pindahkan file jika tidak ada masalah
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                // Masukkan data ke dalam database
                $query = mysqli_query($conn, "INSERT INTO tb_daftar_menu (foto, nama_menu, keterangan, kategori, harga, stok) VALUES ('".$kode_rand.$_FILES['foto']['name']."', '$nama_menu', '$keterangan', '$kat_menu', '$harga', '$stok')");  
                if ($query) {
                    $message = "Data berhasil diupload";
                    echo '<script>alert("' . $message . '"); 
                          window.location="../daftarmenu";</script>';
                } else {
                    $message = "Data gagal di update";
                    echo '<script>alert("' . $message . '"); 
                          window.location="../daftarmenu";</script>';
                }
            } else {
                $message = "Terjadi kesalahan saat mengupload gambar";
                echo '<script>alert("' . $message . '"); 
                      window.location="../daftarmenu";</script>';
            }
        }
    }
} else {
    // Jika input_menu atau file foto kosong
    $message = "Tidak ada file yang diupload atau input_menu kosong";
    echo '<script>alert("' . $message . '"); 
          window.location="../daftar_menu";</script>';
}
?>
