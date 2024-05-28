<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link href="<?php echo base_url('authentication/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('authentication/assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('authentication/assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet">

    <title>TEKO (Temu Toko)</title>
  </head>
  
  <body>
    <section class="form-02-main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="_lk_de">
              <form action="<?php echo base_url('Auth/register'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-03-main" style="width: 1000px;"><br/>
                <a href="<?php echo base_url('/login')?>" class="btn-back"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-125 -100 700 1000"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg></a>
                  <div class="logo">
                    <img src="<?php echo base_url('authentication/assets/images/user.png') ?>">
                  </div>
                  <?php $errors = validation_errors() ?>
                  <div class="form-group">
                    <label>Masukkan Foto</label>
                    <input type="file" name="foto_toko" class="form-control" value="<?= old('foto_toko'); ?>" accept="img/*">
                    <p class="text-danger"><?= isset($errors['foto_toko']) == isset($errors['foto_toko']) ? validation_show_error('foto_toko') : '' ?></p>
                  </div>
                  <div class="form-group">
                    <input type="text" name="nib_toko" class="form-control _ge_de_ol" placeholder="Masukkan Nomor NIB Toko" value="<?= old('nib_toko'); ?>">
                    <p class="text-danger"><?= isset($errors['nib_toko']) == isset($errors['nib_toko']) ? validation_show_error('nib_toko') : '' ?></p>
                  </div>
                  <div class="form-group">
                    <label>Masukkan Foto NIB Toko</label>
                    <input type="file" name="foto_nib" class="form-control" value="<?= old('foto_nib'); ?>" accept="nib/*">
                    <p class="text-danger"><?= isset($errors['foto_nib']) == isset($errors['foto_nib']) ? validation_show_error('foto_nib') : '' ?></p>
                  </div>
                  <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                    <input type="text" name="ktp_pemilik" class="form-control _ge_de_ol" placeholder="Masukkan Nomor KTP" value="<?= old('ktp_pemilik'); ?>">
                    <p class="text-danger"><?= isset($errors['ktp_pemilik']) == isset($errors['ktp_pemilik']) ? validation_show_error('ktp_pemilik') : '' ?></p>
                  </div>
                  <div class="form-group">
                    <label>Masukkan Foto KTP</label><p class="text-danger d-inline">*</p>
                    <input type="file" name="foto_ktp" class="form-control" value="<?= old('foto_ktp'); ?>" accept="ktp/*">
                    <p class="text-danger"><?= isset($errors['foto_ktp']) == isset($errors['foto_ktp']) ? validation_show_error('foto_ktp') : '' ?></p>
                  </div>
                  <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                    <input type="text" name="kk_pemilik" class="form-control _ge_de_ol" placeholder="Masukkan Nomor Kartu Keluarga" value="<?= old('kk_pemilik'); ?>">
                    <p class="text-danger"><?= isset($errors['kk_pemilik']) == isset($errors['kk_pemilik']) ? validation_show_error('kk_pemilik') : '' ?></p>
                  </div>
                  <div class="form-group">
                    <label>Masukkan Foto Kartu Keluarga</label><p class="text-danger d-inline">*</p>
                    <input type="file" name="foto_kk" class="form-control" value="<?= old('foto_kk'); ?>" accept="kartu keluarga/*">
                    <p class="text-danger"><?= isset($errors['foto_kk']) == isset($errors['foto_kk']) ? validation_show_error('foto_kk') : '' ?></p>
                  </div>
                  <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                    <input type="text" name="username" class="form-control _ge_de_ol" placeholder="Masukkan Username" value="<?= old('username'); ?>">
                    <p class="text-danger"><?= isset($errors['username']) == isset($errors['username']) ? validation_show_error('username') : '' ?></p>
                  </div>
                  <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                    <input type="password" name="password" class="form-control _ge_de_ol" placeholder="Masukkan Password" value="<?= old('password'); ?>">
                    <p class="text-danger"><?= isset($errors['password']) == isset($errors['password']) ? validation_show_error('password') : '' ?></p>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email_user" class="form-control _ge_de_ol" placeholder="Masukkan Email" value="<?= old('email_user'); ?>">
                    <p class="text-danger"><?= isset($errors['email_user']) == isset($errors['email_user']) ? validation_show_error('email_user') : '' ?></p>
                  </div>
                  <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                    <input type="text" name="nomor" class="form-control _ge_de_ol" placeholder="Masukkan Nomor Handphone" value="<?= old('nomor'); ?>">
                    <p class="text-danger"><?= isset($errors['nomor']) == isset($errors['nomor']) ? validation_show_error('nomor') : '' ?></p>
                  </div>
                  <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                    <input type="text" name="nama" class="form-control _ge_de_ol" placeholder="Masukkan Nama Toko" value="<?= old('nama'); ?>">
                    <p class="text-danger"><?= isset($errors['nama']) == isset($errors['nama']) ? validation_show_error('nama') : '' ?></p>
                  </div>
                  <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                    <input type="text" name="alamat" class="form-control _ge_de_ol" placeholder="Masukkan Alamat Toko" value="<?= old('alamat'); ?>">
                    <p class="text-danger"><?= isset($errors['alamat']) == isset($errors['alamat']) ? validation_show_error('alamat') : '' ?></p>
                  </div>
                  <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                    <input type="text" name="jenis_usaha" class="form-control _ge_de_ol" placeholder="Masukkan Jenis Usaha" value="<?= old('jenis_usaha'); ?>">
                    <p class="text-danger"><?= isset($errors['jenis_usaha']) == isset($errors['jenis_usaha']) ? validation_show_error('jenis_usaha') : '' ?></p>
                  </div>
                  <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                    <select name="kecamatan" class="form-control _ge_de_ol" type="text">
                    <option value="" <?= old('kecamatan') == 'Masukkan Kecamatan Baru' ? 'selected' : '' ?>>Masukkan Kecamatan Baru</option>
                    <option value="Batu Putih" <?= old('kecamatan') == 'Batu Putih' ? 'selected' : '' ?>>Batu Putih</option>
                    <option value="Biatan" <?= old('kecamatan') == 'Biatan' ? 'selected' : '' ?>>Biatan</option>
                    <option value="Biduk-Biduk" <?= old('kecamatan') == 'Biduk-Biduk' ? 'selected' : '' ?>>Biduk-Biduk</option>
                    <option value="Gunung Tabur" <?= old('kecamatan') == 'Gunung Tabur' ? 'selected' : '' ?>>Gunung Tabur</option>
                    <option value="Kelay" <?= old('kecamatan') == 'Kelay' ? 'selected' : '' ?>>Kelay</option>
                    <option value="Maratua" <?= old('kecamatan') == 'Maratua' ? 'selected' : '' ?>>Maratua</option>
                    <option value="Pulau Derawan" <?= old('kecamatan') == 'Pulau Derawan' ? 'selected' : '' ?>>Pulau Derawan</option>
                    <option value="Sambaliung" <?= old('kecamatan') == 'Sambaliung' ? 'selected' : '' ?>>Sambaliung</option>
                    <option value="Segah" <?= old('kecamatan') == 'Segah' ? 'selected' : '' ?>>Segah</option>
                    <option value="Tabalar" <?= old('kecamatan') == 'Tabalar' ? 'selected' : '' ?>>Tabalar</option>
                    <option value="Talisayan" <?= old('kecamatan') == 'Talisayan' ? 'selected' : '' ?>>Talisayan</option>
                    <option value="Tanjung Redeb" <?= old('kecamatan') == 'Tanjung Redeb' ? 'selected' : '' ?>>Tanjung Redeb</option>
                    <option value="Teluk Bayur" <?= old('kecamatan') == 'Teluk Bayur' ? 'selected' : '' ?>>Teluk Bayur</option>
                    </select>
                    <p class="text-danger"><?= isset($errors['kecamatan']) == isset($errors['kecamatan']) ? validation_show_error('kecamatan') : '' ?></p>
                  </div>
                  <div class="form-group"><p class="text-danger d-inline">*Wajib Diisi</p>
                    <select name="jenis_usaha_omset" class="form-control _ge_de_ol" type="text">
                    <option value="" <?= old('jenis_usaha_omset') == 'Pilih Omset Usaha Anda' ? 'selected' : '' ?>>Pilih Omset Usaha anda</option>
                    <option value="Usaha Mikro" <?= old('jenis_usaha_omset') == 'Usaha Mikro' ? 'selected' : '' ?>>Maksimal Rp 300 juta</option>
                    <option value="Usaha Kecil" <?= old('jenis_usaha_omset') == 'Usaha Kecil' ? 'selected' : '' ?>>Lebih dari Rp 300 juta – Rp 2,5 miliar</option>
                    <option value="Usaha Menengah" <?= old('jenis_usaha_omset') == 'Usaha Menengah' ? 'selected' : '' ?>>Lebih dari Rp 2,5 miliar – Rp 50 miliar</option>
                    <option value="Usaha Besar" <?= old('jenis_usaha_omset') == 'Usaha Besar' ? 'selected' : '' ?>>Lebih dari Rp 50 miliar</option>
                    </select>
                    <p class="text-danger"><?= isset($errors['jenis_usaha_omset']) == isset($errors['jenis_usaha_omset']) ? validation_show_error('jenis_usaha_omset') : '' ?></p>
                  </div>
                  <div id="map" style="width: 100%; height: 200px;"></div>
                  <div class="form-group container">
                    <div class="row">
                      <div class="col"><p class="text-danger d-inline">*Wajib Diisi</p>
                        <input type="text" name="latitude" id="Latitude" class="form-control _ge_de_ol" placeholder="Masukkan Latitude" value="<?= old('latitude'); ?>">
                        <p class="text-danger"><?= isset($errors['latitude']) == isset($errors['latitude']) ? validation_show_error('latitude') : '' ?></p>
                      </div>
                      <div class="col"><p class="text-danger d-inline">*Wajib Diisi</p>
                        <input type="text" name="longitude" id="Longitude" class="form-control _ge_de_ol" placeholder="Masukkan Longitude" value="<?= old('longitude'); ?>">
                        <p class="text-danger"><?= isset($errors['longitude']) == isset($errors['longitude']) ? validation_show_error('longitude') : '' ?></p>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="form-group _btn_04">Submit</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
<?= $this->include('admin_layout/map_toko'); ?>
<script>
//Mengambil titik cordinat
var latInput = document.querySelector("[name=latitude]");
var lngInput = document.querySelector("[name=longitude]");

var curLocation = [1.753254, 117.629075];
map.attributionControl.setPrefix(false);

var marker = new L.marker(curLocation, {
  draggable: true,
});

//Mengambil titik cordinatar untuk marker geser/bergerak
marker.on('dragend', function(e) {
  var position = marker.getLatLng();
  marker.setLatLng(position, {
    curLocation,
  }).bindPopup(position).update();
  document.getElementById("Latitude").value = position.lat;
  document.getElementById("Longitude").value = position.lng;
});

//Mengambil titik cordinat saat map di klik
map.on('click', function(e) {
  var lat = e.latlng.lat;
  var lng = e.latlng.lng;
  if(!marker){
    marker = L.marker(e.latlng).addTo(map);
  }else{
    marker.setLatLng(e.latlng);
  }
  latInput.value = lat;
  lngInput.value = lng;
});

map.addLayer(marker);
</script>