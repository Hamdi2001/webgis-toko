<?= $this->extend('admin_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="page-heading">
	<div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= $title; ?></h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                	<ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="main-map">
				<div id="map">
				</div>
            </div>
		</div>
    </div>
</div>
<?= $this->include('admin_layout/map_toko'); ?>
<script>
const market = L.icon({
        iconUrl: '<?= base_url('marker/market.png'); ?>',
        iconSize: [45, 45],
    });

    <?php foreach($location as $key => $value) {?>
		L.marker([<?= $value['lat_toko']; ?>, <?= $value['lon_toko']; ?>], {
            icon : market
        })
		.bindPopup('<img src="<?= base_url('img/' . $value['foto_toko']) ?>"width="100px;height:100px;"><br>'+
			'<b><?= $value['nama_toko']; ?></b><br>'+
			'Alamat : <?= $value['alamat_toko']; ?><br>')
		.addTo(map);
	<?php } ?>
</script>

<?= $this->endSection(); ?>