<?php

namespace App\Controllers;

use App\Models\TokoModel;
use App\Models\ProdukModel;
use App\Models\LoginAdminModel;
use \Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Toko extends BaseController
{
    protected $tokoModel, $session, $produkModel, $loginadminModel;

    public function __construct()
    {
       $this->tokoModel = new TokoModel(); 
       $this->produkModel = new ProdukModel();
       $this->loginadminModel = new LoginAdminModel();
       $this->session = \Config\Services::session();
    }

    public function index()
    {
        if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $keyword = $this->request->getGet('keyword');
            $data = $this->tokoModel->getPaginatedadmin(5, $keyword);
            
            // $currentPage = $this->request->getVar('page_toko_kelontong') ? $this->request->getVar('page_toko_kelontong') : 1;

            // $keyword = $this->request->getVar('keyword');
            // $query = $this->tokoModel->where('status_toko', '1'); // Mulai query dengan kondisi status_toko 1

            // if ($keyword) {
            //     $query->search($keyword); // Terapkan pencarian jika ada kata kunci
            // }

            // $toko = $query->paginate(5, 'toko_kelontong', $currentPage); // Lakukan paginate setelah query selesai
            // $totalRows = $query->countAllResults(); // Hitung total data

            // $data = [
            //     'title' => 'Daftar Toko',
            //     'toko' => $toko,
            //     'pager' => $this->tokoModel->pager,
            //     'currentPage' => $currentPage,
            //     'totalRows' => $totalRows,
            // ];
            return view('admin_pages/toko/index', $data);
        }
    }

    public function detail($id_detail_toko){
        if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $produkModel = new ProdukModel();
            $tokoModel = new TokoModel();

            $perPage = 3; // Jumlah item per halaman
            $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;
            $offset = ($currentPage - 1) * $perPage;

            $total = $produkModel->countProduk($id_detail_toko);
            $produk = $produkModel->getProduk($id_detail_toko, $perPage, $offset);

            $pager = \Config\Services::pager();
            $pager->setPath('Toko/detail/' . $id_detail_toko); // Set path to ensure the pagination links are correct

            // Hitung nomor produk
            $startNumber = ($currentPage - 1) * $perPage + 1;

            $data_produk = [   
                'title' => 'Daftar Produk',
                'produk' => $produk,
                'pager' => $pager,
                'currentPage' => $currentPage,
                'perPage' => $perPage,
                'total' => $total,
                'toko' => $tokoModel->getDetailToko($id_detail_toko),
                'startNumber' => $startNumber // Kirim nomor produk ke view
            ];
        return view('admin_pages/toko/detail_toko', $data_produk);
        }
    }

    public function delete($id_toko){
        if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{

            $toko_hapus = new TokoModel();
            $produk_hapus = new ProdukModel();

            $data_produk = $produk_hapus->where('id_toko', $id_toko)->findAll();
            $data = $toko_hapus->find($id_toko);

            
            $foto_hapus = $data['foto_toko'];
            $nib_hapus = $data['foto_nib'];
            $ktp_hapus = $data['foto_ktp'];
            $kk_hapus = $data['foto_kk'];

            foreach ($data_produk as $key => $value) {
                $hapus = $value['foto_produk'];
                if (is_file("produk foto/" .$hapus)) {
                    unlink("produk foto/" .$hapus);
                }
            }
        
            if (is_file("img/" .$foto_hapus)) {
                unlink("img/" .$foto_hapus);
            }
            if (is_file("nib/" .$nib_hapus)) {
                unlink("nib/" .$nib_hapus);
            }
            if (is_file("ktp/" .$ktp_hapus)) {
                unlink("ktp/" .$ktp_hapus);
            }
            if (is_file("kartu keluarga/" .$kk_hapus)) {
                unlink("kartu keluarga/" .$kk_hapus);
            }
            
            $produk_hapus->getProdukHapus($id_toko);
            $toko_hapus->delete($id_toko);
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to('/toko');
        }
    }

    public function deleteProduk($id_produk){
        if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $produk = new ProdukModel();

            $data = $produk->find($id_produk);
            $foto_hapus = $data['foto_produk'];
            if (is_file("produk foto/" .$foto_hapus)) {
                unlink("produk foto/" .$foto_hapus);
            }
            $produk->delete($id_produk);
            session()->setFlashdata('pesan', 'Data berhasil dihapus');
            return redirect()->to('/toko/');
        }
    }

    public function viewMap(){
         if($this->session->has('username_admin') == ""){
           return redirect()->to("/admin");

        }else{
            $map_view = $this->tokoModel
            ->where('status_toko', '1') // Filter data dengan status
            ->getAllData();
            $data_map = [   
                'title' => 'Daftar Toko Map',
                'location' => $map_view
            ];
        return view('admin_pages/toko/map_data_toko', $data_map);
        }
        
    }

    public function verifikasiData(){
        if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            
            $keyword = $this->request->getGet('keyword');
            $data = $this->tokoModel->getPaginatedverif(5, $keyword);

            return view('admin_pages/toko/verifikasi_data_toko', $data);
        }
        
    }
    public function saveData($id_toko){
         if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $this->tokoModel->save([
                'id_toko'=>$id_toko,
                'status_toko'=>$this->request->getVar('status_toko'),
            ]);
        return redirect()->to('Toko/verifikasiData');
        }
        
    }

    public function verifikasiDataUpdate(){
        if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $keyword = $this->request->getGet('keyword');
            $data = $this->tokoModel->getPaginatedverifupdate(5, $keyword);

            return view('admin_pages/toko/verifikasi_update_toko', $data);
        }
        
    }

    public function saveDataUpdate($id_toko){
         if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $this->tokoModel->save([
                'id_toko'=>$id_toko,
                'status_toko'=>$this->request->getVar('status_toko'),
            ]);
        return redirect()->to('Toko/verifikasiDataUpdate');
        }
        
    }

    public function rejectDataUpdate($id_toko){
         if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $this->tokoModel->save([
                'id_toko'=>$id_toko,
                'status_toko'=>$this->request->getVar('status_toko'),
            ]);
        return redirect()->to('Toko/verifikasiDataUpdate');
        }
        
    }


    public function addToko(){

        if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $emailUser = $this->request->getVar('email_user');
            $ruleEmail = 'permit_empty|valid_email';
            if (!empty($emailUser)) {
                $ruleEmail .= '|is_unique[toko_kelontong.email_toko]';
            }
            
            if($this->session->has('username_admin') == ""){
                return redirect()->to("/admin");
        }else{
            if ($this->validate([
            'toko_foto' =>[
                    'label' => 'Foto Toko',
                    'rules' => 'permit_empty|mime_in[toko_foto,image/jpg,image/jpeg,image/png]',
                    'errors' =>[
                        'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                    ]
                ], 'password' =>[
                    'label' => 'Password',
                    'rules' => 'required|alpha_numeric|min_length[8]|max_length[13]|is_unique[toko_kelontong.password_toko]',
                    'errors' =>[
                        'min_length' => '{field} Tidak Boleh Kurang Dari Delapan',
                        'max_length' => '{field} Tidak Boleh Lebih Dari Duabelas',
                        'alpha_numeric' => '{field} Harus Terdapat Angka dan Huruf',
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => '{field} Sudah Didaftarkan' 
                    ]
                ],  'email_user' =>[
                    'label' => 'Email',
                    'rules' => $ruleEmail,
                    'errors' =>[
                        'is_unique' => '{field} Sudah Didaftarkan',
                        'valid_email' => 'Format {field} Tidak Benar',
                    ]
                ],  'nomor' =>[
                    'label' => 'Nomor',
                    'rules' => 'required|numeric|min_length[11]|max_length[13]|is_unique[toko_kelontong.nomor_telpon]',
                    'errors' =>[
                        'numeric' => '{field} Hanya Bisa Menggunakan Angka',
                        'required' => '{field} Tidak Boleh Kosong',
                        'min_length' => '{field} Tidak Boleh Kurang Dari Sebelas',
                        'max_length' => '{field} Tidak Boleh Lebih Dari Duabelas',
                        'is_unique' => '{field} Sudah Didaftarkan'
                    ]
                ],  'nama' =>[
                    'label' => 'Nama Toko',
                    'rules' => 'required|is_unique[toko_kelontong.nama_toko]',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => '{field} Sudah Didaftarkan'
                    ]
                ],  'alamat' =>[
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong' 
                    ]
                ],'foto_nib' =>[
                    'label' => 'Foto NIB',
                    'rules' => 'permit_empty|mime_in[foto_nib,image/jpg,image/jpeg,image/png]',
                    'errors' =>[
                        'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                    ]
                ], 'nib_toko' =>[
                    'label' => 'Nomor NIB',
                    'rules' => 'permit_empty|max_length[17]',
                    'errors' =>[
                        'max_length' => '{field} Tidak Boleh Lebih Dari Enambelas', 
                    ]
                ],'ktp_pemilik' =>[
                    'label' => 'Nomor KTP',
                    'rules' => 'required|max_length[17]',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                        'max_length' => '{field} Tidak Boleh Lebih Dari Enambelas', 
                    ]
                ],'foto_ktp' =>[
                    'label' => 'Foto KTP',
                    'rules' => 'uploaded[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/png]',
                    'errors' =>[
                        'uploaded' => '{field} Tidak Boleh Kosong',
                        'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                    ]
                ],'kk_pemilik' =>[
                    'label' => 'Nomor Kartu Keluarga',
                    'rules' => 'required|max_length[17]',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                        'max_length' => '{field} Tidak Boleh Lebih Dari Enambelas', 
                    ]
                ],'foto_kk' =>[
                    'label' => 'Foto Kartu Keluarga',
                    'rules' => 'uploaded[foto_kk]|mime_in[foto_kk, image/jpg,image/jpeg,image/png]',
                    'errors' =>[
                        'uploaded' => '{field} Tidak Boleh Kosong',
                        'mime_in' => 'Format {field} JPG, JPEG atau PNG'
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
                ],'kecamatan' =>[
                    'label' => 'Kecamatan',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong' 
                    ]
                ],  'latitude' =>[
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
            ])){
                $foto_toko = $this->request->getFile('toko_foto');
                $foto_nib = $this->request->getFile('foto_nib');
                $foto_ktp = $this->request->getFile('foto_ktp');
                $nama_foto_ktp = $foto_ktp->getRandomName();
                
                $foto_kk = $this->request->getFile('foto_kk');
                $nama_foto_kk = $foto_kk->getRandomName();
                
                if ($foto_nib->isValid()) {
                    $nama_foto_toko = $foto_toko->getRandomName();
                    $foto_toko->move(ROOTPATH . 'public/img', $nama_foto_toko);
                }
                
                
                if ($foto_nib->isValid()) {
                    $nama_foto_nib = $foto_nib->getRandomName();
                    $foto_nib->move(ROOTPATH . 'public/nib', $nama_foto_nib);
                }
                
                $foto_ktp->move(ROOTPATH . 'public/ktp', $nama_foto_ktp);
                $foto_kk->move(ROOTPATH . 'public/kartu keluarga', $nama_foto_kk);

                $this->tokoModel->save([
                    'foto_toko' => $nama_foto_toko ?? '',
                    'nib_toko' => $this->request->getPost('nib_toko') ,
                    'foto_nib' => $nama_foto_nib ?? '',
                    'ktp_pemilik' => $this->request->getPost('ktp_pemilik'),
                    'foto_ktp' => $nama_foto_ktp,
                    'kk_pemilik' => $this->request->getPost('kk_pemilik'),
                    'foto_kk' => $nama_foto_kk,
                    'username_toko' => $this->request->getPost('username'),
                    'password_toko' => $this->request->getPost('password'),
                    'email_toko' => $this->request->getPost('email_user'),
                    'nomor_telpon' => $this->request->getPost('nomor'),
                    'nama_toko' => $this->request->getPost('nama'),
                    'alamat_toko' => $this->request->getPost('alamat'),
                    'kecamatan_toko' => $this->request->getPost('kecamatan'),
                    'jenis_usaha' => $this->request->getPost('jenis_usaha'),
                    'jenis_usaha_omset' => $this->request->getPost('jenis_usaha_omset'),
                    'lat_toko' => $this->request->getPost('latitude'),
                    'lon_toko' => $this->request->getPost('longitude'),
                    'status_toko' => '1'
                ]);
            
                session()->setFlashdata('pesan', 'Anda Berhasil Menambah');
                return redirect()->to('/toko');

            }else{
                return redirect()->to('/Pages/addToko')->withInput();
            }
        }
        }  
    }

    public function editToko($user_id){
        if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $data = [
                'title' =>  'Ubah Toko',
                'toko' => $this->tokoModel->getToko($user_id)
            ];
            
            return view('/admin_pages/toko/edit_toko', $data);
        }
    }

    public function updateToko($user_id){
        if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
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
                ], 'foto_nib' =>[
                    'label' => 'Foto NIB',
                    'rules' => 'permit_empty|mime_in[image/jpg,image/jpeg,image/png]',
                    'errors' =>[
                        'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                    ]
                ],'foto_ktp' =>[
                    'label' => 'Foto KTP',
                    'rules' => 'permit_empty|mime_in[image/jpg,image/jpeg,image/png]',
                    'errors' =>[
                        'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                    ]
                ],'foto_kk' =>[
                    'label' => 'Foto Kartu Keluarga',
                    'rules' => 'permit_empty|mime_in[image/jpg,image/jpeg,image/png]',
                    'errors' =>[
                        'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
                    ]
                ], 'nib_toko' =>[
                    'label' => 'Nomor NIB',
                    'rules' => 'max_length[17]',
                    'errors' =>[
                        'max_length' => '{field} Tidak Boleh Lebih Dari Enambelas', 
                    ]
                ],'ktp_pemilik' =>[
                    'label' => 'Nomor KTP',
                    'rules' => 'required|max_length[17]',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                        'max_length' => '{field} Tidak Boleh Lebih Dari Enambelas', 
                    ]
                ],'kk_pemilik' =>[
                    'label' => 'Nomor Kartu Keluarga',
                    'rules' => 'required|max_length[17]',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                        'max_length' => '{field} Tidak Boleh Lebih Dari Enambelas', 
                    ]
                ],'username_toko' =>[
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
                ],  'toko_email' =>[
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
                ], 'jenis_usaha' =>[
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
                ],'kecamatan' =>[
                    'label' => 'Kecamatan',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong' 
                    ]
                ],  'latitude' =>[
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
                return redirect()->to('/Toko/editToko/' . $this->request->getVar('id_toko'))->withInput();
            }

            $fileFoto = $this->request->getFile('foto_toko');
            $fileFotonib = $this->request->getFile('foto_nib');
            $fileFotoktp = $this->request->getFile('foto_ktp');
            $fileFotokk = $this->request->getFile('foto_kk');

            //cek gambar toko, berubah atau tidak
            if ($fileFoto->getError() == 4) {
                $namaFototoko = $this->request->getVar('foto_toko_lama');
            }else{
                //generate nama file random
                $namaFototoko = $fileFoto->getRandomName();
                $fotolamatoko = $this->request->getVar('foto_toko_lama');
                if ($fotolamatoko == "") {
                    //upload gambar
                    $fileFoto->move('img', $namaFototoko);
                }else {
                    //upload gambar
                    $fileFoto->move('img', $namaFototoko);
                    //hapus file lama
                    unlink('img/'.$fotolamatoko);
                }
            }

            //cek gambar nib, berubah atau tidak
            if ($fileFotonib->getError() == 4) {
                $namaFotonib = $this->request->getVar('foto_nib_lama');
            }else{
                //generate nama file random
                $namaFotonib = $fileFotonib->getRandomName();
                $fotolamanib = $this->request->getVar('foto_nib_lama');
                if ($fotolamanib == "") {
                    //upload gambar
                    $fileFotonib->move('nib', $namaFotonib);
                }else {
                    //upload gambar
                    $fileFotonib->move('nib', $namaFotonib);
                    //hapus file lama
                    unlink('nib/'.$fotolamanib);
                }
            }

            //cek gambar ktp, berubah atau tidak
            if ($fileFotoktp->getError() == 4) {
                $namaFotoktp = $this->request->getVar('foto_ktp_lama');
            }else{
                //generate nama file random
                $namaFotoktp = $fileFotoktp->getRandomName();
                $fotolamaktp = $this->request->getVar('foto_ktp_lama');
                if ($fotolamaktp == "") {
                    //upload gambar
                    $fileFotoktp->move('ktp', $namaFotoktp);
                }else {
                    //upload gambar
                    $fileFotoktp->move('ktp', $namaFotoktp);
                    //hapus file lama
                    unlink('ktp/'.$fotolamaktp);
                }
            }

            //cek gambar kk, berubah atau tidak
            if ($fileFotokk->getError() == 4) {
                $namaFotokk = $this->request->getVar('foto_kk_lama');
            }else{
                //generate nama file random
                $namaFotokk = $fileFotokk->getRandomName();
                $fotolamakk = $this->request->getVar('foto_kk_lama');
                if ($fotolamakk == "") {
                    //upload gambar
                    $fileFotokk->move('kartu keluarga', $namaFotokk);
                }else {
                    //upload gambar
                    $fileFotokk->move('kartu keluarga', $namaFotokk);
                    //hapus file lama
                    unlink('kartu keluarga/'.$fotolamakk);
                }
            }
            $this->tokoModel->save([
                    'id_toko' => $user_id,
                    'foto_toko' => $namaFototoko,
                    'foto_nib' => $namaFotonib,
                    'foto_ktp' => $namaFotoktp,
                    'foto_kk' => $namaFotokk,
                    'nib_toko' => $this->request->getVar('nib_toko'),
                    'ktp_pemilik' => $this->request->getVar('ktp_pemilik'),
                    'kk_pemilik' => $this->request->getVar('kk_pemilik'),
                    'username_toko' => $this->request->getVar('username_toko'),
                    'password_toko' => $this->request->getVar('password_toko'),
                    'email_toko' => $this->request->getVar('toko_email'),
                    'nomor_telpon' => $this->request->getVar('nomor_telpon'),
                    'nama_toko' => $this->request->getVar('nama_toko'),
                    'jenis_usaha' => $this->request->getVar('jenis_usaha'),
                    'jenis_usaha_omset' => $this->request->getVar('jenis_usaha_omset'),
                    'kecamatan_toko' => $this->request->getVar('kecamatan'),
                    'lat_toko' => $this->request->getVar('latitude'),
                    'lon_toko' => $this->request->getVar('longitude'),
                    'alamat_toko' => $this->request->getVar('alamat_toko')
                ]);
                session()->setFlashdata('pesan', 'Anda Berhasil Mengubah Profil');
                return redirect()->to('/toko');
            }
    }

    public function editProduk($id_produk_edit){
         if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $data = [
                'title' =>  'Ubah Produk',
                'produk' => $this->produkModel->getProdukEdit($id_produk_edit)
            ];
            
            return view('/admin_pages/toko/edit_produk', $data);
        }
    }

    public function updateProduk($id_produk_edit){
         if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
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
                return redirect()->to('/Toko/editProduk/' . $this->request->getVar('id_produk'))->withInput();
            }
            

            $fileFoto = $this->request->getFile('produk_foto');
            
            //cek gambar, berubah atau tidak
            if ($fileFoto->getError() == 4) {
                $namaFoto = $this->request->getVar('foto_lama');
            }else{
                //generate nama file random
                $namaFoto = $fileFoto->getRandomName();
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
            return redirect()->to('/toko/' . $this->request->getVar('id_toko'));
        }
    }
    
    public function printpdf()
    {
         if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $dompdf = new Dompdf();
            if($this->session->has('username_admin') == ""){
                return redirect()->to("/admin");

            }else{
                $toko = $this->tokoModel
                ->where('status_toko', '1')->getAllData(); // Filter data dengan status
                $data = [   
                    'title' => 'Daftar Toko',
                    'toko' => $toko,
                ];
                $html = view('admin_pages/toko/downloadpdf', $data);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'Landscape');
                $dompdf->render();
                $dompdf->stream('Data Toko.pdf', array(
                    "Attachment" => false
                ));
            }
        }
    }

    public function printexcel()
    {
        if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $filename = "Data Toko-".date('ymd').".xlsx";
            $keyword = $this->request->getVar('keyword');
            $db = \Config\Database::connect();
            $builder = $db->table('toko_kelontong')->where('status_toko', '1');
            if($keyword != ''){
                $builder->groupStart();
                $builder->like('nama_toko', $keyword);
                $builder->orLike('alamat_toko', $keyword);
                $builder->orLike('kecamatan_toko', $keyword);
                $builder->orLike('nib_toko', $keyword);
                $builder->orLike('ktp_pemilik', $keyword);
                $builder->orLike('kk_pemilik', $keyword);
                $builder->orLike('jenis_usaha', $keyword);
                $builder->orLike('jenis_usaha_omset', $keyword);
                $builder->groupEnd();
                $filename = "Data Toko-Filter-".date('ymd').".xlsx";        
            }
            $query = $builder->get();
            $toko = $query->getResult();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nomor NIB');
            $sheet->setCellValue('C1', 'Nomor KTP');
            $sheet->setCellValue('D1', 'Nomor Kartu Keluarga');
            $sheet->setCellValue('E1', 'Nama Toko');
            $sheet->setCellValue('F1', 'Alamat');
            $sheet->setCellValue('G1', 'Email');
            $sheet->setCellValue('H1', 'Nomor HP');
            $sheet->setCellValue('I1', 'Jenis Usaha');
            $sheet->setCellValue('J1', 'Kategori Usaha');
            $sheet->setCellValue('K1', 'Kecamatan');
            $sheet->setCellValue('L1', 'Username');
            $sheet->setCellValue('M1', 'Password');
            $sheet->setCellValue('N1', 'Latitude');
            $sheet->setCellValue('O1', 'Longitude');

            $column = 2;
            foreach ($toko as $key => $value) {
                $sheet->setCellValue('A'.$column, ($column-1));
                $sheet->setCellValue('B'.$column, $value->nib_toko);
                $sheet->setCellValue('C'.$column, $value->ktp_pemilik);
                $sheet->setCellValue('D'.$column, $value->kk_pemilik);
                $sheet->setCellValue('E'.$column, $value->nama_toko);
                $sheet->setCellValue('F'.$column, $value->alamat_toko);
                $sheet->setCellValue('G'.$column, $value->email_toko);
                $sheet->setCellValue('H'.$column, $value->nomor_telpon);
                $sheet->setCellValue('I'.$column, $value->jenis_usaha);
                $sheet->setCellValue('J'.$column, $value->jenis_usaha_omset);
                $sheet->setCellValue('K'.$column, $value->kecamatan_toko);
                $sheet->setCellValue('L'.$column, $value->username_toko);
                $sheet->setCellValue('M'.$column, $value->password_toko);
                $sheet->setCellValue('N'.$column, $value->lat_toko);
                $sheet->setCellValue('O'.$column, $value->lon_toko);
                $column++;
            }

            $sheet->getStyle('A1:O1')->getFont()->setBold(true);
            $sheet->getStyle('A1:O1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('7FFF00');
            // $sheet->getStyle('A1:J1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            // $sheet->getStyle('A1:J4')->getAlignment()->setWrapText(true);
            $sheet->getStyle('A1:O1')->getFont()->setBold(true);
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ];

            $sheet->getStyle('A1:O'.($column-1))->applyFromArray($styleArray);
            
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);
            $sheet->getColumnDimension('I')->setAutoSize(true);
            $sheet->getColumnDimension('J')->setAutoSize(true);
            $sheet->getColumnDimension('K')->setAutoSize(true);
            $sheet->getColumnDimension('L')->setAutoSize(true);
            $sheet->getColumnDimension('M')->setAutoSize(true);
            $sheet->getColumnDimension('N')->setAutoSize(true);
            $sheet->getColumnDimension('O')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheethtml.sheet');
            header('Content-Disposition: attachment;filename='.$filename);
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit();
        }
    }

     public function import(){
         if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");

        }else{
            $file = $this->request->getFile('file_excel');
            $extension = $file->getClientExtension();
            if ($extension == 'xlsx' || $extension == 'xls') {
                if ($extension == 'xls') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls(); //Memanggil method dengan new
                }else{
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); //Memanggil method dengan new
                }
                $spreadsheet = $reader->load($file);
                $toko = $spreadsheet->getActiveSheet()->toArray();
                foreach ($toko as $key => $value) {
                    if($key == 0){
                        continue;
                    }
                    $data = [
                        'nib_toko' =>$value[1] ?? '',
                        'ktp_pemilik' =>$value[2] ?? '',
                        'kk_pemilik' =>$value[3] ?? '',
                        'username_toko' =>$value[4] ?? '',
                        'password_toko' =>$value[5] ?? '',
                        'email_toko' =>$value[6] ?? '',
                        'nomor_telpon' =>$value[7] ?? '',
                        'nama_toko' =>$value[8] ?? '',
                        'alamat_toko' =>$value[9] ?? '',
                        'kecamatan_toko' =>$value[10] ?? '',
                        'jenis_usaha' =>$value[11] ?? '',
                        'jenis_usaha_omset' =>$value[12] ?? '',
                        'lat_toko' =>$value[13] ?? '',
                        'lon_toko' =>$value[14] ?? '',
                        'status_toko' => '1',
                    ];
                    $this->tokoModel->insert($data);
                }
                session()->setFlashdata('pesan_import_berhasil', 'Berhasil Import Data Excel');
                return redirect()->to('/toko');
            }else {
                session()->setFlashdata('pesan_error_import', 'Extension File yang Anda Upload Tidak Sesuai');
                return redirect()->to('/toko');
            }
        }
    }

    public function editProfilAdmin($id){
        if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");
        }else{
            $data = [
            'title' => 'Ubah Profil Admin',
            'admin' => $this->loginadminModel->getAdminUpdate($id)
        ];
        
        return view('/admin_pages/update_profil_admin', $data);
        }
        
    }

    public function updateProfilAdmin($id){
         if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");
        }else{

            $adminLama = $this->loginadminModel->getAdminUpdate($this->request->getVar('id'));

            //cek username 
            if ($adminLama['username_admin'] == $this->request->getVar('username_admin')) {
                $rule_username = 'required';
            }else{
                $rule_username = 'required|is_unique[akun_admin.username_admin]';
            }
            //cek password
            if ($adminLama['password_admin'] == $this->request->getVar('password_admin')) {
                $rule_password = 'required|min_length[5]|max_length[12]';
            }else{
                $rule_password = 'required|min_length[5]|max_length[12]|is_unique[akun_admin.password_admin]';
            }

            if (!$this->validate([
                'nama_admin' =>[
                    'label' => 'Nama Admin',
                    'rules' => 'required',
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong' 
                    ]
                ],  'username_admin' =>[
                    'label' => 'Username Admin',
                    'rules' => $rule_username,
                    'errors' =>[
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => '{field} Sudah Didaftarkan'
                    ]
                ],  'password_admin' =>[
                    'label' => 'Password Admin',
                    'rules' => $rule_password,
                    'errors' =>[
                        'min_length' => '{field} Tidak Boleh Kurang Dari 5',
                        'max_length' => '{field} Tidak Boleh Lebih Daru Duabelas',
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => '{field} Sudah Didaftarkan'  
                    ]
                ]
            ])){
                return redirect()->to('/Toko/editProfilAdmin/' . $this->request->getVar('id'))->withInput();
            }
            
            $this->loginadminModel->save([
                    'id' => $id,
                    'username_admin' => $this->request->getVar('username_admin'),
                    'password_admin' => $this->request->getVar('password_admin'),
                    'nama_admin' => $this->request->getVar('nama_admin'),
                ]);

            $this->session->set([
                    'username_admin' => $this->request->getVar('username_admin'),
                    'password_admin' => $this->request->getVar('password_admin'),
                    'nama_admin' => $this->request->getVar('nama_admin'),
            ]);

            session()->setFlashdata('pesan_edit', 'Anda Berhasil Ubah Profil Admin');
            return redirect()->to('/Pages');
        }
    }

    public function tampilFoto($folder, $filename){
         if($this->session->has('username_admin') == ""){
            return redirect()->to("/admin");
        }else{
            $allowed_folders = ['ktp', 'kartu keluarga', 'nib']; // Daftar folder yang diizinkan

            if (!in_array($folder, $allowed_folders)) {
                return redirect()->to('/toko');
            }

            $file_path = ROOTPATH . 'public/' . $folder . '/' . $filename;
            
            if (!file_exists($file_path)) {
               return redirect()->to('/toko');
            }
            
            $mime_type = mime_content_type($file_path);
            
            return $this->response->setHeader('Content-Type', $mime_type)
                                ->setHeader('Content-Disposition', 'inline; filename="' . basename($file_path) . '"')
                                ->setBody(file_get_contents($file_path));
            }
        }
}