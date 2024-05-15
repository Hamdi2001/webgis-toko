<style>
    table, td, th{
        border: 1px solid #333;
    }
    table{
        width: 100%;
        border-collapse: collapse;
    }
    td, th{
        padding: 2px;
    }
    th{
        background-color: #CCC;
    }

    @page{
        margin: 10px;
    }

</style>
<h1>Data Toko</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor NIB</th>
            <th>Nomor KTP</th>
            <th>Nomor Kartu Keluarga</th>
            <th>Nama Toko</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Nomor Hp</th>
            <th>Kecamatan</th>
            <th>Jenis Usaha</th>
            <th>Kategori Usaha</th>
            <th>Username</th>
            <th>Password</th>
            <th>Latitude</th>
            <th>Longitude</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $nomor = 1;
            foreach ($toko as $tk) {
        ?>
            <tr class="text-center">
                <td><?php echo $nomor ?></td>
                <td><?php echo $tk['nib_toko'] ?></td>
                <td><?php echo $tk['ktp_pemilik'] ?></td>
                <td><?php echo $tk['kk_pemilik'] ?></td>
                <td><?php echo $tk['nama_toko'] ?></td>
                <td><?php echo $tk['alamat_toko'] ?></td>
                <td><?php echo $tk['email_toko'] ?></td>
                <td><?php echo $tk['nomor_telpon'] ?></td>
                <td><?php echo $tk['jenis_usaha'] ?></td>
                <td><?php echo $tk['jenis_usaha_omset'] ?></td>
                <td><?php echo $tk['kecamatan_toko'] ?></td>
                <td><?php echo $tk['username_toko'] ?></td>
                <td><?php echo $tk['password_toko'] ?></td>
                <td><?php echo $tk['lat_toko'] ?></td>
                <td><?php echo $tk['lon_toko'] ?></td>
            </tr>
        <?php  
            $nomor++;
        }
        ?>
    </tbody>
</table>