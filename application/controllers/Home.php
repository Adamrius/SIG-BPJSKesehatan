<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title']       = 'Sistem Informasi Geografis Fasilitas Kesehatan BPJS';
        $data['description'] = '';
        $data['keywords']    = '';
        $data['page']        = 'home';
        $this->load->view('index', $data);
    }
}
