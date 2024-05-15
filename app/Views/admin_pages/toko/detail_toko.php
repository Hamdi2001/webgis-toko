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
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('/toko')  ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <?php if(session()-> getFlashdata('pesan_edit')){ ?>
                    <div class="alert alert-success">
                        <?php echo session()->getFlashdata('pesan_edit') ?><br/>
                    </div>
                <?php } ?>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama produk</th>
                                        <th>Harga Produk</th>
                                        <th>Stok Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produk as $key => $pr) : ?>
                                    <tr class="text-center">
                                        <td><?= $startNumber + $key ?></td>
                                        <td><img src="<?= base_url('produk foto/' . $pr->foto_produk); ?>" class="foto_produk" style="width: 100px; height: 100px;"></td>
                                        <td><?= $pr->nama_produk; ?></td>
                                        <td><?= $pr->harga_produk; ?></td>
                                        <td><?= $pr->stok_produk; ?></td>
                                        <td>
                                        <a href="/Toko/editProduk/<?= $pr->id_produk ?>" class="btn btn-primary" type="button"><i class="fas fa-edit"></i></a>
                                            <form action="/Toko/detail/<?= $pr->id_produk; ?>.'?id_toko='.$id_toko" method="post" class="d-inline">
                                                <!-- //Terhindar dari hacking -->
                                                <?= csrf_field(); ?> 
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data Secara Permanen?');"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <?= $pager->makeLinks($currentPage, $perPage, $total, 'toko_pagination') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
<?= $this->endSection(); ?>