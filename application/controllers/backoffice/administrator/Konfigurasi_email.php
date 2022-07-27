<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_email extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->main_model->logged_in_admin();
    }
    
	public function index()
	{
        $this->breadcrumbs->push('Konfigurasi Email', 'ultrapanel/administrator/konfigurasi_email');
        $this->breadcrumbs->push('Konfigurasi Email', '#');

        $data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['title']       = 'Konfigurasi Email';
		$data['description'] = '';
		$data['keywords']    = '';
		$data['page']        = 'ultrapanel/administrator/konfigurasi_email';
		$this->load->view('ultrapanel/index', $data);
	}

    function get_data()
    {
        $query = $this->db->query("SELECT * FROM konfigurasi_email WHERE id = 1")->row_array();
        echo json_encode($query);
    }

    function edit_data()
    {
        $id = $this->input->post('id');

        $data['host']       = $this->input->post('host');
        $data['smtpauth']   = $this->input->post('smtpauth');
        $data['email']      = $this->input->post('email');
        $data['password']   = $this->input->post('password');
        $data['smtpsecure'] = $this->input->post('smtpsecure');
        $data['port']       = $this->input->post('port');
        $data['setfrom']    = $this->input->post('setfrom');

        $query = $this->main_model->update_data('konfigurasi_email', $data, 'id', $id);

        if($query) {
            $response = 1;
        }
        echo json_encode($response);
    }

}
