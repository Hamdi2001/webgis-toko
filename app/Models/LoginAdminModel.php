<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginAdminModel extends Model
{
    protected $table      = 'akun_admin';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['username_admin', 'password_admin', 'nama_admin'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function getAdminUpdate($id){
        $builder = $this->db->table('akun_admin');
        $builder->select('*');
        $builder
        ->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }

}