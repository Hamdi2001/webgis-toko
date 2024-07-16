<?php

namespace App\Controllers;

use App\Models\BannerModel;
use App\Models\TokoModel;
use App\Models\ProdukModel;
use App\Models\BeritaModel;
use App\Models\LoginAdminModel;
use App\Models\PenulisModel;

class Pages extends BaseController
{
    protected $session, $bannerModel, $tokoModel, $produkModel, $beritaModel, $penulisModel, $loginadminModel;

    public function __construct()
    {
        $this->loginadminModel = new LoginAdminModel();
        $this->bannerModel = new BannerModel(); 
        $this->tokoModel = new TokoModel(); 
        $this->produkModel = new ProdukModel();
        $this->beritaModel = new BeritaModel();
        $this->penulisModel = new PenulisModel();
        $this->session = \Config\Services::session();

    }
    
    public function index()
    {
        if(session()->get('level') <> 1){
            return redirect()->to("/admin");

        }else{
            $daerah = $this->tokoModel->select('COUNT(toko_kelontong.kecamatan_toko) AS jumlah, toko_kelontong.kecamatan_toko AS kec')
            ->where('status_toko', '1')
            ->groupBy('toko_kelontong.kecamatan_toko')
            ->get();

            $tahun = $this->tokoModel->getYearData();

            $data = [
            'title' => 'Home | Webgis',
            'toko' => $this->tokoModel->where('status_toko', '1')->countAllResults(),
            'toko_verif' => $this->tokoModel->where('status_toko', '0')->countAllResults(),
            'toko_update' => $this->tokoModel->where('status_toko', '2')->countAllResults(),
            'daerah' => $daerah,
            'tahun' => $tahun,
            'berita' => $this->beritaModel->countAllResults(),
            'produk' => $this->produkModel->countAllResults(),
            'penulis' => $this->penulisModel->countAllResults(),
            ];

            return view('admin_pages/home', $data); 
        }
         
    }

