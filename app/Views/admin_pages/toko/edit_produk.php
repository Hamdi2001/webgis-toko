<?= $this->extend('admin_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="section-body ">
            <div class="card mb-3" >
                <div class="card-header text-center">
                    <h4>Edit Toko</h4>
                </div>
                <div class="card-body">
                <form action="/Toko/updateProduk/<?= $produk['id_produk']; ?>" method="post" enctype="multipart/form-data">
                <?php $errors = validation_errors() ?>
                        <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                        <input type="hidden" name="foto_lama" value="<?= $produk['foto_produk']; ?>">
                        <input type="hidden" name="id_toko" value="<?= $produk['id_toko']; ?>">
                    <div class="form-03-main">
                        <div class="form-group">
                            <label for="">Foto Produk</label><p class="text-danger d-inline">*</p>
                            <div class="form-control _ge_de_ol custom-file">
                                <input type="file" name="produk_foto" class="custom-file-input" id="produk_foto">
                                <label class="custom-file-label" for="produk_foto"><?= $produk['foto_produk']; ?></label>
                                <img src="/produk foto/<?= $produk['foto_produk']; ?>" alt="" class="d-inline foto_toko">
                            </div>
                            <p class="text-danger"><?= isset($errors['foto_produk']) == isset($errors['foto_produk']) ? validation_show_error('foto_produk') : '' ?></p>
                        </div>
                        <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                            <input type="text" name="nama_produk" class="form-control _ge_de_ol" value="<?= (old('nama_produk')) ? old('nama_produk') : $produk['nama_produk'] ?>">
                            <p class="text-danger"><?= isset($errors['nama_produk']) == isset($errors['nama_produk']) ? validation_show_error('nama_produk') : '' ?></p>
                        </div>
                        <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                            <input type="number" name="harga_produk" class="form-control _ge_de_ol" value="<?= (old('harga_produk')) ? old('harga_produk') : $produk['harga_produk'] ?>">
                            <p class="text-danger"><?= isset($errors['harga_produk']) == isset($errors['harga_produk']) ? validation_show_error('harga_produk') : '' ?></p>
                        </div>
                        <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                            <input type="text" name="stok_produk" class="form-control _ge_de_ol" value="<?= (old('stok_produk')) ? old('stok_produk') : $produk['stok_produk'] ?>">
                            <p class="text-danger"><?= isset($errors['stok_produk']) == isset($errors['stok_produk']) ? validation_show_error('stok_produk') : '' ?></p>
                        </div>
                        <button type="submit" class="btn btn-primary d-grid gap-2 col-6 mx-auto">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

