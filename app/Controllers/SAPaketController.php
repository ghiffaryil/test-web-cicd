<?php

namespace App\Controllers;
use App\Models\Paket;
use App\Models\ModelOrganisasi;
use App\Models\ModelPengguna;

class SAPaketController extends BaseController
{
    public function __construct()
    {
        helper(['alert_helper']);
    }
    public function index()
    {
        $role =  $this->getRoleData();
        $Model = new Paket();
        $paket = $Model->get()->getResult();
        $ModelUser = new ModelPengguna();
        $ModelOrganisasi = new ModelOrganisasi();
        foreach ($paket as &$data) {
            $user = $ModelUser->find($data->id_pengguna); // Ganti 'role_id' dengan kolom yang menunjukkan ID role pada tabel data
            $organisasi = $ModelOrganisasi->where('organisasi_kode',$data->organisasi_kode)->first(); // Ganti 'role_id' dengan kolom yang menunjukkan ID role pada tabel data
            $data->id_pengguna = $user;
            $data->organisasi_kode = $organisasi; }
        return view('users/paket/index',['paket' => $paket,'role'=>$role]);
    }

    function simpan(){
        $data = [
            'id_pengguna' => session()->get('id_pengguna'),
            'organisasi_kode' => session()->get('organisasi_kode'),
            'judul_paket'  => $_POST['judul_paket'],
            'jenis_paket'  => $_POST['jenis_paket'],
            'deskripsi'  => $_POST['deskripsi_paket'],
            'harga'  => $_POST['harga'],
            'fasilitas'  => $_POST['fasilitas'],
            'kalimat_pada_tombol' => $_POST['kalimat_pada_tombol'],
            'waktu_simpan_data'=> date('y-m-d'),
            'status'=>$_POST['status']

                ];
        $Model = new Paket();
        $Model->save($data);
        set_notif('success','berhasil','berhasil tambah Paket');
        return redirect('user/paket');


    }

    function tambah() {
        return view('users/paket/tambah');
    }

    public function hapus($id)
    {
        $Model = new Paket();
        $paket = $Model->where('id_paket',$id)->delete();
        // Tampilkan pesan sukses atau lakukan redirect ke halaman lain
        set_notif('success','berhasil','berhasil hapus Paket');
        return redirect('user/paket');
    }

      public function edit($id)
    {
        $Model = new Paket();
        $paket = $Model->where('id_paket',$id)->first();
        return view('users/paket/edit',$paket);
    }

    function update(){
        $data = [
            'id_paket'  => $_POST['id'],
            'judul_paket'  => $_POST['judul_paket'],
            'jenis_paket'  => $_POST['jenis_paket'],
            'deskripsi'  => $_POST['deskripsi_paket'],
            'harga'  => $_POST['harga'],
            'fasilitas'  => $_POST['fasilitas'],
            'kalimat_pada_tombol' => $_POST['kalimat_pada_tombol'],
            'waktu_simpan_data'=> date('y-m-d'),
            'status'=>$_POST['status']

                ];
        $Model = new Paket();
        $Model->save($data);
        set_notif('success','berhasil','berhasil update Paket');
        return redirect('user/paket');


    }

}
