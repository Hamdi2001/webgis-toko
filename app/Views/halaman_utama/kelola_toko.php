<?= $this->extend('halaman_utama/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="main">
            <?php  if (session()->get('status_toko') == '2'){?> 
                <div class="alert alert-danger" role="alert">
                    *Toko Anda Tidak Akan Tampil Karena Sedang Menunggu Verifikasi Dari Perubahan Lokasi
                </div>
            <?php }else if (session()->get('status_toko') == '3'){ ?>
                <div class="alert alert-danger" role="alert">
                    *Perubahan Data Lokasi Ditolak Mohon Kembalikan Lokasi Seperti Sebelumnya/Ubah Lokasi yang Sesuai 
                </div>
            <?php } ?>

            <div class="card mb-3" style="width:100%;">
                <div class="row g-0">
                    <div class="col-md-2 text-center">
                    <img src="/img/<?= session()->get('foto_toko') ?>" class="img-fluid rounded-circle shadow-4-strong" alt="...">
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <h2><?= session()->get('nama_toko') ?></h2>
                            <h5><?= session()->get('alamat_toko') ?></h5>
                            <h5><?= session()->get('nomor_telepon') ?></h5>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title ">Informasi Toko</h5>
                            <p class="card-text d-inline">Pada halaman ini pemilik toko (Anda) dapat melihat berbagai informasi toko. Pemilik juga dapat mengubah dan menghapus produk.</p>
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
                <th>Aksi</th>
                </tr>
            </thead>
            <div class="card mb-5" style="width:100%;"></div>
            
            <tbody>
            <a class="btn btn-info" href="<?php echo base_url('Backend/addNewProduk')?>" style="width:auto;" data-toggle="buttons"><i class="fas fa-plus"></i> Tambah Produk</a><br>
            <?php if(session()-> getFlashdata('pesan_edit')){ ?>
                          <div class="alert alert-success">
                              <?php echo session()->getFlashdata('pesan_edit') ?><br/>
                          </div>
                      <?php } ?>
            <?php if(session()-> getFlashdata('pesan')){ ?>
                          <div class="alert alert-success">
                              <?php echo session()->getFlashdata('pesan') ?>
                          </div>
                      <?php } ?>
             <?php $nomor=1; ?>
                <?php $nomor = ($pager->getCurrentPage() - 1) * $pager->getPerPage() + 1; ?>
                <?php foreach ($produk as $pr) : ?>
                    <tr class="text-center">
                    <td><?= $nomor++; ?></td>
                    <td><img src="<?= base_url('produk foto/' . $pr->foto_produk); ?>" alt="" class="foto_produk" style="width:100px; height:100px;"></td>
                    <td><?= $pr->nama_produk; ?></td>
                    <td><?= $pr->stok_produk; ?></td>
                    <td>Rp. <?= $pr->harga_produk; ?></td>
                    <td>
                       <div class="btn mb-1">
                            <a href="/Backend/editProduk/<?= $pr->id_produk; ?>" class="btn btn-success" type="button"><i class="fas fa-edit"></i></a>
                            <!-- //Method spofing -->
                                <form action="/Backend/<?= $pr->id_produk; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data Secara Permanen?');"><i class="fas fa-trash-alt"></i></button>
                                </form>
                        </div>
                    </td>
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