<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginAdminModel extends Model
{
    protected $table      = 'akun_admin';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['username_admin', 'password_admin', 'nama_admin', 'level'];

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

    public function getAll(){
        return $this->table('akun_admin')->where('level', '2')
        ->select('*');
    }

    public function search($keyword){
    return $this->table('akun_admin')
        ->select('*')
        ->groupStart() // Start grouping for the LIKE conditions
            ->like('nama_admin', $keyword)
            ->orLike('username_admin', $keyword)
            ->orLike('password_admin', $keyword)
        ->groupEnd() // End grouping for the LIKE conditions
        ->where('level', '2'); // Ensure that only level 2 accounts are included
    }

    public function getAdminEdit($id_admin_edit){
        $builder = $this->db->table('akun_admin');
        $builder->select('*');
        $builder->where('id', $id_admin_edit);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function getAdmin($Iduser){
        $builder = $this->db->table('akun_admin');
        $builder->select('*');
        $builder
        ->where('id', $Iduser);
        $query = $builder->get();
        return $query->getRowArray();
    }

}