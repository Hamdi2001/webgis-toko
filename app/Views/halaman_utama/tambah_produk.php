<?= $this->extend('halaman_utama/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="main-form">
        <div class="section-body ">
            <div class="card mb-3" >
                <div class="card-header text-center">
                    <h4>Tambah Produk Pada Toko</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('Backend/dataToko')?>" method="post" enctype="multipart/form-data">
                        
                        <?php $errors = validation_errors() ?>
                        <div class="form-group">
                            <label for="">Foto Produk</label>
                            <input type="file" name="produk_foto" class="form-control" value="<?= old('produk_foto'); ?>" accept="foto_produk/*">
                            <p class="text-danger"><?= isset($errors['produk_foto']) == isset($errors['produk_foto']) ? validation_show_error('produk_foto') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" value="<?= old('nama_produk'); ?>">
                            <p class="text-danger"><?= isset($errors['nama_produk']) == isset($errors['nama_produk']) ? validation_show_error('nama_produk') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input type="text" name="harga_produk" class="form-control" value="<?= old('harga_produk'); ?>">
                            <p class="text-danger"><?= isset($errors['harga_produk']) == isset($errors['harga_produk']) ? validation_show_error('harga_produk') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="">Stok</label>
                            <input type="number" name="stok_produk" class="form-control" value="<?= old('stok_produk'); ?>">
                            <p class="text-danger"><?= isset($errors['stok_produk']) == isset($errors['stok_produk']) ? validation_show_error('stok_produk') : '' ?></p>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success"><i class="fas fa-papper-plane"></i>Save</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>