 <head>
        <meta charset="utf-8">
        <title>TEKO (Temu Toko)</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="<?php echo base_url('utama/lib/lightbox/css/lightbox.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('utama/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">

        <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->

        <!-- Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <!-- Customized Bootstrap Stylesheet -->
        <link href="<?php echo base_url('utama/css/bootstrap.min.css') ?>" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="<?php echo base_url('utama/css/style.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
<!-- Spinner End -->

        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="https://www.google.com/maps/place/Dinas+Koperasi,+Perindustrian+%26+Perdagangan+Kab.+Berau/@2.1486067,117.494651,16z/data=!4m10!1m2!2m1!1skoperindag!3m6!1s0x320df5003f84036d:0xd897a4ebf9772ec1!8m2!3d2.1486067!4d117.5041782!15sCgprb3BlcmluZGFnkgEYY291bnR5X2dvdmVybm1lbnRfb2ZmaWNl4AEA!16s%2Fg%2F11g6ww65t7?entry=ttu" target="_blank" class="text-white">Jl. DR. Murjani II, Gayam, Kec. Tj. Redeb, Kabupaten Berau, Kalimantan Timur 77315</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">tekotemutoko11@gmail.com</a></small>
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="/" class="navbar-brand"><h1 class="text-primary display-6">TEKO</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="/" class="nav-item nav-link active">Home</a>
                            <a href="<?php echo base_url('Backend/viewMap')  ?>" class="nav-item nav-link">Map</a>
                            <a href="<?php echo base_url('Frontend/moreBerita')  ?>" class="nav-item nav-link">Informasi</a>
                            <a href="<?php echo base_url('Frontend/contact')  ?>" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <?php if (session()->get('logged_in')) { ?>
                                <?php  if (session()->get('status_toko') == '1' || session()->get('status_toko') == '3'){?>
                                <div class="dropdown">
                                    <button class="btn btn-primary me-1 fas fa-user fa-2x" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?= session()->get('nama_toko') ?></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="<?php echo base_url('Backend/manage')  ?>">Kelola Toko</a>
                                        <a class="dropdown-item" href="<?php echo base_url('Backend/editProfil/'.session()->get('user_id'))?>">Pengaturan Akun</a>
                                        <a class="dropdown-item" href="<?php echo base_url('Backend/editLokasi/'.session()->get('user_id'))?>">Ubah Lokasi</a>
                                        <a class="dropdown-item" href="<?php echo base_url('Auth/logout')  ?>">Logout</a>
                                    </div>
                                </div>
                                <?php }else if(session()->get('status_toko') == '2'){ ?>
                                    <div class="dropdown">
                                    <button class="btn btn-primary me-1 fas fa-user fa-2x" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?= session()->get('nama_toko') ?></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="<?php echo base_url('Backend/manage')  ?>">Kelola Toko</a>
                                        <a class="dropdown-item" href="<?php echo base_url('Backend/editProfil/'.session()->get('user_id'))?>">Pengaturan Akun</a>
                                        <a class="dropdown-item" href="<?php echo base_url('Auth/logout')  ?>"></i> Logout</a>
                                    </div>
                                </div>
                                <?php } ?>
                            <?php  }else{?>
                                <a href="<?php echo base_url('/login')?>" class="my-auto">
                                    <i class="fas fa-user fa-2x"></i>
                                 </a>
                            <?php } ?>
                            
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->
