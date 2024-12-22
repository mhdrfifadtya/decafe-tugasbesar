<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user");
$result = [];
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman User
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah User</button>
                </div>
                <!-- Modal Tambah User Baru -->
                <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_input.php" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingNama" placeholder="Nama" name="nama" required>
                                                <label for="floatingNama">Nama</label>
                                                <div class="invalid-feedback">
                                                    Please enter your name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="floatingUsername" placeholder="Username" name="username" required>
                                                <label for="floatingUsername">Username (Email)</label>
                                                <div class="invalid-feedback">
                                                    Please enter your email.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" name="level" required>
                                                    <option selected hidden value="">Pilih Level User</option>
                                                    <option value="1">Owner/Admin</option>
                                                    <option value="2">Kasir</option>
                                                    <option value="3">Pelayan</option>
                                                    <option value="4">Dapur</option>
                                                </select>
                                                <label for="floatingUsername">Level User</label>
                                                <div class="invalid-feedback">
                                                    Please choose your level.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingNoHandphone" placeholder="no_handphone" name="no_handphone" required>
                                                <label for="floatingNoHandphone">No Handphone</label>
                                                <div class="invalid-feedback">
                                                    Please enter your No Handphone.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="floatingPassword" placeholder="password" value="password" name="password" required readonly>
                                            <label for="floatingPassword">Password</label>
                                            <div class="invalid-feedback">
                                                Please enter your password.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" id="" style="height:100px" name="alamat" required></textarea>
                                        <label for="floatingInput">Alamat</label>
                                        <div class="invalid-feedback">
                                            Please enter your alamat.
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="input_user" value="12345">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Tambah User Baru -->


                <?php foreach ($result as $row) {
                ?>
                    <!-- Modal View -->
                    <div class="modal fade" id="ModalView<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_input.php" method="POST">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="text" class="form-control" placeholder="Nama" name="nama" value="<?php echo $row['nama']; ?>">
                                                    <label for="floatingNama">Nama</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="email" class="form-control" placeholder="Username" name="username" value="<?php echo $row['username']; ?>">
                                                    <label for="floatingUsername">Username (Email)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="text" class="form-control" value="<?php echo ($row['level'] == 1 ? 'Admin' : ($row['level'] == 2 ? 'Kasir' : ($row['level'] == 3 ? 'Pelayan' : 'Dapur'))); ?>">
                                                    <label for="floatingUsername" value="">Pilih Level User</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="text" class="form-control" placeholder="No Handphone" name="no_handphone" value="<?php echo $row['no_handphone']; ?>">
                                                    <label for="floatingNoHandphone">No Handphone</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea disabled class="form-control" style="height:100px" name="alamat"><?php echo $row['alamat']; ?></textarea>
                                            <label for="floatingInput">Alamat</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal View -->

                <!-- Modal Edit -->
                <?php foreach ($result as $row) { ?>
                    <div class="modal fade" id="ModalEdit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit.php" method="POST">
                                        <div class="row">
                                            <input type="hidden" value="<?php echo $row['id']; ?>" name="id"> <!-- Menggunakan id yang benar -->
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" placeholder="Nama" name="nama" required value="<?php echo $row['nama']; ?>">
                                                    <label for="floatingNama">Nama</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input <?php echo ($row['username'] == $_SESSION['username_decafe']) ? 'disabled' : ''; ?> type="email" class="form-control" placeholder="Username" name="username" required value="<?php echo $row['username']; ?>">
                                                    <label for="floatingUsername">Username (Email)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example" required name="level" id="">
                                                        <?php
                                                        $data = array("Owner/Admin", "Kasir", "Pelayan", "Dapur");
                                                        foreach ($data as $key => $value) {
                                                            $selected = ($row['level'] == $key + 1) ? "selected" : ""; // Memastikan nilai level yang benar
                                                            echo "<option value='" . ($key + 1) . "' $selected>$value</option>";;
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingLevel">Level User</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" placeholder="No Handphone" name="no_handphone" required value="<?php echo $row['no_handphone']; ?>">
                                                    <label for="floatingNoHandphone">No Handphone</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" style="height:100px" name="alamat" required><?php echo $row['alamat']; ?></textarea>
                                            <label for="floatingAlamat">Alamat</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="edit_user">Save changes</button> <!-- Tidak perlu value pada name="input_user" -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal Edit -->

                <!-- Modal Delete -->
                <?php foreach ($result as $row) { ?>
                    <div class="modal fade" id="ModalDelete<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/proses_delete.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <div class="col-lg-12">
                                            <?php
                                            if ($row['username'] == $_SESSION['username_decafe']) {
                                                echo "<div class='alert alert-danger'>Anda tidak dapat menghapus akun sendiri!</div>";
                                            } else {
                                                echo "Apakah anda yakin ingin menghapus user <b>" . $row['username'] . "</b>?";
                                            }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                            <?php if ($row['username'] != $_SESSION['username_decafe']) { ?>
                                                <button type="submit" class="btn btn-danger" name="delete_user">Delete</button>
                                            <?php } ?>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal Delete -->

                <!-- Modal Reset Password -->
                <?php foreach ($result as $row) { ?>
                    <div class="modal fade" id="ModalResetPassword<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Password</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/proses_reset_password.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <div class="col-lg-12">
                                            <?php
                                            if ($row['username'] == $_SESSION['username_decafe']) {
                                                echo "<div class='alert alert-danger'>Anda tidak dapat mereset password sendiri!</div>";
                                            } else {
                                                echo "Apakah anda yakin ingin mereset password user <b>" . $row['username'] . "</b> menjadi password bawaan sistem yaitu <b>password</b>";
                                            }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                            <?php if ($row['username'] != $_SESSION['username_decafe']) { ?>
                                                <button type="submit" class="btn btn-success" name="reset_password">Reset Password</button>
                                            <?php } ?>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal Reset Password -->


                <?php
                if (empty($result)) {
                    echo "Data user tidak ada";
                } else {
                ?>
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">No Handphone</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($result as $row) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++; ?></th>
                                        <td class="text-nowrap"><?php echo $row['nama']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo ($row['level'] == 1 ? 'Admin' : ($row['level'] == 2 ? 'Kasir' : ($row['level'] == 3 ? 'Pelayan' : 'Dapur'))); ?></td>
                                        <td><?php echo $row['no_handphone']; ?></td>
                                        <td class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id']; ?>"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id']; ?>"><i class="bi bi-trash3"></i></button>
                                            <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalResetPassword<?php echo $row['id']; ?>"><i class="bi bi-key"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>