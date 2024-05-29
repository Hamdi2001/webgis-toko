<?= $this->extend('halaman_utama/layout/template'); ?>

<?= $this->section('content'); ?>
        <!-- Hero Start -->
        <div class="container-fluid py-5 mb-5 hero-header"><!-- Gambar Background -->
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary">Sebuah Webgis</h4>
                        <h1 class="mb-5 display-3 text-primary">Menampilkan Lokasi Berbagai UMKM</h1>
                    </div>
                    
                   <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <?php $first = true; ?>
                                <?php foreach ($banner as $br) : ?>
                                    <div class="carousel-item <?= $first ? 'active' : ''; ?> rounded">
                                        <img src="<?= base_url('banner/' . $br['gambar_banner']); ?>" class="img-fluid w-100 h-100 bg-secondary rounded">
                                        <a class="btn px-4 py-2 text-white rounded"><?= $br['deskripsi_banner']; ?></a>
                                    </div>
                                    <?php $first = false; ?>
                                <?php endforeach; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Hero End -->
        

        <!-- Featurs Section Start -->
        <div class="container-fluid featurs py-5">
            <div class="container py-5">
                <div class="col-lg-4 text-start">
                    <h1>Motto Kami</h1>
                </div> 
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-bolt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Cepat</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-paperclip fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Mudah</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-exchange-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Transparan</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fa fa-handshake fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Santun</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs Section End -->
        
        <!-- Berita Start-->
        <div class="container-fluid item py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="col-lg-4 text-start">
                            <h1>Berita Terkini</h1>
                        </div> 
                    </div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <?php foreach ($berita as $ber) :  ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative item-item">
                                                <div class="item-img">
                                                    <img src="/gambar berita/<?= $ber['gambar_berita']; ?>" class="img-fluid w-100 rounded-top" style="height:200px;">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= $ber['created_at']; ?></div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4><?= $ber['judul_berita']; ?></h4>
                                                    <?= $limited_word = word_limiter($ber['isi_berita'],20);?>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <a href="/berita/<?= $ber['slug_berita']; ?>" class="mb-5 btn border border-secondary rounded-pill px-3 text-primary">Selengkapnya <i class="fa fa-arrow-right me-2 text-primary text-center"></i></a>
                                                        <p class="fs-5 fw-bold mb-0">Posted By <?= $ber['nama_penulis']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
        <!-- Berita Start End-->
        
<?= $this->endSection(); ?>