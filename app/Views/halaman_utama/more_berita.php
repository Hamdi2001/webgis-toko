<?= $this->extend('halaman_utama/layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Informasi</h1>
        </div>
<!-- Single Page Header End -->

<!-- Berita Start-->
        <div class="container-fluid item py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
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
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= $ber['waktu_berita']; ?></div>
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
        <?= $pager->links('berita', 'toko_pagination'); ?>
        <!-- Berita Start End-->

<?= $this->endSection(); ?>