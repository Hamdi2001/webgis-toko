<?= $this->extend('halaman_utama/layout/template'); ?>
<?= $this->section('content'); ?>

<?= $this->extend('halaman_utama/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="main-form">
        <div class="section-body">
            <div class="card mb-3 " >
                <div class="card-header text-center">
                    <h4>Ubah Profile Akun</h4>
                </div>
                <div class="card-body">
                  <form action="/Backend/updateProfil/<?= $toko['id_toko']; ?>" method="POST" enctype="multipart/form-data">
                        <?php $errors = validation_errors() ?>
                        <input type="hidden" name="id_toko" value="<?= $toko['id_toko']; ?>">
                        <input type="hidden" name="foto_lama" value="<?= $toko['foto_toko']; ?>">
                        <div class="form-group col-md-6">
                            <label for="">Foto Toko</label><img src="/img/<?= $toko['foto_toko']; ?>" alt="" class="d-inline foto_toko">
                            <div class="form-control _ge_de_ol custom-file">
                                <input type="file" name="foto_toko" class="custom-file-input" id="foto_toko">
                                <label class="custom-file-label" for="foto_toko"><?= $toko['foto_toko']; ?></label>
                            </div>
                            <p class="text-danger"><?= isset($errors['foto_toko']) == isset($errors['foto_toko']) ? validation_show_error('foto_toko') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <input type="text" name="username_toko" class="form-control _ge_de_ol" value="<?= (old('username_toko')) ? old('username_toko') : $toko['username_toko'] ?>">
                            <p class="text-danger"><?= isset($errors['username_toko']) == isset($errors['username_toko']) ? validation_show_error('username_toko') : '' ?></p>
                        </div>
                         <div class="form-group">
                            <input type="text" name="password_toko" class="form-control _ge_de_ol" value="<?= (old('password_toko')) ? old('password_toko') : $toko['password_toko'] ?>">
                            <p class="text-danger"><?= isset($errors['password_toko']) == isset($errors['password_toko']) ? validation_show_error('password_toko') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <input type="email" name="toko_email" class="form-control _ge_de_ol" value="<?= (old('toko_email')) ? old('toko_email') : $toko['email_toko'] ?>">
                            <p class="text-danger"><?= isset($errors['toko_email']) == isset($errors['toko_email']) ? validation_show_error('toko_email') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nomor_telpon" class="form-control _ge_de_ol" value="<?= (old('nomor_telpon')) ? old('nomor_telpon') : $toko['nomor_telpon'] ?>">
                            <p class="text-danger"><?= isset($errors['nomor_telpon']) == isset($errors['nomor_telpon']) ? validation_show_error('nomor_telpon') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nama_toko" class="form-control _ge_de_ol" value="<?= (old('nama_toko')) ? old('nama_toko') : $toko['nama_toko'] ?>">
                            <p class="text-danger"><?= isset($errors['nama_toko']) == isset($errors['nama_toko']) ? validation_show_error('nama_toko') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <input type="text" name="alamat_toko" class="form-control _ge_de_ol" value="<?= (old('alamat_toko')) ? old('alamat_toko') : $toko['alamat_toko'] ?>">
                            <p class="text-danger"><?= isset($errors['alamat_toko']) == isset($errors['alamat_toko']) ? validation_show_error('alamat_toko') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <input type="text" name="jenis_usaha" class="form-control _ge_de_ol" value="<?= (old('jenis_usaha')) ? old('jenis_usaha') : $toko['jenis_usaha'] ?>">
                            <p class="text-danger"><?= isset($errors['jenis_usaha']) == isset($errors['jenis_usaha']) ? validation_show_error('jenis_usaha') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <select name="jenis_usaha_omset" class="form-control _ge_de_ol" type="text">
                            <option value="" <?= old('jenis_usaha_omset') == 'Masukkan Omset' ? 'selected' : '' ?>>Masukkan Omset</option>
                            <option value="Usaha Mikro" <?= old('jenis_usaha_omset') == 'Usaha Mikro' ? 'selected' : '' ?>>Maksimal Rp 300 juta</option>
                            <option value="Usaha Kecil" <?= old('jenis_usaha_omset') == 'Usaha Kecil' ? 'selected' : '' ?>>Lebih dari Rp 300 juta – Rp 2,5 miliar</option>
                            <option value="Usaha Menengah" <?= old('jenis_usaha_omset') == 'Usaha Menengahk' ? 'selected' : '' ?>>Lebih dari Rp 2,5 miliar – Rp 50 miliar</option>
                            <option value="Usaha Besar" <?= old('jenis_usaha_omset') == 'Usaha Besar' ? 'selected' : '' ?>>Lebih dari Rp 50 miliar</option>
                            </select>
                            <p class="text-danger"><?= isset($errors['jenis_usaha_omset']) == isset($errors['jenis_usaha_omset']) ? validation_show_error('jenis_usaha_omset') : '' ?></p>
                        </div>
                        <button type="submit" class="btn btn-success d-grid gap-2 col-6 mx-auto">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->endSection(); ?>