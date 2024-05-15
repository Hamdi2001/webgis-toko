<?php

namespace App\Controllers;

use App\Models\BannerModel;
use App\Models\BeritaModel;

class Frontend extends BaseController
{
    protected $bannerModel, $beritaModel;

    public function __construct()
    {
       $this->bannerModel = new BannerModel();
       $this->beritaModel = new BeritaModel();
       helper('text');
       $pager = \Config\Services::pager();
    }

    public function index() 
    {
       $data = [
            'banner' => $this->bannerModel->getBannerData(),
            'berita' => $this->beritaModel->getBeritaData()
        ];
            return view('halaman_utama/index', $data);
    }

    public function login()
    {
        return view('halaman_utama/authentic/login');
    }

    public function register()
    {
        return view('halaman_utama/authentic/register');
    }

    public function forgot()
    {
        return view('halaman_utama/authentic/forgot_password');
    }

    public function viewMap()
    {
        return view('halaman_utama/tampilan_map');
    }

    public function contact()
    {
        return view('halaman_utama/contact');
    }

    public function viewError()
    {
        return view('halaman_utama/error');
    }
    
    public function detailBerita($slug)
    {
        $data_berita = [
            'berita' => $this->beritaModel->getBeritaData($slug),
            'terbaru' => $this->beritaModel->orderBy('created_at', 'DESC')->findAll(6),
        ];
        return view('halaman_utama/detail_berita', $data_berita);
    }

    public function moreBerita()
    {
        $keyword = $this->request->getVar('keyword');
        if($keyword){
             $berita = $this->beritaModel->search($keyword);
        }else{
            $berita = $this->beritaModel;
        }

        $data = [
            'berita' => $berita->orderBy('created_at', 'DESC')->paginate(16, 'berita'),
            'pager' => $this->beritaModel->pager,
        ];
        return view('halaman_utama/more_berita', $data);
    }

}
