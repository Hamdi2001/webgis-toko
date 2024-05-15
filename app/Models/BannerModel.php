<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table      = 'banner_utama';
    protected $primaryKey = 'id_banner';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['gambar_banner','deskripsi_banner'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getBannerData(){
        return $this->select('*')
        ->orderBy('id_banner', 'DESC')
        ->get()
        ->getResultArray();
    }

    public function getBanner($id){
        $builder = $this->db->table('banner_utama');
        $builder->select('*');
        $builder
        ->where('id_banner', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

}


?>