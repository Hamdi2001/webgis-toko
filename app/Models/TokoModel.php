<?php

namespace App\Models;

use CodeIgniter\Model;

class TokoModel extends Model
{
    protected $table      = 'toko_kelontong';
    protected $primaryKey = 'id_toko';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['foto_nib','foto_ktp','foto_kk','nib_toko','ktp_pemilik','kk_pemilik','jenis_usaha','jenis_usaha_omset','foto_toko','username_toko', 'password_toko', 'email_toko', 'nomor_telpon', 'nama_toko', 'alamat_toko','kecamatan_toko', 'lat_toko', 'lon_toko', 'status_toko'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPaginated($num, $keyword = ''){
        $builder = $this->builder();
        $builder->where('status_toko', '1');

        if (!empty($keyword)) {
            $builder->groupStart();
            $builder->like('nama_toko', $keyword);
            $builder->orLike('alamat_toko', $keyword);
            $builder->orLike('kecamatan_toko', $keyword);
            $builder->orLike('jenis_usaha', $keyword);
            $builder->orLike('jenis_usaha_omset', $keyword);
            $builder->groupEnd();
        }

        return $this->paginate($num);
    }

    public function getPaginatedadmin($num, $keyword = null){
        $builder = $this->builder();
        $builder->where('status_toko', '1');
        if ($keyword != '') {
            $builder->groupStart();
            $builder->like('nama_toko', $keyword);
            $builder->orLike('alamat_toko', $keyword);
            $builder->orLike('username_toko', $keyword);
            $builder->orLike('password_toko', $keyword);
            $builder->orLike('email_toko', $keyword);
            $builder->orLike('alamat_toko', $keyword);
            $builder->orLike('kecamatan_toko', $keyword);
            $builder->orLike('nib_toko', $keyword);
            $builder->orLike('ktp_pemilik', $keyword);
            $builder->orLike('kk_pemilik', $keyword);
            $builder->orLike('jenis_usaha', $keyword);
            $builder->orLike('jenis_usaha_omset', $keyword);
            $builder->groupEnd();
        }
        return[
            'title' => 'Daftar Toko',
            'toko' => $this->paginate($num),
            'pager' => $this->pager,
        ];
    }

    public function getPaginatedverif($num, $keyword = null){
        $builder = $this->builder();
        $builder->where('status_toko', '0');
        if ($keyword != '') {
            $builder->groupStart();
            $builder->like('nama_toko', $keyword);
            $builder->orLike('alamat_toko', $keyword);
            $builder->orLike('username_toko', $keyword);
            $builder->orLike('password_toko', $keyword);
            $builder->orLike('email_toko', $keyword);
            $builder->orLike('alamat_toko', $keyword);
            $builder->orLike('kecamatan_toko', $keyword);
            $builder->orLike('nib_toko', $keyword);
            $builder->orLike('ktp_pemilik', $keyword);
            $builder->orLike('kk_pemilik', $keyword);
            $builder->orLike('jenis_usaha', $keyword);
            $builder->orLike('jenis_usaha_omset', $keyword);
            $builder->groupEnd();
        }
        return[
            'title' => 'Data Toko Verifikasi',
            'toko' => $this->paginate($num),
            'pager' => $this->pager,
        ];
    }

    public function getPaginatedverifupdate($num, $keyword = null){
        $builder = $this->builder();
        $builder->where('status_toko', '2');
        if ($keyword != '') {
            $builder->groupStart();
            $builder->like('nama_toko', $keyword);
            $builder->orLike('alamat_toko', $keyword);
            $builder->orLike('username_toko', $keyword);
            $builder->orLike('password_toko', $keyword);
            $builder->orLike('email_toko', $keyword);
            $builder->orLike('alamat_toko', $keyword);
            $builder->orLike('kecamatan_toko', $keyword);
            $builder->orLike('nib_toko', $keyword);
            $builder->orLike('ktp_pemilik', $keyword);
            $builder->orLike('kk_pemilik', $keyword);
            $builder->orLike('jenis_usaha', $keyword);
            $builder->orLike('jenis_usaha_omset', $keyword);
            $builder->groupEnd();
        }
        return[
            'title' => 'Verifikasi Perubahan Lokasi',
            'toko' => $this->paginate($num),
            'pager' => $this->pager,
        ];
    }

    public function getAllData(){
        return $this->select('*')
            ->get()
            ->getResultArray();
    }

    public function getLoginData($Iduser){
        $builder = $this->db->table('toko_kelontong');
        $builder->select('*');
        $builder
        ->where('id_toko', $Iduser);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getTokoUser($Iduser){
        $builder = $this->db->table('toko_kelontong');
        $builder->select('*');
        $builder
        ->where('id_toko', $Iduser);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getToko($Iduser){
        $builder = $this->db->table('toko_kelontong');
        $builder->select('*');
        $builder
        ->where('id_toko', $Iduser);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getDetailToko($id_toko){
        $builder = $this->db->table('toko_kelontong');
        $builder->select('*');
        $builder
        ->where('id_toko', $id_toko);
        $query = $builder->get();
        return $query->getResult();
    }

    public function verifyToko($email){
        $builder = $this->db->table('toko_kelontong');
        $builder->select('*');
        $builder->where('email_toko', $email);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) 
        {
            return $result->getRowArray();

        }else {
            return false;
        }
    }

}