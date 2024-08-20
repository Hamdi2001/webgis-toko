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
                        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 order-md-1 order-last">
                                    <?php if ($totalbanner < 3): ?>
                                        <a class="btn btn-primary" href="<?php echo base_url('Pages/addBanner')?>" style="width:auto;" data-toggle="buttons"><i class="fas fa-plus"></i> Tambah Banner</a> 
                                    <?php endif; ?>
                                </div>
                            </div>
                            <br/>
                        </div>
                        <!-- table striped -->
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Gambar</th>
                                                    <th>Deskripsi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(session()-> getFlashdata('pesan_berhasil')){ ?>
                                                    <div class="alert alert-success">
                                                        <?php echo session()->getFlashdata('pesan_berhasil') ?>
                                                    </div>
                                                <?php } ?>
                                                <?php if(session()-> getFlashdata('pesan_edit')){ ?>
                                                    <div class="alert alert-success">
                                                        <?php echo session()->getFlashdata('pesan_edit') ?>
                                                    </div>
                                                <?php } ?>
                                                <?php if(session()-> getFlashdata('pesan_hapus')){ ?>
                                                    <div class="alert alert-success">
                                                        <?php echo session()->getFlashdata('pesan_hapus') ?>
                                                    </div>
                                                <?php } ?>                      
                                                <?php $nomor=1; ?>
                                                <?php foreach ($banner as $br) : ?>
                                                <tr class="text-center">
                                                    <td><?= $nomor++; ?></td>
                                                    <td><img src="<?= base_url('banner/'.$br['gambar_banner']); ?>" class="foto_toko"></td>
                                                    <td><?= $br['deskripsi_banner']; ?></td>
                                                    <td>
                                                        <div class="btn mb-1">
                                                            <a href="/Pages/editBanner/<?= $br['id_banner']; ?>" class="btn btn-primary" type="button"><i class="fas fa-edit"></i></a>
                                                            <!-- //Method spofing -->
                                                            <form action="/Pages/dataBanner/<?= $br['id_banner']; ?>" method="post" class="d-inline">
                                                                <!-- //Terhindar dari hacking -->
                                                                <?= csrf_field(); ?> 
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data Secara Permanen?');"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>