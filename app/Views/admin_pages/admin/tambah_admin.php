<?= $this->extend('admin_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="section-body ">
            <div class="card mb-3" >
                <div class="card-header text-center">
                    <h4><?= $title; ?></h4>
                </div>
                <div class="card-body">
                <form action="<?php echo base_url('Pages/addAdmin'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-03-main">
                    <?php $errors = validation_errors() ?>
                    <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                        <input type="text" name="nama_admin" class="form-control _ge_de_ol" placeholder="Masukkan Nama Admin" value="<?= old('nama_admin'); ?>">
                        <p class="text-danger"><?= isset($errors['nama_admin']) == isset($errors['nama_admin']) ? validation_show_error('nama_admin') : '' ?></p>
                    </div>
                    <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                        <input type="text" name="username_admin" class="form-control _ge_de_ol" placeholder="Masukkan Username Admin" value="<?= old('username_admin'); ?>">
                        <p class="text-danger"><?= isset($errors['username_admin']) == isset($errors['username_admin']) ? validation_show_error('username_admin') : '' ?></p>
                    </div>
                    <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                        <input type="password" name="password_admin" class="form-control _ge_de_ol" placeholder="Masukkan Password Admin" value="<?= old('password_admin'); ?>">
                        <p class="text-danger"><?= isset($errors['password_admin']) == isset($errors['password_admin']) ? validation_show_error('password_admin') : '' ?></p>
                    </div>
                    <button type="submit" class="btn btn-primary d-grid gap-2 col-6 mx-auto">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('admin_layout/editor'); ?>
<?= $this->endSection(); ?>