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
                                     <a class="btn btn-primary" href="<?php echo base_url('Pages/tampilanaddAdmin')?>" style="width:auto;" data-toggle="buttons"><i class="fas fa-plus"></i> Tambah Admin</a>
                                </div>
                                <div class="col-md-6 order-md-2 order-first">
                                    <form action="" method="post">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Masukkan Keyword..." name="keyword">
                                            <button class="btn btn-outline-secondary" type="sumbit" name="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php if(session()-> getFlashdata('pesan_edit')){ ?>
                            <div class="alert alert-success">
                                <?php echo session()->getFlashdata('pesan_edit') ?><br/>
                            </div>
                        <?php } ?>
                        <?php if(session()-> getFlashdata('pesan_tambah')){ ?>
                            <div class="alert alert-success">
                                <?php echo session()->getFlashdata('pesan_tambah') ?><br/>
                            </div>
                        <?php } ?>
                        <?php if(session()-> getFlashdata('pesan_hapus')){ ?>
                            <div class="alert alert-danger">
                                <?php echo session()->getFlashdata('pesan_hapus') ?><br/>
                            </div>
                        <?php } ?> 
                        <!-- table striped -->
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Nama Admin</th>
                                                    <th>Username Admin</th>
                                                    <th>Password Admin</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $nomor=1 + (5 * ($currentPage - 1)); ?>
                                                <?php foreach ($admin as $adm) : ?>
                                                <tr class="text-center">
                                                    <td><?= $nomor++; ?></td>
                                                    <td><?= $adm['nama_admin']; ?></td>
                                                    <td><?= $adm['username_admin']; ?></td>
                                                    <td><?= $adm['password_admin']; ?></td>
                                                    <td>
                                                        <div class="btn mb-1">
                                                            <a href="/Pages/editAdmin/<?= $adm['id']; ?>" class="btn btn-primary" type="button"><i class="fas fa-edit"></i></a>
                                                            <!-- //Method spofing -->
                                                            <form action="/Pages/dataAdmin/<?= $adm['id']; ?>" method="post" class="d-inline">
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
                                <div class="mt-3">
                                    <?= $pager->links('admin', 'toko_pagination'); ?>
                                </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>