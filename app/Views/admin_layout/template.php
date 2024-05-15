<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('asset/dist/assets/css/bootstrap.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('asset/dist/assets/vendors/iconly/bold.css') ?>">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('asset/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/dist/assets/css/app.css') ?>">
    <link rel="shortcut icon" href="<?php echo base_url('asset/dist/assets/images/favicon.svg" type="image/x-icon') ?>">

    <!-- Untuk Peta Leafleat -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Untuk Chart dengan ChartJs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>   
    <div id="app">
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                    <?= $this->include('admin_layout/header'); ?>
                </a>
            </header>
            <?= $this->include('admin_layout/sidebar'); ?>

            <?= $this->renderSection('content'); ?>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p><?= $year = date("Y"); ?> &copy; Teko</p> 
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span>TEKO</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?php echo base_url('asset/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/dist/assets/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?php echo base_url('asset/dist/assets/vendors/apexcharts/apexcharts.js') ?>"></script>
    <script src="<?php echo base_url('asset/dist/assets/js/pages/dashboard.js') ?>"></script>
    <script src="<?php echo base_url('asset/dist/assets/js/main.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>