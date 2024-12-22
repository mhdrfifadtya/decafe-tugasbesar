<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT * FROM tb_list_order
    LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
    LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
    ORDER BY waktu_order ASC");

$result = [];
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_menu = mysqli_query($conn, "SELECT id, nama_menu FROM tb_daftar_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Dapur
        </div>
        <div class="card-body">

            <?php
            if (empty($result)) {
                echo "";
            } else
                foreach ($result as $row) {
            ?>
                <!-- Modal Terima Dapur -->
                <div class="modal fade" id="terima<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Penerimaan pesanan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_terima_orderitem.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_list_order']); ?>">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <select disabled class="form-select" name="menu" id="menu" required>
                                                    <option selected hidden value="">Pilih Menu</option>
                                                    <?php
                                                    foreach ($select_menu as $value) {
                                                        $selected = $row['menu'] == $value['id'] ? "selected" : "";
                                                        echo "<option value=\"{$value['id']}\" $selected>{$value['nama_menu']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <label for="menu">Menu Makanan/Minuman</label>
                                                <div class="invalid-feedback">
                                                    Pilih Menu Makanan/Minuman.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input disabled type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Porsi" required value="<?php echo htmlspecialchars($row['jumlah']); ?>">
                                                <label for="jumlah">Jumlah</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Jumlah porsi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan" value="<?php echo htmlspecialchars($row['catatan']); ?>">
                                                <label for="catatan">Catatan</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="terima_orderitem" value="1">Terima pesanan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Terima Dapur -->

                <!-- Modal Pesanan Selesai Dapur -->
                <div class="modal fade" id="selesai<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pesanan Selesai</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_selesai_orderitem.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_list_order']); ?>">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <select disabled class="form-select" name="menu" id="menu" required>
                                                    <option selected hidden value="">Pilih Menu</option>
                                                    <?php
                                                    foreach ($select_menu as $value) {
                                                        $selected = $row['menu'] == $value['id'] ? "selected" : "";
                                                        echo "<option value=\"{$value['id']}\" $selected>{$value['nama_menu']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <label for="menu">Menu Makanan/Minuman</label>
                                                <div class="invalid-feedback">
                                                    Pilih Menu Makanan/Minuman.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input disabled type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Porsi" required value="<?php echo htmlspecialchars($row['jumlah']); ?>">
                                                <label for="jumlah">Jumlah</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Jumlah porsi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan" value="<?php echo htmlspecialchars($row['catatan']); ?>">
                                                <label for="catatan">Catatan</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="selesai_orderitem" value="1">Pesanan Selesai</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Pesanan Selesai Dapur -->

            <?php
                }
            ?>

            <div class="table-responsive">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Kode Order</th>
                            <th scope="col">Waktu Order</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        foreach ($result as $row) {
                            if ($row['status'] != 2) {
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $no++ ?>
                                    </td>
                                    <td>
                                        <?php echo $row['kode_order']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['waktu_order']; ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?php echo $row['nama_menu']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['jumlah']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['catatan']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 0) {
                                            echo "<span class='badge text-bg-danger'>Waiting</span>";
                                        } elseif ($row['status'] == 1) {
                                            echo "<span class='badge text-bg-warning'>In Proses</span>";
                                        } elseif ($row['status'] == 2) {
                                            echo "<span class='badge text-bg-primary'>Completed</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="<?php echo (!empty($row['status'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-primary btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#terima<?php echo $row['id_list_order']; ?>">Terima</button>

                                            <button class="<?php echo (empty($row['status']) || $row['status'] != 1) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-success btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#selesai<?php echo $row['id_list_order']; ?>">Selesai</button>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>