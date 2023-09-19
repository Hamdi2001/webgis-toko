<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index() 
    {
       $data = [
        'title' => 'Home | Webgis'
       ];

       return view('admin_pages/home', $data);  
    }
}
