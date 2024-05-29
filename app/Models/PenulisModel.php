<?php

namespace App\Models;

use CodeIgniter\Model;

class PenulisModel extends Model
{
    protected $table      = 'penulis';
    protected $primaryKey = 'id_penulis';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['nama_penulis','nomor_penulis','email_penulis'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAll(){
        return $this->table('penulis')
        ->select('*');
    }

    public function search($keyword){
        return $this->table('penulis')
        ->select('*')
        ->like('nama_penulis', $keyword)->orLike('nomor_penulis', $keyword)->orLike('email_penulis', $keyword);
    }

    public function getPenulisEdit($id_penulis_edit){
        $builder = $this->db->table('penulis');
        $builder->select('*');
        $builder->where('id_penulis', $id_penulis_edit);
        $query = $builder->get();
        return $query->getRowArray();
    }

}


?>