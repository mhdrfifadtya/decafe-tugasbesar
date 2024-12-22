<div class="col-lg-3">
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded border mt-2">
        <div class="container-fluid">
            <button class="navbar-toggler me-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start sticky-sidebar" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width:250px">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><i class="bi bi-cup-hot"></i> DeCafe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo ((isset($_GET['x']) && $_GET['x']=='home') || !isset($_GET['x'])) ? 'active bg-primary text-white' : 'link-dark'; ?>" aria-current="page" href="home">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        <!-- Daftar Menu -->
                        <?php if($hasil['level'] == 1 || $hasil['level'] == 3) { ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='daftarmenu') ? 'active bg-primary text-white' : 'link-dark'; ?>" href="daftarmenu">
                                <i class="bi bi-book"></i> Daftar Menu
                            </a>
                        </li>
                        <?php } ?>
                        <!-- Kategori Menu -->
                        <?php if($hasil['level'] == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='katmenu') ? 'active bg-primary text-white' : 'link-dark'; ?>" href="katmenu">
                                <i class="bi bi-tags"></i> Kategori Menu
                            </a>
                        </li>
                        <?php } ?>
                        <!-- Order -->
                        <?php if($hasil['level'] == 1 || $hasil['level'] == 2 || $hasil['level'] == 3) { ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='order') ? 'active bg-primary text-white' : 'link-dark'; ?>" href="order">
                                <i class="bi bi-cart4"></i> Order
                            </a>
                        </li>
                        <?php } ?>
                        <!-- Dapur -->
                        <?php if($hasil['level'] == 1 || $hasil['level'] == 4) { ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='dapur') ? 'active bg-primary text-white' : 'link-dark'; ?>" href="dapur">
                                <i class="bi bi-egg-fried"></i> Dapur
                            </a>
                        </li>
                        <?php } ?>
                        <!-- User -->
                        <?php if($hasil['level'] == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='user') ? 'active bg-primary text-white' : 'link-dark'; ?>" href="user">
                                <i class="bi bi-person-heart"></i> User
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='report') ? 'active bg-primary text-white' : 'link-dark'; ?>" href="report">
                                <i class="bi bi-file-earmark-bar-graph"></i> Report
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
