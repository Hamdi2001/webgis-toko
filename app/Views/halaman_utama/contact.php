<?= $this->extend('halaman_utama/layout/template'); ?>

<?= $this->section('content'); ?>
  <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Contact</h1>
        </div>
    <!-- Single Page Header End -->

 <!-- Contact Start -->
        <div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="p-5 bg-light rounded">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary">Lokasi Kantor Dinas Koperasi, Perindustrian & Perdagangan Kab. Berau</h1>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="h-100 rounded">
                                <iframe class="rounded w-100" 
                                style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15948.060128490197!2d117.49392142825984!3d2.1479312562291293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x320df5003f84036d%3A0xd897a4ebf9772ec1!2sDinas%20Koperasi%2C%20Perindustrian%20%26%20Perdagangan%20Kab.%20Berau!5e0!3m2!1sid!2sid!4v1707194596342!5m2!1sid!2sid" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Alamat</h4>
                                    <p class="mb-2">Jl. DR. Murjani II, Gayam, Kec. Tj. Redeb, Kabupaten Berau, Kalimantan Timur</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded mb-4 bg-white">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Email</h4>
                                    <p class="mb-2">tekotemutoko11@gmail.com</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 rounded bg-white">
                                <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Nomor Telepon</h4>
                                    <p class="mb-2">(+62)11 2233 4455</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Contact End -->
<?= $this->endSection(); ?>