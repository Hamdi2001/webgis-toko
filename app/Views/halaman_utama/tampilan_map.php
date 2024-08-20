<?= $this->extend('halaman_utama/layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Tampilan Map</h1>
        </div>
<!-- Single Page Header End -->

    <div class="container">
        <div class="row">
            <div class="main-map">
                <div id="map" class="custom-popup">
			    </div>
            </div>
        </div>
        <div class="row">
            <h1 class="mt-2">Daftar Toko Yang Tersedia</h1>
            <form action="" method="get">
                <div class="col-4">
                    <div class="input-group mb-3">
                        <?php $request = \Config\Services::request(); ?>
                        <input type="text" class="form-control" placeholder="Masukkan Keyword..." name="keyword" value="<?= $request->getGet('keyword'); ?>">
                        <button class="btn btn-outline-secondary fas fa-search text-primary" type="sumbit" name="submit"></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama Toko</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kecamatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($keyword != ''){ ?>
                    <?php
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $no = 1 + (5 * ($page - 1));
                    ?>
                    <?php }else{ ?>
                    <?php
                    $no = ($currentPage - 1) * $perPage + 1;
                    ?>
                    <?php } ?>
                    <?php 
                    foreach ($toko as $tk) : ?>
                        <tr class="text-center">
                            <td><?= $no++; ?></td>
                            <td><?= $tk['nama_toko']; ?></td>
                            <td><?= $tk['alamat_toko']; ?></td>
                            <td><?= $tk['kecamatan_toko']; ?></td>
                    <?php endforeach; ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if ($keyword != ''){ ?>
    <?= $pager->links('default', 'pagination'); ?>
    <?php }else{ ?>
    <?= $pager->links('toko_pagination', 'pagination') ?>
    <?php } ?>
<?= $this->include('admin_layout/map_toko'); ?>
<style>
.custom-popup .leaflet-popup-content-wrapper {
  background:#2c3e50;
  color:#fff;
  font-size:16px;
  line-height:24px;
  text-align: center;
  }

.custom-popup .leaflet-popup-content-wrapper img{
    height: 100px;
    width: 100px;
    padding-bottom: 10px;
  }

.custom-popup .leaflet-popup-content-wrapper a {
  color:rgba(255,255,255,0.5);
  }
.custom-popup .leaflet-popup-tip-container {
  width:30px;
  height:15px;
  }
.custom-popup .leaflet-popup-tip {
  border-left:15px solid transparent;
  border-right:15px solid transparent;
  border-top:15px solid #2c3e50;
  }
</style>
<script>    
    const market = L.icon({
        iconUrl: '<?= base_url('marker/market.png'); ?>',
        iconSize: [45, 45],
    });

    <?php foreach($location as $value) {?>
		L.marker([<?= $value['lat_toko']; ?>, <?= $value['lon_toko']; ?>], {
            icon : market
        })
		.bindPopup('<img src="<?= base_url('img/' . $value['foto_toko']) ?>"width="100px;height:100px;"><br>'+
			'<b><?= $value['nama_toko']; ?></b><br>'+
			'Alamat : <?= $value['alamat_toko']; ?><br>'+
            '<a href="/backend/<?= $value['id_toko']; ?>">Lihat Detail.....</a><br>'+
            '<a href="https://www.google.com/maps?q=<?= $value['lat_toko']; ?>,<?= $value['lon_toko']; ?>" target="_blank" class="btn">Buka Di Google Maps</a>') 
		.addTo(map);
	<?php } ?>

    // Fungsi untuk menentukan warna berdasarkan atribut Kecamatan
        function hashStringToColor(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) {
                hash = str.charCodeAt(i) + ((hash << 5) - hash);
            }
            let color = '#';
            for (let i = 0; i < 3; i++) {
                const value = (hash >> (i * 8)) & 0xFF;
                color += ('00' + value.toString(16)).substr(-2);
            }
            return color;
        }
    
    // Memuat dan menambahkan GeoJSON ke peta dengan gaya dinamis
        $.getJSON("<?= base_url('kabupaten/berau.geojson'); ?>", function(data) {
        L.geoJSON(data, {
            style: function(feature) {
                return {
                    color: hashStringToColor(feature.properties.Kecamatan), // Menghasilkan warna dari nama kecamatan
                    fillColor: hashStringToColor(feature.properties.Kecamatan), // Warna isi dengan transparansi
                    fillOpacity: 0.5 // Menyesuaikan transparansi
                };
            },
            onEachFeature: function(feature, layer) {
                // Mengikat tooltip dengan nama kecamatan
                layer.bindTooltip(feature.properties.Kecamatan, {
                    permanent: true, // Label akan selalu terlihat
                    direction: "center", // Pusatkan label
                    className: "kecamatan-label" // Kelas CSS untuk styling label
                });
            }
        }).addTo(map);
    });
</script>

<?= $this->endSection(); ?>