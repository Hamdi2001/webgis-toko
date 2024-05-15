<?= $this->extend('admin_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="section-body ">
            <div class="card mb-3" >
                <div class="card-header text-center">
                    <h4>Tambah Berita</h4>
                </div>
                <div class="card-body">
                <form action="<?php echo base_url('Pages/addBerita'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-03-main">
                    <?php $errors = validation_errors() ?>
                    <div class="form-group">
                        <input type="text" name="judul_berita" class="form-control _ge_de_ol" placeholder="Masukkan Judul Berita" value="<?= old('judul_berita'); ?>">
                        <p class="text-danger"><?= isset($errors['judul_berita']) == isset($errors['judul_berita']) ? validation_show_error('judul_berita') : '' ?></p>
                    </div>
                    <div class="form-group">
                        <input type="text" name="slug_berita" class="form-control _ge_de_ol" placeholder="Masukkan Slug Berita" value="<?= old('slug_berita'); ?>">
                        <p class="text-danger"><?= isset($errors['slug_berita']) == isset($errors['slug_berita']) ? validation_show_error('slug_berita') : '' ?></p>
                    </div>
                    <div class="form-group">
                        <textarea rows="10" cols="30" id="editor"  name="isi_berita" class="form-control _ge_de_ol" placeholder="Masukkan Isi Berita" value="<?= old('isi_berita'); ?>"></textarea>
                        <p class="text-danger"><?= isset($errors['isi_berita']) == isset($errors['isi_berita']) ? validation_show_error('isi_berita') : '' ?></p>
                    </div>
                    <div class="form-group">
                        <input type="text" name="penulis_berita" class="form-control _ge_de_ol" placeholder="Masukkan Penulis Berita" value="<?= old('penulis_berita'); ?>">
                        <p class="text-danger"><?= isset($errors['penulis_berita']) == isset($errors['penulis_berita']) ? validation_show_error('penulis_berita') : '' ?></p>
                    </div>
                   <div class="form-group">
                        <input type="file" name="gambar_berita" class="form-control" accept="gambar berita/*">
                        <p class="text-danger"><?= isset($errors['gambar_berita']) == isset($errors['gambar_berita']) ? validation_show_error('gambar_berita') : '' ?></p>
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