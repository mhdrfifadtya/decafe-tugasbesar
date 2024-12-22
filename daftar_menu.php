<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu
    LEFT JOIN tb_kategori_menu ON tb_kategori_menu.id_kat_menu = tb_daftar_menu.kategori
");
$result = [];
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu, kategori_menu FROM tb_kategori_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Daftar Menu
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Modal Tambah Menu Baru -->
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah Menu</button>
                </div>
                <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan & Minuman</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <!-- Container Preview -->
                                            <div class="image-preview-container mb-3 text-center">
                                                <label for="uploadFoto" class="d-block mb-2 fw-bold">Preview Image</label>
                                                <div class="image-preview rounded shadow-sm p-3 bg-light">
                                                    <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px; display: none; object-fit: cover;">
                                                </div>
                                            </div>
                                            <!-- Input File -->
                                            <div class="input-group">
                                                <input type="file" class="form-control py-3" id="uploadFoto" name="foto" required onchange="previewImage(event)">
                                                <label class="input-group-text" for="uploadFoto">Upload Foto Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukkan File Foto Menu
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Nama Menu" name="nama_menu" required>
                                                <label for="floatingInput">Nama Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nama Menu.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" name="kat_menu" required>
                                                    <option selected hidden value="">Pilih Kategori Menu</option>
                                                    <?php
                                                    foreach ($select_kat_menu as $value) {
                                                        echo <<<OPTION
                                                        <option value="{$value['id_kat_menu']}">{$value['kategori_menu']}</option>
                                                    OPTION;
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingUsername">Kategori Makanan atau Minuman</label>
                                                <div class="invalid-feedback">
                                                    Please select food or beverage category.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="Harga" name="harga" required>
                                                <label for="floatingInput">Harga</label>
                                                <div class="invalid-feedback">
                                                    Please enter price.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="Stok" name="stok" required>
                                                <label for="floatingInput">Stok</label>
                                                <div class="invalid-feedback">
                                                    Please enter stock.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Keterangan" name="keterangan">
                                                <label for="floatingInput">Keterangan</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="input_menu" value="12345">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Tambah Menu Baru -->

                <!-- Toast Notifications for Success or Error -->
                <div class="toast align-items-center text-bg-success" id="successToast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 20px; right: 20px; z-index: 1050; display: none;">
                    <div class="d-flex">
                        <div class="toast-body">
                            Menu berhasil ditambahkan!
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>


                <?php foreach ($result as $row) {
                ?>
                    <!-- Modal View -->
                    <div class="modal fade" id="ModalView<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Menu Makanan & Minuman</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['nama_menu']; ?>">
                                                    <label for="floatingInput">Nama Menu</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Nama Menu.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['keterangan']; ?>">
                                                    <label for="floatingInput">Keterangan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <select disabled class="form-select" aria-label="Default select example" value="<?php echo $row['kategori_menu']; ?>">
                                                        <option selected hidden value="">Pilih Kategori Menu</option>
                                                        <?php
                                                        foreach ($select_kat_menu as $value) {
                                                            if ($row['kategori'] == $value['id_kat_menu']) {
                                                                echo <<<OPTION
                                                        <option selected value="{$value['id_kat_menu']}">{$value['kategori_menu']}</option>
                                                    OPTION;
                                                            } else {
                                                                echo <<<OPTION
                                                            <option value="{$value['id_kat_menu']}">{$value['kategori_menu']}</option>
                                                        OPTION;
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for=" floatingUsername">Kategori Makanan atau Minuman</label>
                                                    <div class="invalid-feedback">
                                                        Please select food or beverage category.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="number" class="form-control" id="floatingInput" value="<?php echo $row['harga']; ?>">
                                                    <label for="floatingInput">Harga</label>
                                                    <div class="invalid-feedback">
                                                        Please enter price.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="number" class="form-control" id="floatingInput" value="<?php echo $row['stok']; ?>">
                                                    <label for="floatingInput">Stok</label>
                                                    <div class="invalid-feedback">
                                                        Please enter stock.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="input_menu" value="12345">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal View -->

                <?php
                if (empty($result)) {
                    echo "Data user tidak ada";
                } else
                    foreach ($result as $row) {
                ?>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu Makanan & Minuman</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_menu.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control py-3" id="uploadFoto" name="foto" required>
                                                    <label class="input-group-text" for="uploadFoto">Upload Foto Menu</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan File Foto Menu
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="Nama Menu" name="nama_menu" required value="<?php echo $row['nama_menu']; ?>">
                                                    <label for="floatingInput">Nama Menu</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Nama Menu.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="Keterangan" name="keterangan" value="<?php echo $row['keterangan']; ?>">
                                                    <label for="floatingInput">Keterangan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example" name="kat_menu" value="<?php echo $row['kategori_menu']; ?>">
                                                        <option selected hidden value="">Pilih Kategori Menu</option>
                                                        <?php
                                                        foreach ($select_kat_menu as $value) {
                                                            if ($row['kategori'] == $value['id_kat_menu']) {
                                                                echo <<<OPTION
                                                        <option selected value="{$value['id_kat_menu']}">{$value['kategori_menu']}</option>
                                                    OPTION;
                                                            } else {
                                                                echo <<<OPTION
                                                            <option value="{$value['id_kat_menu']}">{$value['kategori_menu']}</option>
                                                        OPTION;
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for=" floatingUsername">Kategori Makanan atau Minuman</label>
                                                    <div class="invalid-feedback">
                                                        Please select food or beverage category.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="Harga" name="harga" required value="<?php echo $row['harga']; ?>">
                                                    <label for="floatingInput">Harga</label>
                                                    <div class="invalid-feedback">
                                                        Please enter price.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="Stok" name="stok" required value="<?php echo $row['stok']; ?>">
                                                    <label for="floatingInput">Stok</label>
                                                    <div class="invalid-feedback">
                                                        Please enter stock.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="input_menu" value="12345">Save changes</button>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses/proses_delete_menu.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="foto" value="<?php echo $row['foto']; ?>"> <!-- Menambahkan input foto -->
                                        <div class="col-lg-12">
                                            Apakah anda ingin menghapus menu <b><?php echo $row['nama_menu'] ?></b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete_menu">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Akhir Modal Delete -->

                <?php { ?>
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr class="text-nowrap">
                                    <th scope="col">No</th>
                                    <th scope="col">Foto Menu</th>
                                    <th scope="col">Nama Menu</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Jenis Menu</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
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
                                        <td>
                                            <div style="width:90px">
                                                <img src="assets/img/<?php echo $row['foto']; ?>" class="img-thumbnail" alt="...">
                                            </div>
                                        </td>
                                        <td><?php echo $row['nama_menu']; ?></td>
                                        <td><?php echo $row['keterangan']; ?></td>
                                        <td><?php echo ($row['jenis_menu'] == 1) ? "Makanan" : "Minuman" ?></td>
                                        <td><?php echo $row['kategori_menu']; ?></td>
                                        <td><?php echo number_format($row['harga'], 2, ',', '.'); ?></td>
                                        <td><?php echo $row['stok']; ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id']; ?>"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id']; ?>"><i class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id']; ?>"><i class="bi bi-trash3"></i></button>

                                            </div>
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

<!-- JS for Preview Image -->
<script>
    function previewImage(event) {
        const output = document.getElementById('preview');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.style.display = 'block'; // Show the image preview
    }
</script>

<!-- Bootstrap Toast JS to display success message -->
<script>
    function showSuccessToast() {
        const toast = new bootstrap.Toast(document.getElementById('successToast'));
        toast.show();
    }

    // Call this function when the form is successfully submitted
    // showSuccessToast();
</script>