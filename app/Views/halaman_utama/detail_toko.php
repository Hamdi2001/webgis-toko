<?= $this->extend('halaman_utama/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="main">
            <div class="card mb-3" style="width:100%;">
                <div class="row g-0">
                    <?php foreach ($toko as $tk) : ?>
                    <div class="col-md-2 text-center">
                    <img src="<?php echo base_url('img/' . $tk->foto_toko); ?>" class="img-fluid rounded-circle shadow-4-strong">
                    </div>
                    <div class="col-md-4">
                        <div class="card-body"> 
                            <h2><?php echo $tk->nama_toko;?></h2>
                            <h5><?php echo $tk->alamat_toko;?></h5>
                            <h5><?php echo $tk->nomor_telpon;?></h5>
                        </div>
                    </div>
                    <?php endforeach; ?>
                     <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title ">Informasi</h5>
                            <p class="card-text d-inline">Pada halaman ini pengunjung dapat melihat informasi seperti alamat, nama, dan nomor toko. Produk yang tersedia pada toko juga ditampilkan.</p>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <table class="table mt-3">
            <thead>
                <tr class="text-center">
                <th>No</th>
                <th>Foto Produk</th>
                <th>Nama Produk</th>
                <th>Stok Produk</th>
                <th>Harga Produk</th>
                </tr>
            </thead>
            <div class="card mb-5" style="width:100%;"></div>
            
            <tbody>
                <?php $nomor = ($pager->getCurrentPage() - 1) * $pager->getPerPage() + 1; ?>
                <?php foreach ($produk as $pr) : ?>
                    <tr class="text-center">
                    <td><?= $nomor++; ?></td>
                    <td><img src="<?= base_url('produk foto/' . $pr->foto_produk); ?>" alt="" class="foto_produk" style="width:100px; height:100px;"></td>
                    <td><?= $pr->nama_produk; ?></td>
                    <td><?= $pr->stok_produk; ?></td>
                    <td>Rp. <?= $pr->harga_produk; ?></td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
       
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-auto">
            <?= $pager->links() ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>