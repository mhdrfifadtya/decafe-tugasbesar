<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$_SESSION[username_decafe]'");
$records = mysqli_fetch_array($query);
?>

<nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">
    <div class="container-lg">
        <a class="navbar-brand" href="."><i class="bi bi-cup-hot"></i> DeCafe</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo htmlspecialchars($records['username']); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <!-- Informasi tambahan -->
                        <li class="dropdown-header">
                            <i class="bi bi-person-circle" style="font-size: 30px;"></i>
                            <?php echo htmlspecialchars($records['nama']); ?><br>
                            <small>
                                <?php
                                switch ($records['level']) {
                                    case 1:
                                        echo 'Level: Admin';
                                        break;
                                    case 2:
                                        echo 'Level: Kasir';
                                        break;
                                    case 3:
                                        echo 'Level: Pelayan';
                                        break;
                                    case 4:
                                        echo 'Level: Dapur';
                                        break;
                                    default:
                                        echo 'Level: Tidak Diketahui';
                                        break;
                                }
                                ?>
                            </small>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <!-- Menu dropdown -->
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahProfile"><i class="bi bi-person-square"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword"><i class="bi bi-key"></i> Ubah Password</a></li>
                        <li><a class="dropdown-item logout-link" href="logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Ubah Password -->
<div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_password.php" method="POST">
                    <input type="hidden" value="<?php echo $records['id']; ?>" name="id">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" name="username" required value="<?php echo $_SESSION['username_decafe'] ?>">
                                <label for="floatingUsername">Username (Email)</label>
                                <div class="invalid-feedback">Masukkan Username.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="passwordlama" required>
                                <label for="floatingPassword">Password Lama</label>
                                <div class="invalid-feedback">Masukkan Password Lama.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="passwordbaru" required>
                                <label for="floatingInput">Password Baru</label>
                                <div class="invalid-feedback">Masukkan Password Baru.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="repasswordbaru" required>
                                <label for="floatingInput">Ulangi Password Baru</label>
                                <div class="invalid-feedback">Masukkan Ulang Password Baru.</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="ubah_password_validate">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah Profile -->
<div class="modal fade" id="ModalUbahProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_profile.php" method="POST">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input readonly type="email" class="form-control" name="username" required value="<?php echo $_SESSION['username_decafe']; ?>">
                                <label for="floatingInput">Username (Email)</label>
                                <div class="invalid-feedback">Masukkan Username.</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="nama" required value="<?php echo $records['nama']; ?>">
                                <label for="floatingNama">Nama</label>
                                <div class="invalid-feedback">Masukkan Nama Anda.</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="no_handphone" required value="<?php echo $records['no_handphone']; ?>">
                                <label for="floatingNoHandphone">Nomor Handphone</label>
                                <div class="invalid-feedback">Masukkan Nomor Handphone Anda.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" style="height:100px" name="alamat" required><?php echo $records['alamat']; ?></textarea>
                                <label for="floatingAlamat">Alamat</label>
                                <div class="invalid-feedback">Masukkan Alamat Anda.</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="ubah_profile_validate">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert untuk konfirmasi logout -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelector('.logout-link').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'logout';
            }
        });
    });
</script>


