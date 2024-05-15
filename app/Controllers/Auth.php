<?php

namespace App\Controllers;

// use CodeIgniter\Controller; //Jika extend controller standalone
use App\Models\TokoModel;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;

class Auth extends BaseController
{
    protected $tokoModel, $session;

    public function __construct()
    {
        $this->tokoModel = new TokoModel(); 
        $this->session = \Config\Services::session();
    }

    public function register(){
        
        $emailUser = $this->request->getVar('email_user');
        $ruleEmail = 'permit_empty|valid_email';
        if (!empty($emailUser)) {
            $ruleEmail .= '|is_unique[toko_kelontong.email_toko]';
        }
      
        
        if ($this->validate([
            'username' =>[
                'label' => 'Username',
                'rules' => 'required|is_unique[toko_kelontong.username_toko]',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Didaftarkan'
                ]
            ],  'password' =>[
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
                    'valid_email' => 'Format {field} Tidak Benar'
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
            ],'foto_toko' =>[
                'label' => 'Foto Toko',
                'rules' => 'permit_empty|mime_in[foto_toko,image/jpg,image/jpeg,image/png]',
                'errors' =>[
                    'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
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
                'rules' => 'uploaded[foto_ktp]|mime_in[foto_ktp, image/jpg,image/jpeg,image/png]',
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
                    'mime_in' => 'Format {field} Harus JPG, JPEG atau PNG'
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
            $foto_toko = $this->request->getFile('foto_toko');
            $foto_nib = $this->request->getFile('foto_nib');
            
            $foto_ktp = $this->request->getFile('foto_ktp');
            $nama_foto_ktp = $foto_ktp->getRandomName();
            
            $foto_kk = $this->request->getFile('foto_kk');
            $nama_foto_kk = $foto_kk->getRandomName();

            if ($foto_toko->isValid()) {
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
                'nib_toko' => $this->request->getPost('nib_toko'),
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
                'jenis_usaha' => $this->request->getPost('jenis_usaha'),
                'jenis_usaha_omset' => $this->request->getPost('jenis_usaha_omset'),
                'kecamatan_toko' => $this->request->getPost('kecamatan'),
                'lat_toko' => $this->request->getPost('latitude'),
                'lon_toko' => $this->request->getPost('longitude'),
            ]);

            session()->setFlashdata('pesan', 'Anda Berhasil Daftar, Tunggu Konfirmasi Pengaktifan Akun!');
            return redirect()->to('/login');

        }else{
            return redirect()->to('/register')->withInput();
        }
       
    }

    public function login(){
    // Ambil data dari form login
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Validasi input kosong
    if (empty($username) || empty($password)) {
        session()->setFlashdata('pesan_kosong', 'Username atau Password Tidak Boleh Kosong');
        return redirect()->to('/login');
    }

    // Periksa kredensial pengguna
    $userModel = new TokoModel();
    $user = $userModel->where('username_toko', $username)->first();

    //Memeriksa Username ada atau tidak pada database
    if (!$user) {
        session()->setFlashdata('pesan_username', 'Username Anda Salah');
        return redirect()->to('/login');
    }

    //Memeriksa Password cocok dengan username yang ada pada database pada database
    if ($password != $user['password_toko']) {
        session()->setFlashdata('pesan_password', 'Password Anda Salah');
        return redirect()->to('/login');
    }

    if ($user['status_toko'] == '0') {
        session()->setFlashdata('pesan_aktifasi', 'Akun Anda Belum Diaktifasi');
        return redirect()->to('/login');
    }

    // Set session jika login berhasil
    $datasession = [
        'user_id' => $user['id_toko'],
        'username_toko' => $user['username_toko'],
        'nama_toko' => $user['nama_toko'],
        'foto_toko' => $user['foto_toko'],
        'alamat_toko' => $user['alamat_toko'],
        'email_toko' => $user['email_toko'],
        'nomor_telepon' => $user['nomor_telpon'],
        'kecamatan' => $user['kecamatan_toko'],
        'status_toko' => $user['status_toko'],
        'logged_in' => true
    ];
    $this->session->set($datasession);
    return redirect()->to('/');
        
    }

    public function forgot(){
        if($this->request->getMethod() == 'post'){
           if ($this->validate([
            'email' =>[
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' =>[
                    'required' => '{field} Tidak Boleh Kosong',
                    'valid_email' => 'Ketentuan {field} Tidak Benar', 
                ]
            ]
        ])){
            $email = $this->request->getVar('email');
            $userdata = $this->tokoModel->verifyToko($email);
            if (!empty($userdata)) {
                $to = $email;
                $subject = 'Password'. $userdata['nama_toko'];
                $message = 'Hi '.$userdata['nama_toko']. '<br><br>'
                        . 'Password Anda Adalah '.$userdata['password_toko']. '<br><br>'
                        . 'Terima Kasih<br><br>Teko (Temu Toko)';
                
                $email = \Config\Services::email();
                $email->setTo($to);
                $email->setFrom('tekotemutoko11@gmail.com', 'Teko');
                $email->setSubject($subject);
                $email->setMessage($message);

                if ($email->send()) 
                {

                session()->setFlashdata('pesan', 'Password Anda Sudah Dikirim Ke Email Anda');
                return redirect()->to('/forgot');

                }else {
                    $data = $email->printDebugger(['headers']);
                    print_r($data);
                }

            }else {
                session()->setFlashdata('pesan', 'Email Tidak Terdaftar');
                return redirect()->to('/forgot');
            }
            
        }else{
            return redirect()->to('/forgot')->withInput();
        }
        
        }

        return view('halaman_utama/authentic/forgot_password');
    }

    public function logout()
    {
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
        session()->setFlashdata('pesan_logout', 'Logout Sukses!');
        return redirect()->to('/login');
    }
}