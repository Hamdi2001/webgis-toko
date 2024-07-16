<?= $this->extend('admin_layout/template'); ?>

<?= $this->section('content'); ?>

<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3 class="mb-3">Webgis Toko Kelontong</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/Pages">Dashboard</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <?php if(session()-> getFlashdata('pesan_edit')){ ?>
                    <div class="alert alert-success">
                        <?php echo session()->getFlashdata('pesan_edit') ?>
                    </div>
                <?php } ?>
                <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="fas fa-store"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Jumlah Toko</h6>
                                                <h6 class="font-extrabold mb-0"><?= $toko; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="fas fa-store-slash"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Toko Butuh Verifikasi</h6>
                                                <h6 class="font-extrabold mb-0"><?= $toko_verif; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Toko Perubahan Lokasi</h6>
                                                <h6 class="font-extrabold mb-0"><?= $toko_update; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="fas fa-newspaper"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Berita</h6>
                                                <h6 class="font-extrabold mb-0"><?= $berita; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="fas fa-shopping-bag"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Produk</h6>
                                                <h6 class="font-extrabold mb-0"><?= $produk; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="fas fa-user-alt"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Penulis</h6>
                                                <h6 class="font-extrabold mb-0"><?= $penulis; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="row align-items-center">
                            <div class="col-6 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="text-center">Jumlah Toko Tiap Kecamatan</h4>
                                    </div>
                                    <div class="card-body">
                                       <canvas id="daerah"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="text-center">Toko Per Tahun</h4>
                                    </div>
                                    <div class="card-body">
                                       <canvas id="per_tahun"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
</div>

<script>
    //pie chart
    var daerah_toko = document.getElementById('daerah');
    var data_daerah_toko = [];
    var label_daerah_toko = [];

    <?php foreach($daerah->getResult() as $key=>$value): ?>
        data_daerah_toko.push('<?= $value->jumlah ?>');
        label_daerah_toko.push('<?= $value->kec ?>');
    <?php endforeach ?>

    var data_daerah_per_toko = {
        datasets:[{
            data : data_daerah_toko,
            backgroundColor:[
                'rgba(255, 0, 0, 0.8)',
                'rgba(0, 0, 255, 0.8)',
                'rgba(60, 179, 113, 0.8)',
                'rgba(255, 165, 0, 0.8)',
                'rgba(255, 99, 71, 0.8)',
                'rgba(213, 42, 6, 0.8)',
                'rgba(181, 17, 228, 0.8)',
                'rgba(33, 237, 188, 0.8)',
                'rgba(8, 107, 0, 0.8)',
                'rgba(110, 13, 53, 0.8)',
                'rgba(10, 240, 228, 0.8)',
                'rgba(75, 14, 194, 0.8)',
                'rgba(255, 173, 1, 0.8)',
            ],
            borderWidth: 0.5
        }],
        labels : label_daerah_toko, 
    }

    var chart_daerah_toko = new Chart(daerah,{
        type: 'pie',
        data : data_daerah_per_toko
    });

    //Bar Grafik
    var per_tahun = document.getElementById('per_tahun');
    var data_tahun_toko = [];
    var label_tahun_toko = [];

    <?php foreach($tahun as $value): ?>
        data_tahun_toko.push('<?= $value['jumlah'] ?>');
        label_tahun_toko.push('<?= $value['tahun'] ?>');
    <?php endforeach ?>

    var data_tahun_per_toko = {
        datasets:[{
            label: 'Jumlah Toko',
            data : data_tahun_toko,
            backgroundColor: 'rgba(255, 99, 132, 0.8)',
        }],
        labels : label_tahun_toko, 
    }

    var chart_tahun_toko = new Chart(per_tahun,{
        type: 'bar',
        data : data_tahun_per_toko
    });

</script>
<?= $this->endSection(); ?>