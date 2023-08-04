<?php

namespace App\Models;

use CodeIgniter\Model;

class GajiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'gaji';
    protected $primaryKey       = 'ID_GAJI';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['ID_GAJI','GAJI_POKOK','TUNJANGAN'];
}
