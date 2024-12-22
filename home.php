<?php
include "proses/connect.php";

// Mengambil semua data menu untuk tampilan carousel
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu");
while ($row = mysqli_fetch_array($query)) {
    $result[] = $row;
}

$query_rekomendasi = mysqli_query($conn, "
    SELECT tb_daftar_menu.nama_menu, tb_daftar_menu.foto, tb_daftar_menu.keterangan, SUM(tb_list_order.jumlah) AS total_terjual
    FROM tb_list_order
    JOIN tb_daftar_menu ON tb_list_order.menu = tb_daftar_menu.id
    GROUP BY tb_list_order.menu
    ORDER BY total_terjual DESC
    LIMIT 6
");


$query_chart = mysqli_query($conn, "SELECT nama_menu, tb_daftar_menu.id, SUM(tb_list_order.jumlah) AS total_jumlah
FROM tb_daftar_menu
LEFT JOIN tb_list_order ON tb_daftar_menu.id = tb_list_order.menu
GROUP BY tb_daftar_menu.id
ORDER BY tb_daftar_menu.id ASC");

while ($record_chart = mysqli_fetch_array($query_chart)) {
    $result_chart[] = $record_chart;
}

$array_menu = array_column($result_chart, 'nama_menu');
$array_menu_qoute = array_map(function ($menu) {
    return "'" . $menu . "'";
}, $array_menu);
$string_menu = implode(',', $array_menu_qoute);

$array_jumlah_pesanan = array_column($result_chart, 'total_jumlah');
$string_jumlah_pesanan = implode(',', $array_jumlah_pesanan);
?>

<link rel="stylesheet" href="../assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="col-lg-9 mt-2">
    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $slide = 0;
            $firstSlideButton = true;
            foreach ($result as $dataTombol) {
                ($firstSlideButton) ? $aktif = "active" : $aktif = "";
                $firstSlideButton = false;
            ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $slide ?>" class="<?php echo $aktif ?>" aria-current="true" aria-label="Slide <?php echo $slide + 1 ?>"></button>
            <?php
                $slide++;
            } ?>
        </div>
        <div class="carousel-inner rounded">
            <?php
            $firstSlide = true;
            foreach ($result as $data) {
                ($firstSlide) ? $aktif = "active" : $aktif = "";
                $firstSlide = false;
            ?>
                <div class="carousel-item <?php echo $aktif ?>">
                    <img src="assets/img/<?php echo $data['foto'] ?>" class="img-fluid" style="height:250px; width:1000px; object-fit:cover" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $data['nama_menu'] ?></h5>
                        <p><?php echo $data['keterangan'] ?></p>
                    </div>
                </div>
            <?php
            } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- End Carousel -->

    <!-- Rekomendasi Menu Populer -->
    <div id="menu-rekomendasi" class="rekomendasi mt-4">
        <h5 class="fw-bold">Menu Populer</h5>
        <div class="row">
            <?php while ($menu = mysqli_fetch_array($query_rekomendasi)) { ?>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0" style="transition: transform 0.2s;">
                        <img src="assets/img/<?php echo $menu['foto']; ?>" class="card-img-top rounded-top" alt="<?php echo $menu['nama_menu']; ?>">
                        <div class="card-body text-center">
                            <h6 class="card-title fw-bold"><?php echo $menu['nama_menu']; ?></h6>
                            <p class="card-text text-muted small"><?php echo $menu['keterangan']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- End Rekomendasi Menu Populer -->

    <!-- Judul -->
    <div class="card mt-4 border-0 bg-light">
        <div class="card-body text-center">
            <h5 class="card-title">DECAFE - APLIKASI PEMESANAN MAKANAN DAN MINUMAN</h5>
            <p class="card-text">Aplikasi pemesanan makanan dan minuman yang mudah dan praktis. Nikmati beragam menu makanan dan minuman favorit Anda dengan beberapa klik. Pesan, bayar dan lacak pesanan Anda dengan mudah melalui aplikasi ini.</p>
            <a href="order" class="btn btn-primary">Buat Order</a>
        </div>
    </div>
    <!-- End Judul -->

    <!-- Chart -->
    <div id="chart-menu" class="card mt-4 border-0 bg-light">
        <div class="card-body text-center">
            <div>
                <canvas id="myChart"></canvas>
            </div>
            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php echo $string_menu ?>],
                        datasets: [{
                            label: 'Jumlah Prosi Terjual',
                            data: [<?php echo $string_jumlah_pesanan ?>],
                            borderWidth: 1,
                            backgroundColor: [
                                'rgba(251, 41, 54, 0.8)',
                                'rgba(53, 69, 244, 0.8)',
                                'rgba(241, 241, 59, 0.8)',
                                'rgba(59, 241, 75, 0.8)',
                                'rgba(200, 59, 241, 0.8)',
                                'rgba(241, 184, 59, 0.8)'
                            ]
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
    <!-- End Chart -->
     
    <!-- Footer -->
    <footer class="footer bg-dark">
        <div class="footer-info">
            <div>
                <iframe
                    class="map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.973251948773!2d110.3658454!3d-7.7926566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5825fa6106c5%3A0x3ea4c521a5ed1133!2sJl.%20Malioboro%2C%20Sosromenduran%2C%20Gedong%20Tengen%2C%20Kota%20Yogyakarta%2C%20Daerah%20Istimewa%20Yogyakarta!5e0!3m2!1sen!2sid!4v1703131336185!5m2!1sen!2sid"
                    width="600"
                    height="450"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="footer-container">
            <div class="footer-logo">
                <a href="#" class="logo">
                    <i class="bi bi-cup-hot"></i> DeCafe
                </a>
                <p>
                    Aplikasi pemesanan makanan dan minuman yang mudah dan praktis. Nikmati pengalaman terbaik hanya di DeCafe!
                </p>
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="#carouselExampleCaptions">Tentang Menu</a></li>
                    <li><a href="#menu-rekomendasi">Menu Populer</a></li>
                    <li><a href="#chart-menu">Chart Menu</a></li>
                </ul>
            </div>
            <div class="footer-social">
                <li class=""><a href="#contact">Kontak : </a></li>
                <ul>
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
        <p class="footer-text" style="max-width: 500px; margin: auto; color: #bbb">
            &copy; <span id="footer-tahun"></span> DeCafe - Tugas Besar Pemrograman Web
        </p>
    </footer>
</div>