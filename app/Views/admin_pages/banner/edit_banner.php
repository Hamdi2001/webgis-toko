<?= $this->extend('admin_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="section-body ">
            <div class="card mb-3" >
                <div class="card-header text-center">
                    <h4>Edit Banner</h4>
                </div>
                <div class="card-body">
                <form action="/Pages/updateBanner/<?= $banner['id_banner']; ?>" method="post" enctype="multipart/form-data">
                <?php $errors = validation_errors() ?>
                    <input type="hidden" name="id_banner" value="<?= $banner['id_banner']; ?>">
                    <input type="hidden" name="foto_banner_lama" value="<?= $banner['gambar_banner']; ?>">
                    <div class="form-03-main">
                        <div class="form-group">
                            <label for="">Foto Banner</label><p class="text-danger d-inline">*</p>
                            <div class="form-control _ge_de_ol custom-file">
                                <input type="file" name="foto_banner" id="foto_banner">
                                <label class="custom-file-label" for="foto_banner"><?= $banner['gambar_banner']; ?></label>
                                <img src="/banner/<?= $banner['gambar_banner']; ?>"class="foto_toko">
                            </div>
                            <p class="text-danger"><?= isset($errors['foto_banner']) == isset($errors['foto_banner']) ? validation_show_error('foto_banner') : '' ?></p>
                        </div>
                        <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                            <input type="text" name="deskripsi_banner" class="form-control _ge_de_ol" value="<?= (old('deskripsi_banner')) ? old('deskripsi_banner') : $banner['deskripsi_banner'] ?>">
                            <p class="text-danger"><?= isset($errors['deskripsi_banner']) == isset($errors['deskripsi_banner']) ? validation_show_error('deskripsi_banner') : '' ?></p>
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