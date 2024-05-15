<?php

namespace App\Controllers;

use App\Models\TokoModel;
use App\Models\ProdukModel;

class Backend extends BaseController
{
    protected $tokoModel, $produkModel, $session;

    public function __construct()
    {
       $this->tokoModel = new TokoModel(); 
       $this->produkModel = new ProdukModel();
       $this->session = \Config\Services::session();
       $pager = \Config\Services::pager();
    }

    public function index() 
    {
       return redirect()->to('/');
    }

    public function manage(){
        $userId = session()->get('user_id');

        $produkModel = new \App\Models\ProdukModel();  // Pastikan model ini ada dan diimport
        $tokoModel = new \App\Models\TokoModel();      // Pastikan model ini ada dan diimport

        $perPage = 10; // Jumlah item per halaman
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        $offset = ($currentPage - 1) * $perPage;

        $total = $produkModel->countProduk($userId);
        $produk = $produkModel->getProduk($userId, $perPage, $offset);

        $pager = \Config\Services::pager();
        $pager->makeLinks($currentPage, $perPage, $total, 'toko_pagination'); // Menggunakan template pager Bootstrap
            $data = [   
                'produk' => $produk,
                'pager' => $pager,
                'toko' => $tokoModel->getDetailToko($userId),
                'currentPage' => $currentPage // Sertakan currentPage dalam data yang dikirimkan ke view
            ];
     

        // $data['produk'] = $this->produkModel->getProdukUser($userId);
        return view('halaman_utama/kelola_toko', $data);
    }

    public function editProduk($id_produk_edit){
        $data = [
            'produk' => $this->produkModel->getProdukEdit($id_produk_edit)
        ];
        return view('halaman_utama/edit_produk', $data);
    }

