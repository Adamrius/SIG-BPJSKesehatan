<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$data['title']       = 'Sistem Informasi Geografis Kriminalitas';
        $data['description'] = '';
        $data['keywords']    = '';
		$data['page']        = 'home';
		$this->load->view('index', $data);
	}

}