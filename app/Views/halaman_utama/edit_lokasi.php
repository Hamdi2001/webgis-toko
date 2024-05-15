<?= $this->extend('halaman_utama/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="main-form">
        <div class="section-body">
            <div class="card mb-3 " >
                <div class="card-header text-center">
                    <h4>Ubah Lokasi</h4>
                </div>
                <div class="card-body">
                  <form action="/Backend/updateLokasi/<?= $toko['id_toko']; ?>" method="POST" enctype="multipart/form-data">
                        <?php $errors = validation_errors() ?>
                        <input type="hidden" name="id_toko" value="<?= $toko['id_toko']; ?>">
                        <div class="row">
                            <div class="main-map"> 
                                <div id="map" class="custom-popup" style="height: 350px;">
                                </div>
                            </div>
                        </div>
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
                        <button type="submit" class="btn btn-success d-grid gap-2 col-6 mx-auto">Ubah</button>
                    </form>
                </div>
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
