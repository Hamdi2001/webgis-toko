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
                <form action="/Toko/updateProduk/<?= $produk['id_produk']; ?>" method="post" enctype="multipart/form-data">
                <?php $errors = validation_errors() ?>
                        <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                        <input type="hidden" name="foto_lama" value="<?= $produk['foto_produk']; ?>">
                        <input type="hidden" name="id_toko" value="<?= $produk['id_toko']; ?>">
                    <div class="form-03-main">
                        <div class="form-group">
                            <label for="">Foto Produk</label>
                            <div class="form-control _ge_de_ol custom-file">
                                <input type="file" name="produk_foto" class="custom-file-input" id="produk_foto">
                                <label class="custom-file-label" for="produk_foto"><?= $produk['foto_produk']; ?></label>
                                <img src="/produk foto/<?= $produk['foto_produk']; ?>" alt="" class="d-inline foto_toko">
                            </div>
                            <p class="text-danger"><?= isset($errors['foto_produk']) == isset($errors['foto_produk']) ? validation_show_error('foto_produk') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nama_produk" class="form-control _ge_de_ol" value="<?= (old('nama_produk')) ? old('nama_produk') : $produk['nama_produk'] ?>">
                            <p class="text-danger"><?= isset($errors['nama_produk']) == isset($errors['nama_produk']) ? validation_show_error('nama_produk') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <input type="number" name="harga_produk" class="form-control _ge_de_ol" value="<?= (old('harga_produk')) ? old('harga_produk') : $produk['harga_produk'] ?>">
                            <p class="text-danger"><?= isset($errors['harga_produk']) == isset($errors['harga_produk']) ? validation_show_error('harga_produk') : '' ?></p>
                        </div>
                        <div class="form-group">
                            <input type="number" name="stok_produk" class="form-control _ge_de_ol" value="<?= (old('stok_produk')) ? old('stok_produk') : $produk['stok_produk'] ?>">
                            <p class="text-danger"><?= isset($errors['stok_produk']) == isset($errors['stok_produk']) ? validation_show_error('stok_produk') : '' ?></p>
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

var curLocation = [1.753254, 117.629075];
map.attributionControl.setPrefix(false);

var marker = new L.marker(curLocation, {
  draggable: true,
});

//Mengambil titik cordinatar untuk marker geser/bergerak
// marker.on('dragend', function(e) {
//   var position = marker.getLatLng();
//   marker.setLatLng(position, {
//     curLocation,
//   }).bindPopup(position).update();
//   $("#Latitude").val(position.lat);
//   $("#Longitude").val(position.lng);
// });

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

