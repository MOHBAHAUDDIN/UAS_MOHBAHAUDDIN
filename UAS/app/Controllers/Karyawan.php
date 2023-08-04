<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;
class Karyawan extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new KaryawanModel();
        $this->menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa fa-house',
                'aktif' => '',
            ],
            'karyawan' => [
                'title' => 'Data Karyawan',
                'link' => base_url().'/karyawan',
                'icon' => 'fa-solid fa-users-line',
                'aktif' => 'active',
            ], 
            'gaji' => [
                'title' => 'Data Gaji',
                'link' => base_url().'/gaji',
                'icon' => 'fa-solid fa-hand-holding-dollar',
                'aktif' => '',
            ], 
            'bagian' => [
                'title' => 'Bagian',
                'link' => base_url().'/bagian',
                'icon' => 'fa-regular fa-address-card',
                'aktif' => '',
            ], 
        ];

        $this->rules = [
            'ID_KARYAWAN' => [
                'rules'=>'required',
                'errors' =>[
                    'required' => 'Id tidak boleh kosong',
                ]
            ],
            'NAMA' => [
                'rules'=>'required',
                'errors' =>[
                    'required' => 'Nama tidak boleh kosong',
                ]
            ],
            'JENIS_KELAMIN' => [
                'rules'=>'required',
                'errors' =>[
                    'required' => 'Jenis Kelamin tidak boleh kosong',
                ]
            ],
            'TELEPON' => [
                'rules'=>'required',
                'errors' =>[
                    'required' => 'No Telephone tidak boleh kosong',
                ]
            ],
            'ALAMAT' => [
                'rules'=>'required',
                'errors' =>[
                    'required' => 'Alamat tidak boleh kosong',
                ]
            ],
        ];
    }
    public function index()
    {
        
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() .'">Beranda</a></li>
                                <li class="breadcrumb-item active">Karyawan</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Karyawan";

        $query = $this->pm->find();
        $data['data_karyawan'] = $query;
        return view('karyawan/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url() .'/karyawan">Karyawan</a></li>
                                <li class="breadcrumb-item active">Tambah Karyawan</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Karyawan';
        $data['action'] = base_url().'/karyawan/simpan';
        return view ('karyawan/input',$data);
    }

    public function simpan()
    {

        if (strtolower($this->request->getMethod()) !== 'post') {
               
            return redirect()->back()->withInput();
        }

        if (!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }


        $dt = $this->request->getPost();
        try {
            $simpan = $this->pm->insert($dt);
            return redirect()->to('karyawan')->with('success','Data Berhasil disimpan');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function hapus($id){
        if (empty($id)){
            return redirect()->back()->with('error', 'Hapus data gagal dilakukan');
        }
        try {
            $this->pm->delete($id);  
            return redirect()->to('karyawan')->with('success', 'Data karyawan dengan kode '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('karyawan')->with('error',$e->getMessage());
        }
              
    }

    
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
            <h1 class="m-0">Karyawan</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="'. base_url() .'">Beranda</a></li>
                <li class="breadcrumb-item"><a href="'. base_url() .'/karyawan">Karyawan</a></li>
                <li class="breadcrumb-item active">Edit Karyawan</li>
            </ol>
        </div>';
    $data['menu'] = $this->menu;
    $data['breadcrumb'] = $breadcrumb;
    $data['title_card'] = 'Edit Karyawan';
    $data['action'] = base_url().'/karyawan/update';

    $data['edit_data'] = $this->pm->find($id);
    return view ('karyawan/input',$data);    
    }

    public function update(){
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);

        if (!$this->validate($this->rules)) {

            return redirect()->back()->withInput();
        }

        try {
            $this->pm->update($param, $dtEdit);
            return redirect()->to('karyawan')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error',$e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
