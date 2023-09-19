<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginAdminModel extends Model
{
    protected $table      = 'akun_admin';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['username_admin', 'password_admin', 'nama_admin'];

}