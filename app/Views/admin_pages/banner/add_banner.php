<?= $this->extend('admin_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="section-body ">
            <div class="card mb-3" >
                <div class="card-header text-center">
                    <h4>Tambah Banner</h4>
                </div>
                <div class="card-body">
                <form action="<?php echo base_url('Pages/addBannerBaru'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-03-main">
                    <?php $errors = validation_errors() ?>
                     <input type="hidden" name="id" value="<?= session()->get('user_id'); ?>">
                     <div class="form-group">
                        <label>Masukkan Foto Banner</label><p class="text-danger d-inline">*</p>
                        <input type="file" name="foto_banner" class="form-control" value="<?= old('foto_banner'); ?>" accept="banner/*">
                        <p class="text-danger"><?= isset($errors['foto_banner']) == isset($errors['foto_banner']) ? validation_show_error('foto_banner') : '' ?></p>
                    </div>
                    <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                        <input type="text" name="deskripsi_banner" class="form-control _ge_de_ol" placeholder="Masukkan Deskripsi Singkat" value="<?= old('deskripsi_banner'); ?>">
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