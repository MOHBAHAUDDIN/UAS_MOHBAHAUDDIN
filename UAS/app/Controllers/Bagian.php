<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BagianModel;
class Bagian extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new BagianModel();
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
                'aktif' => '',
            ], 
            'bagian' => [
                'title' => 'Bagian',
                'link' => base_url().'/bagian',
                'icon' => 'fa-regular fa-address-card',
                'aktif' => 'active',
            ], 
        ];

        $this->rules = [
            'ID_BAGIAN' => [
                'rules'=>'required',
                'errors' =>[
                    'required' => 'Id tidak boleh kosong',
                ]
            ],
            'NAMA_BAGIAN' => [
                'rules'=>'required',
                'errors' =>[
                    'required' => 'Nama Bagian tidak boleh kosong',
                ]
            ],
        ];
    }
    public function index()
    {
        
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Bagian</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() .'">Beranda</a></li>
                                <li class="breadcrumb-item active">Bagian</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Bagian";

        $query = $this->pm->find();
        $data['data_bagian'] = $query;
        return view('bagian/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Bagian</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() .'">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url() .'">Bagian</a></li>
                                <li class="breadcrumb-item active">Tambah Bagian</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Bagian';
        $data['action'] = base_url().'/bagian/simpan';
        return view ('bagian/input',$data);
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
            return redirect()->to('bagian')->with('success','Data Berhasil disimpan');
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
            return redirect()->to('bagian')->with('success', 'Data bagian dengan kode '.$id.' berhasil dihapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('bagian')->with('error',$e->getMessage());
        }
              
    }

    
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
            <h1 class="m-0">Bagian</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="'. base_url() .'">Beranda</a></li>
                <li class="breadcrumb-item"><a href="'. base_url() .'/bagian">Bagian</a></li>
                <li class="breadcrumb-item active">Edit Bagian</li>
            </ol>
        </div>';
    $data['menu'] = $this->menu;
    $data['breadcrumb'] = $breadcrumb;
    $data['title_card'] = 'Edit Bagian';
    $data['action'] = base_url().'/bagian/update';

    $data['edit_data'] = $this->pm->find($id);
    return view ('bagian/input',$data);    
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
            return redirect()->to('bagian')->with('success', 'Data berhasil diupdate');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error',$e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
