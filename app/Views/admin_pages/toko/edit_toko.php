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
                <form action="/Toko/updateToko/<?= $toko['id_toko']; ?>" method="post" enctype="multipart/form-data">
                <?php $errors = validation_errors() ?>
                    <input type="hidden" name="id_toko" value="<?= $toko['id_toko']; ?>">
                    <input type="hidden" name="foto_toko_lama" value="<?= $toko['foto_toko']; ?>">
                    <input type="hidden" name="foto_nib_lama" value="<?= $toko['foto_nib']; ?>">
                    <input type="hidden" name="foto_ktp_lama" value="<?= $toko['foto_ktp']; ?>">
                    <input type="hidden" name="foto_kk_lama" value="<?= $toko['foto_kk']; ?>">
                    <div class="form-03-main">
                        <div class="form-group">
                            <label for="">Foto Toko</label>
                            <div class="form-control _ge_de_ol custom-file">
                                <input type="file" name="foto_toko" id="foto_toko">
                                <label class="custom-file-label" for="foto_toko"><?= $toko['foto_toko']; ?></label>
                                <img src="/img/<?= $toko['foto_toko']; ?>"class="foto_toko">
                            </div>
                            <p class="text-danger"><?= isset($errors['foto_toko']) == isset($errors['foto_toko']) ? validation_show_error('foto_toko') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="">Foto NIB</label>
                            <div class="form-control _ge_de_ol custom-file">
                                <input type="file" name="foto_nib" id="foto_nib">
                                <label class="custom-file-label" for="foto_nib"><?= $toko['foto_nib']; ?></label>
                                <img src="/nib/<?= $toko['foto_nib']; ?>"class="foto_toko">
                            </div>
                            <p class="text-danger"><?= isset($errors['foto_nib']) == isset($errors['foto_nib']) ? validation_show_error('foto_nib') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="">Foto KTP</label>
                            <div class="form-control _ge_de_ol custom-file">
                                <input type="file" name="foto_ktp" id="foto_ktp">
                                <label class="custom-file-label" for="foto_ktp"><?= $toko['foto_ktp']; ?></label>
                                <img src="/ktp/<?= $toko['foto_ktp']; ?>"class="foto_toko">
                            </div>
                            <p class="text-danger"><?= isset($errors['foto_ktp']) == isset($errors['foto_ktp']) ? validation_show_error('foto_ktp') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <label for="">Foto KK</label>
                            <div class="form-control _ge_de_ol custom-file">
                                <input type="file" name="foto_kk" id="foto_kk">
                                <label class="custom-file-label" for="foto_kk"><?= $toko['foto_kk']; ?></label>
                                <img src="/kartu keluarga/<?= $toko['foto_kk']; ?>"class="foto_toko">
                            </div>
                            <p class="text-danger"><?= isset($errors['foto_kk']) == isset($errors['foto_kk']) ? validation_show_error('foto_kk') : '' ?></p>
                        </div>
                         <div class="form-group">
                            <input type="text" name="nib_toko" class="form-control _ge_de_ol" value="<?= (old('nib_toko')) ? old('nib_toko') : $toko['nib_toko'] ?>">
                            <p class="text-danger"><?= isset($errors['nib_toko']) == isset($errors['nib_toko']) ? validation_show_error('nib_toko') : '' ?></p>
                        </div>
                         <div class="form-group">
                            <input type="text" name="ktp_pemilik" class="form-control _ge_de_ol" value="<?= (old('ktp_pemilik')) ? old('ktp_pemilik') : $toko['ktp_pemilik'] ?>">
                            <p class="text-danger"><?= isset($errors['ktp_pemilik']) == isset($errors['ktp_pemilik']) ? validation_show_error('ktp_pemilik') : '' ?></p>
                        </div>
                         <div class="form-group">
                            <input type="text" name="kk_pemilik" class="form-control _ge_de_ol" value="<?= (old('kk_pemilik')) ? old('kk_pemilik') : $toko['kk_pemilik'] ?>">
                            <p class="text-danger"><?= isset($errors['kk_pemilik']) == isset($errors['kk_pemilik']) ? validation_show_error('kk_pemilik') : '' ?></p>
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
                            <input type="text" name="jenis_usaha" class="form-control _ge_de_ol" value="<?= (old('jenis_usaha')) ? old('jenis_usaha') : $toko['jenis_usaha'] ?>">
                            <p class="text-danger"><?= isset($errors['jenis_usaha']) == isset($errors['jenis_usaha']) ? validation_show_error('jenis_usaha') : '' ?></p>
                        </div>
                        <div class="form-group">
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
                        <div class="form-group">
                            <input type="text" name="alamat_toko" class="form-control _ge_de_ol" value="<?= (old('alamat_toko')) ? old('alamat_toko') : $toko['alamat_toko'] ?>">
                            <p class="text-danger"><?= isset($errors['alamat_toko']) == isset($errors['alamat_toko']) ? validation_show_error('alamat_toko') : '' ?></p>
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
                        <div id="map" style="width: 100%; height: 200px;"></div>
                            <div class="form-group container">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="latitude" id="Latitude" class="form-control _ge_de_ol" placeholder="Enter Latitude" value="<?= (old('lat_toko')) ? old('alamat_lat_tokotoko') : $toko['lat_toko'] ?>">
                                        <p class="text-danger"><?= isset($errors['latitude']) == isset($errors['latitude']) ? validation_show_error('latitude') : '' ?></p>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="longitude" id="Longitude" class="form-control _ge_de_ol" placeholder="Enter Longitude" value="<?= (old('lon_toko')) ? old('lon_toko') : $toko['lon_toko'] ?>">
                                        <p class="text-danger"><?= isset($errors['longitude']) == isset($errors['longitude']) ? validation_show_error('longitude') : '' ?></p>
                                    </div>
                                </div>
                            </div>
                        <button type="submit" class="btn btn-primary d-grid gap-2 col-6 mx-auto">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('admin_layout/map_toko'); ?>
<script>
//Mengambil titik cordinat
var latInput = document.querySelector("[name=latitude]");
var lngInput = document.querySelector("[name=longitude]");

var curLocation = [<?= (old('lat_toko')) ? old('alamat_lat_tokotoko') : $toko['lat_toko'] ?>, <?= (old('lon_toko')) ? old('lon_toko') : $toko['lon_toko'] ?>];
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

<?= $this->endSection(); ?>

