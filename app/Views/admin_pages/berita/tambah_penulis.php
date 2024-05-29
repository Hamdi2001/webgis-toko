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
                <form action="<?php echo base_url('Pages/addPenulis'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-03-main">
                    <?php $errors = validation_errors() ?>
                    <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                        <input type="text" name="nama_penulis" class="form-control _ge_de_ol" placeholder="Masukkan nama_penulis" value="<?= old('nama_penulis'); ?>">
                        <p class="text-danger"><?= isset($errors['nama_penulis']) == isset($errors['nama_penulis']) ? validation_show_error('nama_penulis') : '' ?></p>
                    </div>
                    <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                        <input type="text" name="nomor_penulis" class="form-control _ge_de_ol" placeholder="Masukkan Nomor Penulis" value="<?= old('nomor_penulis'); ?>">
                        <p class="text-danger"><?= isset($errors['nomor_penulis']) == isset($errors['nomor_penulis']) ? validation_show_error('nomor_penulis') : '' ?></p>
                    </div>
                    <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                        <input type="text" name="email_penulis" class="form-control _ge_de_ol" placeholder="Masukkan Email Penulis" value="<?= old('email_penulis'); ?>">
                        <p class="text-danger"><?= isset($errors['email_penulis']) == isset($errors['email_penulis']) ? validation_show_error('email_penulis') : '' ?></p>
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