    public function updateProduk($id_produk_edit){
        if (!$this->validate([
            'produk_foto' =>[
                'label' => 'Foto Produk',
                'rules' => 'permit_empty|mime_in[image/jpg,image/jpeg,image/png]',
                'errors' =>[
                    'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                ]
            ],  'nama_produk' =>[
                'label' => 'Nama Produk',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong' 
                ]
            ],  'harga_produk' =>[
                'label' => 'Harga Produk',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong' 
                ]
            ],  'stok_produk' =>[
                'label' => 'Stok Produk',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong' 
                ]
            ]
        ])){
            return redirect()->to('/Backend/editProduk/' . $this->request->getVar('id_produk'))->withInput();
        }
        

        $fileFoto = $this->request->getFile('produk_foto');
        
        //cek gambar, berubah atau tidak
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('foto_lama');
        }else{
            //generate nama file random
            $namaFoto = $fileFoto->getRandomName();
            //upload gambar
            $fotolama = $this->request->getVar('foto_lama');
            
            if ($fotolama == "") {
                //upload gambar
                $fileFoto->move('produk foto', $namaFoto);
            }else {
                //upload gambar
                $fileFoto->move('produk foto', $namaFoto);
                //hapus file lama
                unlink('produk foto/'.$fotolama);
            }
        }
        $this->produkModel->save([
                'foto_produk' => $namaFoto,
                'id_produk' => $id_produk_edit,
                'nama_produk' => $this->request->getVar('nama_produk'),
                'harga_produk' => $this->request->getVar('harga_produk'),
                'stok_produk' => $this->request->getVar('stok_produk'),
            ]);
        session()->setFlashdata('pesan_edit', 'Anda Berhasil Edit Produk');
        return redirect()->to('/Backend/manage');

    }

    public function detailToko($id_detail_toko){

        $produkModel = new \App\Models\ProdukModel();  // Pastikan model ini ada dan diimport
        $tokoModel = new \App\Models\TokoModel();      // Pastikan model ini ada dan diimport

        $perPage = 10; // Jumlah item per halaman
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        $offset = ($currentPage - 1) * $perPage;

        $total = $produkModel->countProduk($id_detail_toko);
        $produk = $produkModel->getProduk($id_detail_toko, $perPage, $offset);

        $pager = \Config\Services::pager();
        $pager->makeLinks($currentPage, $perPage, $total, 'toko_pagination'); // Menggunakan template pager Bootstrap
            $data_produk = [   
                'title' => 'Daftar Produk',
                'produk' => $produk,
                'pager' => $pager,
                'toko' => $tokoModel->getDetailToko($id_detail_toko),
                'currentPage' => $currentPage // Sertakan currentPage dalam data yang dikirimkan ke view
            ];
     
        return view('halaman_utama/detail_toko', $data_produk);
    }

    public function addNewProduk()
    {
        return view('halaman_utama/tambah_produk');
    }

    public function dataToko(){
        $userId = session()->get('user_id');
        
        if ($this->validate([
            'produk_foto' =>[
                'label' => 'Foto Produk',
                'rules' => 'uploaded[produk_foto]|mime_in[produk_foto,image/jpg,image/jpeg,image/png]',
                'errors' =>[
                    'uploaded' => '{field} Tidak Boleh Kosong',
                    'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                ]
            ],  'nama_produk' =>[
                'label' => 'Nama Produk',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong' 
                ]
            ],  'harga_produk' =>[
                'label' => 'Harga Produk',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong' 
                ]
            ],  'stok_produk' =>[
                'label' => 'Stok Produk',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong' 
                ]
            ]
        ])){
            $foto_produk = $this->request->getFile('produk_foto');
            $nama_foto_produk = $foto_produk->getRandomName();
            $this->produkModel->save([
                'foto_produk' => $nama_foto_produk,
                'nama_produk' => $this->request->getPost('nama_produk'),
                'harga_produk' => $this->request->getPost('harga_produk'),
                'stok_produk' => $this->request->getPost('stok_produk'),
                'id_toko' => $userId
            ]);
            $foto_produk->move('produk foto', $nama_foto_produk);
            session()->setFlashdata('pesan', 'Anda Berhasil Menambah Produk');
            return redirect()->to('/Backend/manage');

        }else{
            return redirect()->to('/Backend/addNewProduk')->withInput();
        }
    }

    public function deleteProduk($id_produk){
        $produk = new ProdukModel();

        $data = $produk->find($id_produk);
        $foto_hapus = $data['foto_produk'];
        if (file_exists("produk foto/" .$foto_hapus)) {
            unlink("produk foto/" .$foto_hapus);
        }
        $produk->delete($id_produk);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/Backend/manage');
    }

    public function viewMap(){
        $keyword = $this->request->getGet('keyword');
        $data = $this->tokoModel->getPaginated(5, $keyword);

        // $currentPage = $this->request->getVar('page_toko_kelontong') ? $this->request->getVar('page_toko_kelontong') : 1;

        // $keyword = $this->request->getVar('keyword');
        // if($keyword){
        //     $toko = $this->tokoModel->searchutama($keyword);
        // }else{
        //     $toko = $this->tokoModel;
        // }

        // $map_view = $toko
        //     ->where('status_toko', '1') // Filter data dengan status
        //     ->paginate(5, 'toko_kelontong');
        //     $data_map = [   
        //         'location' => $map_view,
        //         'pager' => $this->tokoModel->pager,
        //         'currentPage' => $currentPage,
        //     ];
        return view('halaman_utama/tampilan_map', $data);
    }

    public function editProfil($user_id){
        $data = [
            'toko' => $this->tokoModel->getToko($user_id)
        ];
        
        return view('halaman_utama/edit_profil', $data);
    }

    public function updateProfil($user_id){
        $tokoLama = $this->tokoModel->getToko($this->request->getVar('id_toko'));
        //cek username 
        if ($tokoLama['username_toko'] == $this->request->getVar('username_toko')) {
            $rule_username = 'required';
        }else{
            $rule_username = 'required|is_unique[toko_kelontong.username_toko]';
        }
        //cek password
        if ($tokoLama['password_toko'] == $this->request->getVar('password_toko')) {
            $rule_password = 'required|alpha_numeric|min_length[8]|max_length[12]';
        }else{
            $rule_password = 'required|alpha_numeric|min_length[8]|max_length[12]|is_unique[toko_kelontong.password_toko]';
        }
        //cek email 
        if ($tokoLama['email_toko'] == $this->request->getVar('toko_email')) {
            $rule_email = 'permit_empty|valid_email';
        }else{
            $rule_email = 'permit_empty|valid_email|is_unique[toko_kelontong.email_toko]';
        }
        //cek nomor telpon 
        if ($tokoLama['nomor_telpon'] == $this->request->getVar('nomor_telpon')) {
            $rule_nomor = 'required|numeric|min_length[11]|max_length[12]';
        }else{
            $rule_nomor = 'required|numeric|min_length[11]|max_length[12]|is_unique[toko_kelontong.nomor_telpon]';
        }
        //cek nama toko
        if ($tokoLama['nama_toko'] == $this->request->getVar('nama_toko')) {
            $rule_nama = 'required';
        }else{
            $rule_nama = 'required|is_unique[toko_kelontong.nama_toko]';
        }

        if (!$this->validate([
            'foto_toko' =>[
                'label' => 'Foto Toko',
                'rules' => 'permit_empty|mime_in[image/jpg,image/jpeg,image/png]',
                'errors' =>[
                    'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                ]
            ],  
           'username_toko' =>[
                'label' => 'Username',
                'rules' => $rule_username,
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Didaftarkan'
                ]
            ],
            'password_toko' =>[
                'label' => 'Password',
                'rules' => $rule_password,
                'errors' =>[
                    'min_length' => '{field} Tidak Boleh Kurang Dari Delapan',
                    'max_length' => '{field} Tidak Boleh Lebih Daru Duabelas',
                    'alpha_numeric' => '{field} Harus Terdapat Angka dan Huruf',
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Didaftarkan' 
                ]
            ],'jenis_usaha' =>[
                'label' => 'Jenis Usaha',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong' 
                ]
            ],'jenis_usaha_omset' =>[
                'label' => 'Omset',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong' 
                ]
            ],'toko_email' =>[
                'label' => 'Email',
                'rules' => $rule_email,
                'errors' =>[
                    'valid_email' => '{field} Harus Sesuai',
                    'is_unique' => '{field} Sudah Didaftarkan'
                ]
            ],  'nomor_telpon' =>[
                'label' => 'Nomor',
                'rules' => $rule_nomor,
                'errors' =>[
                    'numeric' => '{field} Hanya Bisa Menggunakan Angka',
                    'required' => '{field} Tidak Boleh Kosong',
                    'min_length' => '{field} Tidak Boleh Kurang Dari Sebelas',
                    'max_length' => '{field} Tidak Boleh Lebih Dari Duabelas',
                    'is_unique' => '{field} Sudah Didaftarkan'
                ]
            ],  'nama_toko' =>[
                'label' => 'Nama Toko',
                'rules' => $rule_nama,
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Didaftarkan'
                ]
            ],  'alamat_toko' =>[
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong' 
                ]
            ]
        ])) {
            return redirect()->to('/Backend/editProfil/' . $this->request->getVar('id_toko'))->withInput();
        }

        $fileFoto = $this->request->getFile('foto_toko');

        //cek gambar, berubah atau tidak
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('foto_lama');
        }else{
            //generate nama file random
            $namaFoto = $fileFoto->getRandomName();
            $fotolama = $this->request->getVar('foto_lama');
            
            if ($fotolama == "") {
                //upload gambar
                $fileFoto->move('img', $namaFoto);
            }else {
                //upload gambar
                $fileFoto->move('img', $namaFoto);
                //hapus file lama
                unlink('img/'.$fotolama);
            }
        }
        $this->tokoModel->save([
                'id_toko' => $user_id,
                'foto_toko' => $namaFoto,
                'username_toko' => $this->request->getVar('username_toko'),
                'password_toko' => $this->request->getVar('password_toko'),
                'email_toko' => $this->request->getVar('toko_email'),
                'nomor_telpon' => $this->request->getVar('nomor_telpon'),
                'jenis_usaha' => $this->request->getVar('jenis_usaha'),
                'jenis_usaha_omset' => $this->request->getVar('jenis_usaha_omset'),
                'nama_toko' => $this->request->getVar('nama_toko'),
                'alamat_toko' => $this->request->getVar('alamat_toko')
            ]);
            $this->session->set([
                'nama_toko' => $this->request->getVar('nama_toko'),
                'foto_toko'=> $namaFoto,
                'nomor_telepon' => $this->request->getVar('nomor_telpon'),
                'alamat_toko' => $this->request->getVar('alamat_toko')
            ]);
            session()->setFlashdata('pesan', 'Anda Berhasil Mengubah Profil');
            return redirect()->to('/Backend/manage');
    }

    public function editLokasi($user_id){
        $data = [
            'toko' => $this->tokoModel->getToko($user_id)
        ];
        
        return view('halaman_utama/edit_lokasi', $data);
    }

    public function updateLokasi($user_id){
        if (!$this->validate([
            'latitude' =>[
                'label' => 'Latitude',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong' 
                ]
            ],  'longitude' =>[
                'label' => 'Longitude',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong' 
                ]
            ]
        ])) {
           return redirect()->to('/Backend/editLokasi/' . $this->request->getVar('id_toko'))->withInput();
        }
        
        $this->tokoModel->save([
                'id_toko' => $user_id,
                'lat_toko' => $this->request->getVar('latitude'),
                'lon_toko' => $this->request->getVar('longitude'),
                'status_toko' => '2',
            ]);

            session()->remove('id_toko');
            session()->remove('username_toko');
            session()->remove('nama_toko');
            session()->remove('foto_toko');
            session()->remove('alamat_toko');
            session()->remove('email_toko');
            session()->remove('nomor_telepon');
            session()->remove('kecamatan');
            session()->remove('status_toko');
            session()->remove('logged_in');

            session()->setFlashdata('pesan_lokasi', 'Anda Berhasil Ubah Lokasi Silahkan Login Kembali');
            return redirect()->to('login');
    }

}
