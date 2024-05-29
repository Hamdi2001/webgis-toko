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
                    <form action="/Pages/updateBerita/<?= $berita['id_berita']; ?>" method="post" enctype="multipart/form-data">
                        <?php $errors = validation_errors(); ?>
                        <div class="form-03-main">
                            <input type="hidden" name="id_berita" value="<?= $berita['id_berita']; ?>">
                            <input type="hidden" name="foto_lama" value="<?= $berita['gambar_berita']; ?>">
                            <input type="hidden" name="id" value="<?= session()->get('user_id'); ?>">

                            <!-- Judul Berita Field -->
                            <div class="form-group">
                                <p class="text-danger d-inline">*Wajib Diisi</p>
                                <input type="text" name="judul_berita" class="form-control _ge_de_ol" placeholder="Masukkan Judul Berita" value="<?= old('judul_berita', $berita['judul_berita']); ?>">
                                <p class="text-danger"><?= isset($errors['judul_berita']) ? validation_show_error('judul_berita') : ''; ?></p>
                            </div>

                            <!-- Slug Berita Field -->
                            <div class="form-group">
                                <p class="text-danger d-inline">*Wajib Diisi</p>
                                <input type="text" name="slug_berita" class="form-control _ge_de_ol" placeholder="Masukkan Slug Berita" value="<?= old('slug_berita', $berita['slug_berita']); ?>">
                                <p class="text-danger"><?= isset($errors['slug_berita']) ? validation_show_error('slug_berita') : ''; ?></p>
                            </div>

                            <!-- Isi Berita Field -->
                            <div class="form-group">
                                <p class="text-danger d-inline">*Wajib Diisi</p>
                                <textarea rows="10" cols="30" id="editor" name="isi_berita" class="form-control _ge_de_ol" placeholder="Masukkan Isi Berita"><?= old('isi_berita', $berita['isi_berita']); ?></textarea>
                                <p class="text-danger"><?= isset($errors['isi_berita']) ? validation_show_error('isi_berita') : ''; ?></p>
                            </div>

                            <!-- Penulis Berita Dropdown -->
                            <div class="form-group">
                                <p class="text-danger d-inline">*Wajib Diisi</p>
                                <select name="penulis_berita" class="form-control _ge_de_ol">
                                    <option value="" hidden>Pilih Penulis</option>
                                    <?php foreach ($penulis as $value) : ?>
                                        <option value="<?= $value['id_penulis']; ?>" <?= old('penulis_berita', $berita['id_penulis']) == $value['id_penulis'] ? 'selected' : ''; ?>>
                                            <?= $value['nama_penulis']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger"><?= isset($errors['penulis_berita']) ? validation_show_error('penulis_berita') : ''; ?></p>
                            </div>

                            <!-- Gambar Berita Field -->
                            <div class="form-group">
                                <label for="gambar_berita">Gambar Berita</label><p class="text-danger d-inline">*</p>
                                <div class="form-control _ge_de_ol custom-file">
                                    <input type="file" name="gambar_berita" class="custom-file-input" id="gambar_berita">
                                    <label class="custom-file-label" for="gambar_berita"><?= $berita['gambar_berita']; ?></label>
                                    <img src="/gambar berita/<?= $berita['gambar_berita']; ?>" alt="" class="d-inline foto_toko">
                                </div>
                                <p class="text-danger"><?= isset($errors['gambar_berita']) ? validation_show_error('gambar_berita') : ''; ?></p>
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