<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa fa-house',
                'aktif' => 'active',
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
                'aktif' => '',
            ], 
        ];
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Beranda</li>
                            </ol>
                        </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Welcome To My Site!";
        $data['selamat_datang'] = "Selamat Datang Di Aplikasi Sederhana";
        return view('template/content', $data);
    }
}
