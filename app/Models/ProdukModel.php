<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk_toko';
    protected $primaryKey = 'id_produk';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['foto_produk', 'nama_produk', 'harga_produk', 'stok_produk', 'id_toko'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    //Fungsi Join
    // public function getAll(){
    //     $builder = $this->db->table('produk_toko');
    //     $builder->select('*');
    //     $builder->join('toko_kelontong', 'toko_kelontong.id_toko = produk_toko.id_produk');
    //     $query = $builder->get();
    //     return $query->getResult();
    // }

    public function getAllData(){
        return $this->select('*')
            ->get()
            ->getResultArray();
    }

    public function getProduk($id_toko, $perPage, $offset){
        $builder = $this->db->table('produk_toko');
        $builder->select('*');
        $builder->join('toko_kelontong', 'toko_kelontong.id_toko = produk_toko.id_toko');
        $builder->where('produk_toko.id_toko', $id_toko);
        $builder->limit($perPage, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

    public function countProduk($id_toko)  {
        return $this->where('id_toko', $id_toko)->countAllResults();
    }

    public function getProdukUser($userId){
        $builder = $this->db->table('produk_toko');
        $builder->select('*');
        $builder
        ->join('toko_kelontong', 'toko_kelontong.id_toko = produk_toko.id_toko')
        ->where('produk_toko.id_toko', $userId);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getProdukEdit($id_produk_edit){
        $builder = $this->db->table('produk_toko');
        $builder->select('*');
        $builder
        ->join('toko_kelontong', 'toko_kelontong.id_toko = produk_toko.id_toko')
        ->where('produk_toko.id_produk', $id_produk_edit);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getProdukHapus($id){
        $builder = $this->db->table('produk_toko');
        $builder->select('*');
        $builder
        ->join('toko_kelontong', 'toko_kelontong.id_toko = produk_toko.id_toko');
        $builder->where('produk_toko.id_toko', $id);
        return $builder->delete();
    }

    
}