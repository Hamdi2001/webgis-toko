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
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama Toko</th>
                                        <th>Alamat</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Aksi</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor=1; ?>
                                    <?php foreach ($toko as $tk) : ?>
                                    <tr class="text-center">
                                        <td><?= $nomor++; ?></td>
                                        <td><img src="/img/<?= $tk['foto_toko']; ?>" alt="" class="foto_toko"></td>
                                        <td><?= $tk['nama_toko']; ?></td>
                                        <td><?= $tk['alamat_toko']; ?></td>
                                        <td><?= $tk['lat_toko']; ?></td>
                                        <td><?= $tk['lon_toko']; ?></td>
                                        <td>
                                            <div class="btn mb-1">
                                                <a href="" class="btn btn-success" type="button">Ubah</a>
                                                <a href="" class="btn btn-danger" type="button">Hapus</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="buttons">
                                                <a href="" class="btn btn-outline-info">Detail</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>

<?= $this->endSection(); ?>