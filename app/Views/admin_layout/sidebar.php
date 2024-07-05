<div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="/Pages"><h1>TEKO</h1></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item  ">
                            <a href="/Pages" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Data Utama</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="<?php echo base_url('Toko/viewMap')  ?>"><i class="fas fa-map"></i> Data View Map</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="/toko"><i class="fas fa-store"></i> Data Toko</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?php echo base_url('Toko/verifikasiData')  ?>"> <i class="fas fa-store-slash"></i> Verifikasi Data Toko</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="<?php echo base_url('Toko/verifikasiDataUpdate')  ?>"><i class="iconly-boldShow"></i> Verifikasi Data Perubahan Lokasi Toko</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="sidebar-item ">
                            <a href="<?php echo base_url('Pages/dataBerita')?>" class='sidebar-link'>
                                <i class="bi bi-newspaper"></i>
                                <span>Berita</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="<?php echo base_url('Pages/dataPenulis')?>" class='sidebar-link'>
                                <i class="fas fa-user-alt"></i>
                                <span>Penulis</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Raise Support</li>
                        <li class="sidebar-item  ">
                            <a href="<?php echo base_url('Pages/dataBanner')?>" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Pengaturan Banner</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>