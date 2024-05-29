<?= $this->extend('halaman_utama/layout/template'); ?>

<?= $this->section('content'); ?>
  <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Detail berita</h1>
        </div>
    <!-- Single Page Header End -->

<!-- Start -->
    <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row g-4">
                            <div class="col-lg-9">
                                <div class="border rounded">
                                    <img src="<?php echo base_url('gambar berita/' . $berita['gambar_berita']); ?>" class="img-fluid rounded"style="width:313.6px, height:500px;">
                                </div>
                            </div>
                            <div class="col-lg-11">
                                <h4 class="fw-bold mb-4"><?php echo $berita['judul_berita']; ?></h4>
                                <p class=" me-5 d-inline">Penulis By <?php echo $berita['nama_penulis']; ?></p>
                                <p class=" me-5 d-inline"><?php echo $berita['created_at']; ?></p>
                                <p class=" me-5 d-inline"></p>
                            </div>
                            <div class="col-lg-11">
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        <p><?php echo $berita['isi_berita']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-3">
                        <div class="row g-4 fruite">
                            <div class="col-lg-12">
                                <h4 class="mb-4">Berita Terbaru</h4>
                                <?php foreach ($terbaru as $ter) :  ?>
                                <a href="/berita/<?= $ter['slug_berita']; ?>">
                                <div class="d-flex align-items-center justify-content-start mb-5">
                                    <div class="rounded">
                                        <img style="width: 70px; height: 50px;" src="<?php echo base_url('gambar berita/' . $ter['gambar_berita']); ?>" class="img-fluid rounded">
                                    </div>
                                    <div>
                                        <h6 class="ms-3"><?php echo $ter['judul_berita']; ?></h6>
                                    </div>
                                </div>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
        </div>      
<!-- End -->
<?= $this->endSection(); ?>