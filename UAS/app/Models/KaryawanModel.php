<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'karyawan';
    protected $primaryKey       = 'ID_KARYAWAN';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['ID_KARYAWAN', 'NAMA', 'JENIS_KELAMIN', 'TELEPON','ALAMAT'];

    //tampil data//
    // public function AllData()
    // {
    //     return $this->db->table('karyawan')
    //     ->join('');
    //     ->Get()->getResultArray();
    // }
}
