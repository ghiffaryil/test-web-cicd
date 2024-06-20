<?php

namespace App\Controllers;
use App\Models\KerjasamaClient;
use App\Models\ModelPengguna;
use App\Models\ModelOrganisasi;

class KerjasamaController extends BaseController
{
    public function __construct()
    {
        helper(['alert_helper']);
    }
    public function index()
    {
        
        $role = $this->getRoleData();
        $Model = new KerjasamaClient();

        if(session()->get('role_baku') == 1){ 
     $kerjasama =  $Model->get()->getResult();

 }elseif(session()->get('role_baku') == 2){ 

     $kerjasama =  $Model->get()->getResult();

 }else{ 
     $kerjasama =  $Model->where('organisasi_kode',session()->get('organisasi_kode'))->get()->getResult();

 } 
        return view('users/kerjasama-client/index',['kerjasama' => $kerjasama,'role'=>$role]);
    }

    function simpan(){
           if(session()->get('role_baku') == 1 || session()->get('role_baku') == 2){
              $modelPengguna = new ModelPengguna;
        $pengguna = $modelPengguna->where('organisasi_kode',$_POST['organisasi_kode'])->first();
        $pengguna = $pengguna['id_pengguna'];
        $organisasinya = $_POST['organisasi_kode'];
    }else{
        $pengguna = session()->get('id_pengguna');
        $organisasinya = session()->get('organisasi_kode');
    }
         $rules = [
                'nama_client' => 'required',
                'logo_client' => 'uploaded[logo_client]|max_size[logo_client,1024]|mime_in[logo_client,image/png,image/jpg,image/jpeg]',
            ];

            if ($this->validate($rules)) {
                // Ambil data dari form
                $namaClient = $this->request->getPost('nama_client');
                $logoClient = $this->request->getFile('logo_client');
                $status = $this->request->getPost('status');
                $name = $logoClient->getName();
                 $logoClient->move('uploads/client', $name);

                // Simpan data ke database menggunakan model
                $kerjasamaClientModel = new KerjasamaClient();
                $kerjasamaClientModel->save([
                    'nama_client' => $namaClient,
                    'logo_client' => $name,
                    'organisasi_kode' => $organisasinya,
                    'status' => $status,
                ]);
          
                  set_notif('success','berhasil','berhasil tambah client work');
                   if(session()->get('role_baku') == 1){ 

     return redirect('superadmin/kerjasama-client');

 }elseif(session()->get('role_baku') == 2){ 

     return redirect('admin/kerjasama-client');

 }else{ 

     return redirect('user/kerjasama-client');
 } 

            } else {
                // Jika validasi gagal, kirim pesan error
            }
      


    }

    function tambah() {
         $ModelOrganisasi = new ModelOrganisasi;
        $data1 = $ModelOrganisasi->findAll();

        return view('users/kerjasama-client/tambah',['data1'=>$data1]);
    }

    public function hapus($id)
    {
        $Model = new KerjasamaClient();
        $kerjasama = $Model->where('id_kerjasama_client',$id)->delete();
        // Tampilkan pesan sukses atau lakukan redirect ke halaman lain
        set_notif('success','berhasil','berhasil hapus client work');
         if(session()->get('role_baku') == 1){ 

     return redirect('superadmin/kerjasama-client');

 }elseif(session()->get('role_baku') == 2){ 

     return redirect('admin/kerjasama-client');

 }else{ 

     return redirect('user/kerjasama-client');
 } 
    }

      public function edit($id)
    {
        $Model = new KerjasamaClient();
        $kerjasama = $Model->where('id_kerjasama_client',$id)->first();
        return view('users/kerjasama-client/edit',$kerjasama);
    }

    function update(){
        $logoClient = $this->request->getFile('logo_client');
        $id = $this->request->getPost('id');

        if($logoClient->isValid())
        {   

                $namaClient = $this->request->getPost('nama_client');
                $status = $this->request->getPost('status');
                
                $name = $logoClient->getName();
                 $logoClient->move('uploads/client', $name);
                
                // Simpan data ke database menggunakan model
                $kerjasamaClientModel = new KerjasamaClient();
                $kerjasamaClientModel->save([
                    'id_kerjasama_client' => $id,
                    'nama_client' => $namaClient,
                    'logo_client' => $name,
                    'status' => $status,
                ]);
                
            

        }
        else{
                $namaClient = $this->request->getPost('nama_client');
                $status = $this->request->getPost('status');

                // Simpan data ke database menggunakan model
                $kerjasamaClientModel = new KerjasamaClient();
                $kerjasamaClientModel->save([
                    'id_kerjasama_client' => $id,
                    'nama_client' => $namaClient,
                    'status' => $status,
                ]);
        }
    
        set_notif('success','berhasil','berhasil edit data client work');
                         if(session()->get('role_baku') == 1){ 

     return redirect('superadmin/kerjasama-client');

 }elseif(session()->get('role_baku') == 2){ 

     return redirect('admin/kerjasama-client');

 }else{ 

     return redirect('user/kerjasama-client');
 } 


    }

}
