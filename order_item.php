<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya, tb_order.waktu_order FROM tb_list_order
    LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
    LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
    GROUP BY id_list_order
    HAVING tb_list_order.kode_order = $_GET[order]");

$kode = $_GET['order'];
$meja = $_GET['meja'];
$pelanggan = $_GET['pelanggan'];

$result = [];
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_menu = mysqli_query($conn, "SELECT id, nama_menu FROM tb_daftar_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Order Item
        </div>
        <div class="card-body">
            <a href="order" class="btn btn-info mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="kodeOrder" value="<?php echo $kode; ?>">
                        <label for="kodeOrder">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-floating  mb-3">
                        <input disabled type="text" class="form-control" id="meja" value="<?php echo $meja; ?>">
                        <label for="uploadFoto">Meja</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating  mb-3">
                        <input disabled type="text" class="form-control" id="pelanggan" value="<?php echo $pelanggan; ?>">
                        <label for="uploadFoto">Pelanggan</label>
                    </div>
                </div>

                <!-- Modal Tambah Item Baru -->
                <div class="modal fade" id="tambahItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan & Minuman</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_input_orderitem.php" method="POST">
                                    <input type="hidden" name="kode_order" value="<?php echo htmlspecialchars($kode); ?>">
                                    <input type="hidden" name="meja" value="<?php echo htmlspecialchars($meja); ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo htmlspecialchars($pelanggan); ?>">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="menu" id="menu" required>
                                                    <option selected hidden value="">Pilih Menu</option>
                                                    <?php foreach ($select_menu as $value) : ?>
                                                        <option value="<?php echo htmlspecialchars($value['id']); ?>">
                                                            <?php echo htmlspecialchars($value['nama_menu']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label for="menu">Menu Makanan/Minuman</label>
                                                <div class="invalid-feedback">
                                                    Pilih Menu Makanan/Minuman.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Porsi" required>
                                                <label for="jumlah">Jumlah</label>
                                                <div class="invalid-feedback">
                                                    Masukkan jumlah porsi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" id="catatan" name="catatan" placeholder="Catatan" rows="3"></textarea>
                                                <label for="catatan">Catatan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="input_orderitem" value="1">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Tambah Item Baru -->


                <?php
                if (empty($result)) {
                    echo "";
                } else
                    foreach ($result as $row) {
                ?>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu Makanan & Minuman</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_orderitem.php" method="POST">
                                        <!-- Hidden Inputs -->
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_list_order']); ?>">
                                        <input type="hidden" name="kode_order" value="<?php echo htmlspecialchars($kode); ?>">
                                        <input type="hidden" name="meja" value="<?php echo htmlspecialchars($meja); ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo htmlspecialchars($pelanggan); ?>">

                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="menu" id="menu" required>
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
                                                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Porsi" required value="<?php echo htmlspecialchars($row['jumlah']); ?>">
                                                    <label for="jumlah">Jumlah</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan jumlah porsi.
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
                                            <button type="submit" class="btn btn-primary" name="edit_orderitem" value="1">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Akhir Modal Edit -->

                    <!-- Modal Delete -->
                    <?php foreach ($result as $row): ?>
                        <div class="modal fade" id="ModalDelete<?php echo $row['id_list_order']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-fullscreen-md-down">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Order</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="delete-form" action="proses/proses_delete_orderitem.php" method="POST">
                                            <!-- Hidden Inputs -->
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id_list_order']); ?>">
                                            <input type="hidden" name="kode_order" value="<?php echo htmlspecialchars($kode); ?>">
                                            <input type="hidden" name="meja" value="<?php echo htmlspecialchars($meja); ?>">
                                            <input type="hidden" name="pelanggan" value="<?php echo htmlspecialchars($pelanggan); ?>">

                                            <!-- Confirm Delete -->
                                            <p>Apakah Anda ingin menghapus menu <b><?php echo htmlspecialchars($row['nama_menu']); ?></b>?</p>

                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger delete-btn" name="delete_orderitem">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- Akhir Modal Delete -->

                <?php
                    }
                ?>

                <!-- Modal Bayar -->
                <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Table bayar -->
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th scope="col">Menu</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Catatan</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            foreach ($result as $row) {
                                                $subtotal = $row['harga'] * $row['jumlah'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['nama_menu']; ?></td>
                                                    <td><?php echo number_format($row['harga'], 2, ',', '.'); ?></td>
                                                    <td><?php echo $row['jumlah']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['status'] == 1) {
                                                            echo "<span class='badge text-bg-warning'>In Proses</span>";
                                                        } elseif ($row['status'] == 2) {
                                                            echo "<span class='badge text-bg-primary'>Completed</span>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['catatan']; ?></td>
                                                    <td><?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            <?php
                                                $total += $subtotal;
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="5" class="fw-bold">Total harga =</td>
                                                <td class="fw-bold">
                                                    <?php echo number_format($total, 2, ',', '.'); ?>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Akhir Table Modal Bayar -->
                                <span class="text-danger fs-7 fw-semibold">Apakah Anda Yakin Ingin Melakukan Pembayaran ?</span>
                                <form class="needs-validation" novalidate action="proses/proses_bayar.php" method="POST">
                                    <input type="hidden" name="kode_order" value="<?php echo htmlspecialchars($kode); ?>">
                                    <input type="hidden" name="meja" value="<?php echo htmlspecialchars($meja); ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo htmlspecialchars($pelanggan); ?>">
                                    <input type="hidden" name="total" value="<?php echo htmlspecialchars($total); ?>">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="uang" name="uang" placeholder="Nominal Uang" required>
                                                <label for="jumlah">Nominal Uang</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nominal Uang.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="bayar" value="1"> Bayar </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Bayar -->

                <?php {
                ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-nowrap">
                                    <th scope="col">Menu</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Catatan</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($result as $row) {
                                    $subtotal = $row['harga'] * $row['jumlah'];
                                ?>
                                    <tr>
                                        <td><?php echo $row['nama_menu']; ?></td>
                                        <td><?php echo number_format($row['harga'], 2, ',', '.'); ?></td>
                                        <td><?php echo $row['jumlah']; ?></td>
                                        <td><?php echo (!empty($row['id_bayar'])) ?
                                                "<span class='badge text-bg-success'>Completed</span>" : "<span class='badge text-bg-warning'>In Progress</span>";
                                            ?>
                                        </td>
                                        <td><?php echo $row['catatan']; ?></td>
                                        <td><?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-warning btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_list_order']; ?>"><i class="bi bi-pencil-square"></i></button>
                                                <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-danger btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_list_order']; ?>"><i class="bi bi-trash3"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    $total += $subtotal;
                                }
                                ?>
                                <tr>
                                    <td colspan="5" class="fw-bold">Total harga =</td>
                                    <td class="fw-bold">
                                        <?php echo number_format($total, 2, ',', '.'); ?>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
                <div>
                    <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-success"; ?>" data-bs-toggle="modal" data-bs-target="#tambahItem"><i class="bi bi-plus-circle-fill"></i> Item</button>
                    <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-primary"; ?>" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-cash-coin"></i> Bayar</button>
                    <button onclick="printStruk()" class="btn btn-info"><i class="bi bi-printer"></i> Cetak Struk</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Struk Pembayaran -->
<div id="strukContent" style="display: none;">
    <h2 style="text-align: center; color: #333; font-family: Arial, sans-serif;">Struk Pembayaran DeCafe</h2>
    <p style="font-size: 14px; margin: 5px 0; color: #555; font-family: Arial, sans-serif;">Kode Order: <?php echo htmlspecialchars($kode); ?></p>
    <p style="font-size: 14px; margin: 5px 0; color: #555; font-family: Arial, sans-serif;">Meja: <?php echo htmlspecialchars($meja); ?></p>
    <p style="font-size: 14px; margin: 5px 0; color: #555; font-family: Arial, sans-serif;">Pelanggan: <?php echo htmlspecialchars($pelanggan); ?></p>
    <p style="font-size: 14px; margin: 5px 0; color: #555; font-family: Arial, sans-serif;">Waktu Order: <?php echo date('d/m/Y H:i:s', strtotime($result[0]['waktu_order'])); ?></p>
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px; font-family: Arial, sans-serif; border: 1px solid #ddd;">
        <thead>
            <tr style="background: #007BFF; color: white; font-size: 14px;">
                <th style="padding: 10px; text-align: left;">Menu</th>
                <th style="padding: 10px; text-align: center;">Harga</th>
                <th style="padding: 10px; text-align: center;">Qty</th>
                <th style="padding: 10px; text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            $loop_index = 0;
            foreach ($result as $row) {
                $row_class = $loop_index++ % 2 == 0 ? 'background: #f9f9f9;' : 'background: #fff;';
            ?>
                <tr style="<?php echo $row_class; ?> font-size: 14px;">
                    <td style="padding: 10px; text-align: left;"><?php echo htmlspecialchars($row['nama_menu']); ?></td>
                    <td style="padding: 10px; text-align: center;"><?php echo number_format($row['harga'], 2, ',', '.'); ?></td>
                    <td style="padding: 10px; text-align: center;"><?php echo htmlspecialchars($row['jumlah']); ?></td>
                    <td style="padding: 10px; text-align: right;"><?php echo number_format($row['harganya'], 2, ',', '.'); ?></td>
                </tr>
            <?php
                $total += $row['harganya'];
            } ?>
            <tr style="font-weight: bold; font-size: 14px;">
                <td colspan="3" style="padding: 10px; text-align: left;">Total Harga</td>
                <td style="padding: 10px; text-align: right;"><?php echo number_format($total, 2, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Script untuk mencetak -->
<script>
    function printStruk() {
        var strukContent = document.getElementById("strukContent").innerHTML;
        var printWindow = window.open('', '_blank', 'width=800,height=600');
        printWindow.document.open();
        printWindow.document.write(`
            <html>
            <head>
                <title>Struk Pembayaran</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                    }
                    h2 { text-align: center; margin-bottom: 20px; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { border: 1px solid #ddd; padding: 10px; text-align: center; font-size: 14px; }
                    th { background: #007BFF; color: white; }
                    td:first-child { text-align: left; }
                    td:last-child { text-align: right; }
                    tr:nth-child(even) { background: #f9f9f9; }
                </style>
            </head>
            <body>
                ${strukContent}
                <script>
                    setTimeout(function() {
                        window.print();
                    }, 500);
                <\/script>
            </body>
            </html>
        `);
        printWindow.document.close();
    }
</script>