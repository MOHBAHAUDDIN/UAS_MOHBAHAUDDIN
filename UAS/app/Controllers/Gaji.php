<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GajiModel;
class Gaji extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new GajiModel();
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
                'aktif' => '',
            ], 
            'gaji' => [
                'title' => 'Data Gaji',
                'link' => base_url().'/gaji',
                'icon' => 'fa-solid fa-hand-holding-dollar',
                'aktif' => 'active',
            ], 
            'bagian' => [
                'title' => 'Bagian',
                'link' => base_url().'/bagian',
                'icon' => 'fa-regular fa-address-card',
                'aktif' => '',
            ], 
        ];

        $this->rules = [
            'ID_GAJI' => [
                'rules'=>'required',
                'errors' =>[
                    'required' => 'Id tidak boleh kosong',
                ]
            ],
            'GAJI_POKOK' => [
                'rules'=>'required',
                'errors' =>[
                    'required' => 'Gaji tidak boleh kosong',
                ]
            ],
            'TUNJANGAN' => [
                'rules'=>'required',
                'errors' =>[
                    'required' => 'Gaji Tunjangan tidak boleh kosong',
                ]
            ],
        ];
    }
    public function index()
    {
        
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Gaji</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() .'">Beranda</a></li>
                                <li class="breadcrumb-item active">Gaji</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Gaji";

        $query = $this->pm->find();
        $data['data_gaji'] = $query;
        return view('gaji/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Gaji</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url() .'">Gaji</a></li>
                                <li class="breadcrumb-item active">Tambah Gaji</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Gaji';
        $data['action'] = base_url().'/gaji/simpan';
        return view ('gaji/input',$data);
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
            return redirect()->to('gaji')->with('success','Data Berhasil disimpan');
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
            return redirect()->to('gaji')->with('success', 'Data gaji dengan kode '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('gaji')->with('error',$e->getMessage());
        }
              
    }

    
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
            <h1 class="m-0">Gaji</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="'. base_url() .'">Beranda</a></li>
                <li class="breadcrumb-item"><a href="'. base_url() .'/gaji">Gaji</a></li>
                <li class="breadcrumb-item active">Edit Gaji</li>
            </ol>
        </div>';
    $data['menu'] = $this->menu;
    $data['breadcrumb'] = $breadcrumb;
    $data['title_card'] = 'Edit Gaji';
    $data['action'] = base_url().'/gaji/update';

    $data['edit_data'] = $this->pm->find($id);
    return view ('gaji/input',$data);    
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
            return redirect()->to('gaji')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error',$e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
