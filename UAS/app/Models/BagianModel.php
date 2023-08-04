<?php

namespace App\Models;

use CodeIgniter\Model;

class BagianModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bagian';
    protected $primaryKey       = 'ID_BAGIAN';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['ID_BAGIAN','NAMA_BAGIAN'];
}
