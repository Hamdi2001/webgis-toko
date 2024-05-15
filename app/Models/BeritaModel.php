<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table      = 'berita';
    protected $primaryKey = 'id_berita';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['judul_berita','slug_berita','isi_berita','penulis_berita','gambar_berita'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function search($keyword){
        return $this->table('berita')->like('judul_berita', $keyword)->orLike('slug_berita', $keyword);
    }

    public function getBeritaData($slug = false){
        if($slug == false){
            return $this->orderBy('created_at', 'DESC')->findAll(4);
        }

        return $this->where(['slug_berita' => $slug])->first();
    }

    public function getBeritaEdit($id_berita_edit){
        $builder = $this->db->table('berita');
        $builder->select('*');
        $builder
        ->where('id_berita', $id_berita_edit);
        $query = $builder->get();
        return $query->getRowArray();
    }



}


?>