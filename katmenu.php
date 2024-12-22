<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_kategori_menu");
$result = []; // Inisialisasi array $result agar dapat digunakan walaupun data kosong
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Kategori Menu
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah Kategori Menu</button>
                </div>

                <!-- Modal Tambah Kategori Baru -->
                <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form Tambah User dengan Form Floating Label -->
                                <form class="needs-validation" novalidate action="proses/proses_input_katmenu.php" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="jenismenu" id="">
                                                    <option value="1">Makanan</option>
                                                    <option value="2">Minuman</option>
                                                </select>
                                                <label for="floatingInput">Jenis Menu</label>
                                                <div class="invalid-feedback">
                                                    Please enter Menu Type.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingUsername" placeholder="Kategori Menu" name="katmenu" required>
                                                <label for="floatingUsername">Kategori Menu</label>
                                                <div class="invalid-feedback">
                                                    Please enter Menu Category.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="input_katmenu" value="12345">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Kategori User Baru -->

                <!-- Modal Edit -->
                <?php foreach ($result as $row) { ?>
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_kat_menu']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kategori Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_katmenu.php" method="POST">
                                        <input type="hidden" value="<?php echo $row['id_kat_menu'] ?>" name="id">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example" required name="jenis_menu" id="">
                                                        <?php
                                                        $data = array("Makanan", "Minuman");
                                                        foreach ($data as $key => $value) {
                                                            $selected = ($row['jenis_menu'] == $key + 1) ? "selected" : "";
                                                            echo "<option value='" . ($key + 1) . "' $selected>$value</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingInput">Jenis Menu</label>
                                                    <div class="invalid-feedback">
                                                        Please enter Menu Type.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingUsername" placeholder="Kategori Menu" name="katmenu" required value="<?php echo $row['kategori_menu'] ?>">
                                                    <label for="floatingUsername">Kategori Menu</label>
                                                    <div class="invalid-feedback">
                                                        Please enter Menu Category.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="edit_katmenu" value="12345">Save changes</button>
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
                    <div class="modal fade" id="ModalDelete<?php echo $row['id_kat_menu']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Kategori Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/proses_delete_katmenu.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_kat_menu']; ?>">
                                        <div class="col-lg-12">
                                            Apakah anda ingi menghapus kategori 
                                            <b><?php 
                                            echo $row['kategori_menu']
                                             ?>
                                             </b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                          
                                                <button type="submit" class="btn btn-danger" name="delete_katmenu">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal Delete -->

                <?php
                if (empty($result)) {
                    echo "Data user tidak ada";
                } else {
                ?>
                    <!-- Tabel daftar kategori menu -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jenis Menu</th>
                                    <th scope="col">Kategori Menu</th>
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
                                        <td><?php
                                            echo ($row['jenis_menu'] == 1) ? "Makanan" : "Minuman" ?>
                                        </td>
                                        <td><?php echo $row['kategori_menu']; ?></td>
                                        <td class="d-flex">
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_kat_menu']; ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_kat_menu']; ?>"><i class="bi bi-trash3"></i></button>
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
<!-- Akhir Tabel daftar kategori menu -->