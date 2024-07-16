<?= $this->extend('admin_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= $title; ?></h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('pages')  ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Verifikasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
         <div class="col-md-6 order-md-2 order-first">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <?php $request = \Config\Services::request(); ?>
                    <input type="text" class="form-control" placeholder="Masukkan Keyword..." name="keyword" value="<?= $request->getGet('keyword'); ?>">
                    <button class="btn btn-outline-secondary" type="sumbit" name="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                        <!-- table striped -->
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                 <tr class="text-center">
                                                <th>No</th>
                                                <th>Gambar</th>
                                                <th>Nomor NIB</th>
                                                <th>Nomor KTP</th>
                                                <th>Nomor KK</th>
                                                <th>Nama Toko</th>
                                                <th>Alamat</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $no = 1 + (5 * ($page - 1));
                                            foreach ($toko as $tk) : ?>
                                            <tr class="text-center">
                                                <td><?= $no++; ?></td>
                                                <td><img src="/img/<?= $tk['foto_toko']; ?>" alt="" class="foto_toko"></td>
                                                <td><a target="_blank" href="<?= base_url('/toko/tampilFoto/nib/'.$tk['foto_nib']); ?>"><?= $tk['nib_toko']; ?></a></td>
                                                <td><a target="_blank" href="<?= base_url('/toko/tampilFoto/ktp/'.$tk['foto_ktp']); ?>"><?= $tk['ktp_pemilik']; ?></a></td>
                                                <td><a target="_blank" href="<?= base_url('/toko/tampilFoto/kartu keluarga/'.$tk['foto_kk']); ?>"><?= $tk['kk_pemilik']; ?></a></td>
                                                <td><?= $tk['nama_toko']; ?></td>
                                                <td><?= $tk['alamat_toko']; ?></td>
                                                <td><?= $tk['lat_toko']; ?></td>
                                                <td><?= $tk['lon_toko']; ?></td>
                                                <td>
                                                    <div class="btn mb-1">
                                                        <form action="<?= base_url(); ?>/toko/saveData/<?= $tk['id_toko']; ?>" method="post" class="d-inline">
                                                            <button type="submit" class="btn btn-success" name="status_toko" value="1"><i class="fas fa-check"></i></button>
                                                        </form>
                                                        
                                                        <form action="/Toko/verifikasiData/<?= $tk['id_toko']; ?>" method="post" class="d-inline">
                                                            <!-- //Terhindar dari hacking -->
                                                            <?= csrf_field(); ?> 
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak Pendaftar?');"><i class="fas fa-times"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <div class="float-left">
                                                <i>Showing <?= 1 + (5 * ($page - 1)); ?> to <?= $no-1 ?> of <?= $pager->getTotal() ?> entries</i>
                                        </div>
                                    </div>
                                </div>
                </div>
            </div>
        </div>
        <div class="float-right">
            <?= $pager->links('default', 'pagination'); ?>
        </div>
    </section>
</div>
 
<?= $this->endSection(); ?>