<?php

namespace App\Models;

use CodeIgniter\Model;

class TokoModel extends Model
{
    protected $table      = 'toko_kelontong';
    protected $primaryKey = 'id_toko';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}