    public function dataBanner(){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
            $banner = $this->bannerModel->getBannerData();
            $totalBanners = count($banner);

            $data_banner = [
                'title' => 'Daftar Banner Halaman Depan',
                'banner' => $banner,
                'totalbanner' => $totalBanners,
            ];

            return view('admin_pages/banner/banner', $data_banner); 
        }
    }

    
    public function addToko(){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
             $data_tambah = [
                'title' => 'Tambah Toko Baru',
            ];
            return view('admin_pages/toko/add_toko', $data_tambah);
        }
    }

    public function addBanner(){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
             $data_tambah = [
                'title' => 'Tambah Banner Baru',
            ];
            return view('admin_pages/banner/add_banner', $data_tambah);
        }
    }

    public function addBannerBaru(){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");
       }else{
         if ($this->validate([
           'foto_banner' =>[
                'label' => 'Foto Banner',
                'rules' => 'uploaded[foto_banner]|mime_in[foto_banner,image/jpg,image/jpeg,image/png]',
                'errors' =>[
                    'uploaded' => '{field} Tidak Boleh Kosong',
                    'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG',
                ]
            ], 'deskripsi_banner' =>[
                'label' => 'Deskripsi',
                'rules' => 'required',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong',
                ]
            ]
        ])){
            
            $foto_banner = $this->request->getFile('foto_banner');
            $nama_foto_banner = $foto_banner->getRandomName();

            $this->bannerModel->save([
                'gambar_banner' => $nama_foto_banner,
                'deskripsi_banner' => $this->request->getPost('deskripsi_banner'),
                'id' => $this->request->getPost('id')
            ]);
           
            $foto_banner->move('banner', $nama_foto_banner);

            session()->setFlashdata('pesan_berhasil', 'Anda Berhasil Menambah Banner');
            return redirect()->to('/Pages/dataBanner');

        }else{
            return redirect()->to('/Pages/addBanner')->withInput();
        }
       }
       
    }

    public function editBanner($id_banner){
        if (session()->get('level') <> 2) {
            return redirect()->to("/admin");
        }else{
            $data = [
                'title' =>  'Ubah Banner',
                'banner' => $this->bannerModel->getBanner($id_banner)
            ];
            
            return view('/admin_pages/banner/edit_banner', $data);
        }
    }

    public function updateBanner($id_banner){
        if (session()->get('level') <> 2) {
            return redirect()->to("/admin");
        }else{
             if (!$this->validate([
            'foto_banner' => [
                'label' => 'Foto Banner',
                'rules' => 'permit_empty|mime_in[foto_banner,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                ]
            ],
            'deskripsi_banner' => [
                'label' => 'Deskrips',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                ]
            ]
        ])) {
            return redirect()->to('/Pages/editBanner/' . $this->request->getVar('id_banner'))->withInput();
        }

        $fileFoto = $this->request->getFile('foto_banner');

        if ($fileFoto->getError() == 4) {
            // Tidak ada file baru yang diupload, gunakan foto lama
            $namaFoto = $this->request->getVar('foto_banner_lama');
        } else {
            // Generate nama file random
            $namaFoto = $fileFoto->getRandomName();

            // Upload gambar baru
            $fileFoto->move('banner', $namaFoto);

            // Hapus file lama jika ada
            $fotoLama = $this->request->getVar('foto_banner_lama');
            if ($fotoLama) {
                if (file_exists('banner/' . $fotoLama)) {
                    unlink('banner/' . $fotoLama);
                }
            }
        }

        $this->bannerModel->save([
            'id_banner' => $this->request->getVar('id_banner'),
            'gambar_banner' => $namaFoto,
            'deskripsi_banner' => $this->request->getVar('deskripsi_banner')
        ]);

        session()->setFlashdata('pesan_edit', 'Anda Berhasil Mengubah Banner');
        return redirect()->to('/Pages/dataBanner');
        }
    }

    public function deleteBanner($id){
        if (session()->get('level') <> 2) {
            return redirect()->to("/admin");
        }else{
            $banner = new BannerModel();

            $data = $banner->find($id);
            $foto_hapus = $data['gambar_banner'];
            if (file_exists("banner/" .$foto_hapus)) {
                unlink("banner/" .$foto_hapus);
            }
            $banner->delete($id);
            session()->setFlashdata('pesan_hapus', 'Data Banner Berhasil Dihapus');
            return redirect()->to('/Pages/dataBanner');
        }
    }

    public function editProduk($id_produk_edit){
        if (session()->get('level') <> 2) {
            return redirect()->to("/admin");
        }else{
            $data = [
                'title' =>  'Ubah Produk',
                'produk' => $this->produkModel->getProdukEdit($id_produk_edit)
            ];
            
            return view('/admin_pages/toko/edit_produk', $data);
        }
    }


    public function dataBerita(){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{

            $currentPage = $this->request->getVar('page_berita') ? $this->request->getVar('page_berita') : 1;

            $keyword = $this->request->getVar('keyword');
            if($keyword){
                $berita = $this->beritaModel->search($keyword);
            }else{
                $berita = $this->beritaModel->getberitaAll();
            }

             $data_berita = [
                'title' => 'Data Berita',
                'berita' => $berita->paginate(5, 'berita'),
                'pager' => $this->beritaModel->pager,
                'currentPage' => $currentPage,
            ];
            
            return view('admin_pages/berita/berita', $data_berita);
        }
    }

    public function tampilanaddBerita(){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
             $data_tambah = [
                'title' => 'Tambah Berita',
                'penulis' => $this->penulisModel->findAll()
            ];
            return view('admin_pages/berita/tambah_berita', $data_tambah);
        }
    }

    public function addBerita(){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
            if ($this->validate([
            'gambar_berita' =>[
                    'label' => 'Gambar Berita',
                    'rules' => 'uploaded[gambar_berita]|mime_in[gambar_berita,image/jpg,image/jpeg,image/png]',
                    'errors' =>[
                        'uploaded' => '{field} Tidak Boleh Kosong',
                        'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                    ]
                ],  'judul_berita' =>[
                    'label' => 'Judul Berita',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ], 'slug_berita' =>[
                    'label' => 'Slug Berita',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ], 'isi_berita' =>[
                    'label' => 'Isi Berita',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ], 'penulis_berita' =>[
                    'label' => 'Penulis Berita',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ]
            ])){
                $gambar_berita = $this->request->getFile('gambar_berita');
                $nama_gambar_berita = $gambar_berita->getRandomName();
                $this->beritaModel->save([
                    'gambar_berita' => $nama_gambar_berita,
                    'judul_berita' => $this->request->getPost('judul_berita'),
                    'slug_berita' => $this->request->getPost('slug_berita'),
                    'isi_berita' => $this->request->getPost('isi_berita'),
                    'id_penulis' => $this->request->getPost('penulis_berita'),
                    'id' => $this->request->getPost('id')
                ]);
                $gambar_berita->move('gambar berita', $nama_gambar_berita);
                session()->setFlashdata('pesan_tambah', 'Anda Berhasil Menambah');
                return redirect()->to('/Pages/dataBerita');

            }else{
                return redirect()->to('/Pages/tampilanaddBerita')->withInput();
            }
        }
    }

    public function editBerita($id_berita_edit){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
            $data = [
                'title' =>  'Ubah Berita',
                'berita' => $this->beritaModel->getBeritaEdit($id_berita_edit),
                'penulis' => $this->penulisModel->findAll()
            ];
            
            return view('/admin_pages/berita/edit_berita', $data);
        }
    }

    public function updateBerita($id_berita_edit){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
            if (!$this->validate([
                        'gambar_berita' =>[
                        'label' => 'Gambar Berita',
                        'rules' => 'permit_empty|mime_in[image/jpg,image/jpeg,image/png]',
                        'errors' =>[
                            'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                        ]
                    ],  'judul_berita' =>[
                        'label' => 'Judul Berita',
                        'rules' => 'required',
                        'errors' =>[
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ], 'slug_berita' =>[
                        'label' => 'Slug Berita',
                        'rules' => 'required',
                        'errors' =>[
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ], 'isi_berita' =>[
                        'label' => 'Isi Berita',
                        'rules' => 'required',
                        'errors' =>[
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ], 'penulis_berita' =>[
                        'label' => 'Penulis Berita',
                        'rules' => 'required',
                        'errors' =>[
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ]
                ])){
                return redirect()->to('/Pages/editBerita/' . $this->request->getVar('id_berita'))->withInput();
            }
            

            $fileFoto = $this->request->getFile('gambar_berita');
            
            //cek gambar, berubah atau tidak
            if ($fileFoto->getError() == 4) {
                $namaFoto = $this->request->getVar('foto_lama');
            }else{
                //generate nama file random
                $namaFoto = $fileFoto->getRandomName();
                $fotolama = $this->request->getVar('foto_lama');
                if ($fotolama == "") {
                    //upload gambar
                    $fileFoto->move('gambar berita', $namaFoto);
                }else {
                    //upload gambar
                    $fileFoto->move('gambar berita', $namaFoto);
                    //hapus file lama
                    unlink('gambar berita/'.$fotolama);
                }
            }
            $this->beritaModel->save([
                    'id_berita' => $id_berita_edit,
                    'gambar_berita' => $namaFoto,
                    'judul_berita' => $this->request->getVar('judul_berita'),
                    'slug_berita' => $this->request->getVar('slug_berita'),
                    'isi_berita' => $this->request->getVar('isi_berita'),
                    'id_penulis' => $this->request->getPost('penulis_berita'),
                    'id' => $this->request->getPost('id')
                ]);
            session()->setFlashdata('pesan_edit', 'Anda Berhasil Edit Berita');
            return redirect()->to('/Pages/dataBerita/');
        }
    }

    public function deleteBerita($id_berita){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
            $berita = new BeritaModel();

            $data = $berita->find($id_berita);
            $foto_hapus = $data['gambar_berita'];
            if (file_exists("gambar berita/" .$foto_hapus)) {
                unlink("gambar berita/" .$foto_hapus);
            }
            $berita->delete($id_berita);
            session()->setFlashdata('pesan_hapus', 'Data berhasil dihapus');
            return redirect()->to('/Pages/dataBerita');
        }
    }

    public function tampilanaddPenulis(){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
             $data_tambah = [
                'title' => 'Tambah Penulis',
            ];
            return view('admin_pages/berita/tambah_penulis', $data_tambah);
        }
    }

    public function dataPenulis(){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{

            $currentPage = $this->request->getVar('page_penulis') ? $this->request->getVar('page_penulis') : 1;

            $keyword = $this->request->getVar('keyword');
            if($keyword){
                $penulis = $this->penulisModel->search($keyword);
            }else{
                $penulis = $this->penulisModel->getAll();
            }

            $data_penulis = [
                'title' => 'Data Penulis',
                'penulis' => $penulis->paginate(5, 'penulis'),
                'pager' => $this->penulisModel->pager,
                'currentPage' => $currentPage,
            ];
            
            return view('admin_pages/berita/penulis', $data_penulis);
        }
    }

    public function addPenulis(){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
            if ($this->validate([
            'nama_penulis' =>[
                    'label' => 'Nama Penulis',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ], 'nomor_penulis' =>[
                    'label' => 'Nomor Penulis',
                    'rules' => 'required|numeric|min_length[11]|max_length[13]',
                    'errors' =>[
                        'numeric' => '{field} Hanya Bisa Menggunakan Angka',
                        'required' => '{field} Tidak Boleh Kosong',
                        'min_length' => '{field} Tidak Boleh Kurang Dari Sebelas',
                        'max_length' => '{field} Tidak Boleh Lebih Dari Duabelas',

                    ]
                ], 'email_penulis' =>[
                    'label' => 'Email Penulis',
                    'rules' => 'required|valid_email',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                        'valid_email' => 'Format {field} Tidak Benar'
                    ]
                ]
            ])){
                $this->penulisModel->save([
                    'nama_penulis' => $this->request->getPost('nama_penulis'),
                    'nomor_penulis' => $this->request->getPost('nomor_penulis'),
                    'email_penulis' => $this->request->getPost('email_penulis'),
                    'id_penulis' => $this->request->getPost('penulis_berita'),
                    'id' => $this->request->getPost('id')
                ]);
                session()->setFlashdata('pesan_tambah', 'Anda Berhasil Menambah');
                return redirect()->to('/Pages/dataBerita');

            }else{
                return redirect()->to('/Pages/tampilanaddPenulis')->withInput();
            }
        }
    }

    public function editPenulis($id_penulis_edit){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
            $data = [
                'title' =>  'Ubah Penulis',
                'penulis' => $this->penulisModel->getPenulisEdit($id_penulis_edit),
            ];
            
            return view('/admin_pages/berita/edit_penulis', $data);
        }
    }

    public function updatePenulis($id_penulis_edit){
        if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
            if (!$this->validate([
                    'nama_penulis' =>[
                        'label' => 'Nama Penulis',
                        'rules' => 'required',
                        'errors' =>[
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ], 'nomor_penulis' =>[
                        'label' => 'Nomor Penulis',
                        'rules' => 'required|numeric|min_length[11]|max_length[13]',
                        'errors' =>[
                            'numeric' => '{field} Hanya Bisa Menggunakan Angka',
                            'required' => '{field} Tidak Boleh Kosong',
                            'min_length' => '{field} Tidak Boleh Kurang Dari Sebelas',
                            'max_length' => '{field} Tidak Boleh Lebih Dari Duabelas',

                        ]
                    ], 'email_penulis' =>[
                        'label' => 'Email Penulis',
                        'rules' => 'required|valid_email',
                        'errors' =>[
                            'required' => '{field} Tidak Boleh Kosong',
                            'valid_email' => 'Format {field} Tidak Benar'
                        ]
                    ]
                ])){
                return redirect()->to('/Pages/editPenulis/' . $this->request->getVar('id_penulis'))->withInput();
            }
            
            $this->penulisModel->save([
                    'id_penulis' => $id_penulis_edit,
                    'nama_penulis' => $this->request->getVar('nama_penulis'),
                    'nomor_penulis' => $this->request->getVar('nomor_penulis'),
                    'email_penulis' => $this->request->getVar('email_penulis'),
                ]);
            session()->setFlashdata('pesan_edit', 'Anda Berhasil Edit Penulis');
            return redirect()->to('/Pages/dataPenulis/');
        }
    }

    public function deletePenulis($id_penulis){
         if(session()->get('level') <> 2){
            return redirect()->to("/admin");

        }else{
            $penulis = new PenulisModel();
            

            $penulis->find($id_penulis);
            $penulis->delete($id_penulis);
            session()->setFlashdata('pesan_hapus', 'Data berhasil dihapus');
            return redirect()->to('/Pages/dataPenulis');
        }
    }

    public function dataAdmin(){
        if(session()->get('level') <> 1){
            return redirect()->to("/admin");
        } else {
            $currentPage = $this->request->getVar('page_admin') ? $this->request->getVar('page_admin') : 1;
            
            $keyword = $this->request->getVar('keyword');
            if($keyword){
                $adminQuery = $this->loginadminModel->search($keyword);
            } else {
                $adminQuery = $this->loginadminModel->getAll();
            }
            
            $data_admin = [
                'title' => 'Data Akun Admin',
                'admin' => $adminQuery->paginate(5, 'admin'),
                'pager' => $adminQuery->pager,
                'currentPage' => $currentPage,
            ];
            
            return view('admin_pages/admin/akunadmin', $data_admin);
        }
    }

    public function tampilanaddAdmin(){
        if(session()->get('level') <> 1){
            return redirect()->to("/admin");

        }else{
             $data_tambah = [
                'title' => 'Tambah Admin',
            ];
            return view('admin_pages/admin/tambah_admin', $data_tambah);
        }
    }

    public function addAdmin(){
        if(session()->get('level') <> 1){
            return redirect()->to("/admin");

        }else{
            if ($this->validate([
            'nama_admin' =>[
                    'label' => 'Nama Admin',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ], 'username_admin' =>[
                    'label' => 'Username Admin',
                    'rules' => 'required|is_unique[akun_admin.username_admin]',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => '{field} Sudah Didaftarkan'
                    ]
                ], 'password_admin' =>[
                    'label' => 'Password Admin',
                    'rules' => 'required|min_length[8]|max_length[13]|is_unique[akun_admin.password_admin]',
                    'errors' =>[
                        'min_length' => '{field} Tidak Boleh Kurang Dari Delapan',
                        'max_length' => '{field} Tidak Boleh Lebih Dari Duabelas',
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => '{field} Sudah Didaftarkan' 
                    ]
                ]
            ])){
                $this->loginadminModel->save([
                    'nama_admin' => $this->request->getPost('nama_admin'),
                    'username_admin' => $this->request->getPost('username_admin'),
                    'password_admin' => $this->request->getPost('password_admin'),
                    'level' => '2'
                ]);
                session()->setFlashdata('pesan_tambah', 'Anda Berhasil Menambah');
                return redirect()->to('/Pages/dataAdmin');

            }else{
                return redirect()->to('/Pages/tampilanaddAdmin')->withInput();
            }
        }
    }

     public function editAdmin($id_admin_edit){
        if(session()->get('level') <> 1){
            return redirect()->to("/admin");

        }else{
            $data = [
                'title' =>  'Ubah Admin',
                'admin' => $this->loginadminModel->getAdminEdit($id_admin_edit),
            ];
            
            return view('/admin_pages/admin/edit_admin', $data);
        }
    }

    public function updateAdmin($id_admin_edit){
        if(session()->get('level') <> 1){
            return redirect()->to("/admin");

        }else{
            $adminLama = $this->loginadminModel->getAdmin($this->request->getVar('id'));
            //cek username 
            if ($adminLama['username_admin'] == $this->request->getVar('username_admin')) {
                $rule_username = 'required';
            }else{
                $rule_username = 'required|is_unique[akun_admin.username_admin]';
            }
            //cek password
            if ($adminLama['password_admin'] == $this->request->getVar('password_admin')) {
                $rule_password = 'required|min_length[8]|max_length[12]';
            }else{
                $rule_password = 'required|min_length[8]|max_length[12]|is_unique[akun_admin.password_admin]';
            }

            if (!$this->validate([
                   'nama_admin' =>[
                    'label' => 'Nama Admin',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ], 'username_admin' =>[
                    'label' => 'Username Admin',
                    'rules' => $rule_username,
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => '{field} Sudah Didaftarkan'
                    ]
                ], 'password_admin' =>[
                    'label' => 'Password Admin',
                    'rules' =>  $rule_password,
                    'errors' =>[
                        'min_length' => '{field} Tidak Boleh Kurang Dari Delapan',
                        'max_length' => '{field} Tidak Boleh Lebih Dari Duabelas',
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => '{field} Sudah Didaftarkan' 
                    ]
                ]
                ])){
                return redirect()->to('/Pages/editAdmin/' . $this->request->getVar('id'))->withInput();
            }
            
            $this->loginadminModel->save([
                    'id' => $id_admin_edit,
                    'nama_admin' => $this->request->getVar('nama_admin'),
                    'username_admin' => $this->request->getVar('username_admin'),
                    'password_admin' => $this->request->getVar('password_admin'),
                ]);
            session()->setFlashdata('pesan_edit', 'Anda Berhasil Edit Admin');
            return redirect()->to('/Pages/dataAdmin/');
        }
    }

    public function deleteAdmin($id){
         if(session()->get('level') <> 1){
            return redirect()->to("/admin");

        }else{
            $admin = new LoginAdminModel();
        
            $admin->find($id);
            $admin->delete($id);
            session()->setFlashdata('pesan_hapus', 'Data berhasil dihapus');
            return redirect()->to('/Pages/dataAdmin');
        }
    }
}
