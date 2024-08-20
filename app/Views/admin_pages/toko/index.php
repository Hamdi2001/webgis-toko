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
                                    <a class="btn btn-primary" href="<?php echo base_url('Pages/addToko')?>" style="width:auto;" data-toggle="buttons"><i class="fas fa-plus"></i> Tambah Toko</a> 
                                </div>
                                <div class="col-md-6 order-md-2 order-first">
                                    <form action="" method="get">
                                        <div class="input-group mb-3">
                                            <?php $request = \Config\Services::request(); ?>
                                            <input type="text" class="form-control" placeholder="Masukkan Keyword..." name="keyword" value="<?= $request->getGet('keyword'); ?>">
                                            <button class="btn btn-outline-secondary" type="sumbit" name="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="order-last">
                                    <?php 
                                        $request = \Config\Services::request();
                                        $keyword = $request->getVar('keyword');
                                        if ($keyword != '') {
                                            $param = "?keyword=".$keyword;
                                        }else{
                                            $param = "";
                                        }
                                    ?>
                                    <a href="<?= site_url('Toko/printexcel'.$param); ?>" class="btn btn-outline-secondary"><i class="fas fa-download"></i> Export Excel</a>
                                    <div class="btn-group">
                                            <div class="dropdown dropdown-color-icon">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButtonEmoji" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <span Class="me-50"><i class="fas fa-upload"></i></span>Import Excel
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonEmoji">
                                                    <a class="dropdown-item" href="<?= base_url('Data-Toko-Contoh-import.xlsx'); ?>"><span
                                                           ><i class="fas fa-file-excel"></i></span>
                                                        Download Contoh</a>
                                                    <a class="dropdown-item" href="" data-bs-toggle="modal"
                                                            data-bs-target="#modal-import-toko"><span
                                                            ><i class="fas fa-file-import"></i></span>
                                                        Upload File </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th>Latitude</th>
                                                    <th>Longitude</th>
                                                    <th>Aksi</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(session()-> getFlashdata('pesan')){ ?>
                                                    <div class="alert alert-success">
                                                        <?php echo session()->getFlashdata('pesan') ?>
                                                    </div>
                                                <?php } ?>
                                                <?php if(session()-> getFlashdata('pesan_error_import')){ ?>
                                                    <div class="alert alert-danger">
                                                        <?php echo session()->getFlashdata('pesan_error_import') ?>
                                                    </div>
                                                <?php } ?>
                                                <?php if(session()-> getFlashdata('pesan_import_berhasil')){ ?>
                                                    <div class="alert alert-success">
                                                        <?php echo session()->getFlashdata('pesan_import_berhasil') ?>
                                                    </div>
                                                <?php } ?>
                                                
                                                <?php 
                                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                                $no = 1 + (5 * ($page - 1));
                                                foreach ($toko as $tk) : ?>
                                                    <tr class="text-center">
                                                        <td><?= $no++; ?></td>
                                                        <td><img src="<?= base_url('img/' . $tk['foto_toko']); ?>" alt="" class="foto_toko"></td>
                                                        <td><a target="_blank" href="<?= base_url('/toko/tampilFoto/nib/'.$tk['foto_nib']); ?>"><?= $tk['nib_toko']; ?></a></td>
                                                        <td><a target="_blank" href="<?= base_url('/toko/tampilFoto/ktp/'.$tk['foto_ktp']); ?>"><?= $tk['ktp_pemilik']; ?></a></td>
                                                        <td><a target="_blank" href="<?= base_url('/toko/tampilFoto/kartu keluarga/'.$tk['foto_kk']); ?>"><?= $tk['kk_pemilik']; ?></a></td>
                                                        <td><?= $tk['nama_toko']; ?></td>
                                                        <td><?= $tk['alamat_toko']; ?></td>
                                                        <td><?= $tk['username_toko']; ?></td>
                                                        <td><?= $tk['password_toko']; ?></td>
                                                        <td><?= $tk['lat_toko']; ?></td>
                                                        <td><?= $tk['lon_toko']; ?></td>
                                                        <td>
                                                            <div class="btn mb-1">
                                                                <a href="/Toko/editToko/<?= $tk['id_toko']; ?>" class="btn btn-primary" type="button"><i class="fas fa-edit"></i></a>
                                                                <!-- //Method spofing -->
                                                                <form action="/toko/<?= $tk['id_toko']; ?>" method="post" class="d-inline">
                                                                    <!-- //Terhindar dari hacking -->
                                                                    <?= csrf_field(); ?> 
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data Secara Permanen?');"><i class="fas fa-trash-alt"></i></button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="buttons">
                                                                <a href="/toko/<?= $tk['id_toko']; ?>" class="btn btn-outline-info"><i class="fas fa-info"></i></a>
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
                            <div class="float-right">
                                <?= $pager->links('default', 'pagination'); ?>
                            </div>
                </div>
            </div>
        </div>
    </section>
</div>
 <div class="modal fade text-left" id="modal-import-toko" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Import Data Toko</h5>
                    <button type="button" class="close rounded-pill"
                    data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="<?= site_url('Toko/import') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label>File Excel</label>
                        <div class="custom-file">
                        <?= csrf_field(); ?>
                            <input type="file" name="file_excel" class="custom-file-input" id="file_excel" required>
                            <label for="file_excel" class="custom-file-label"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Submit</span>
                        </button>
                </form>
                    </div>
            </div>
    </div>
</div>
<?= $this->endSection(); ?>