<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->main_model->logged_in_admin();
    }
    
	public function index()
	{
        $this->breadcrumbs->push('Website', 'backoffice/administrator/web');
        $this->breadcrumbs->push('Setting Website', '#');

        $data['breadcrumbs'] = $this->breadcrumbs->show();
		$data['title']       = 'Setting Website';
		$data['description'] = '';
		$data['keywords']    = '';
		$data['page']        = 'backoffice/administrator/web';
		$this->load->view('backoffice/index', $data);
	}

    public function get_data()
    {
        $query = $this->db->query("SELECT * FROM admin_web WHERE id=1")->row_array();
        echo json_encode($query);
    }

    public function edit_data()
    {
        $id = $this->input->post('id');

        if (!empty($_FILES["favicon"]["name"])) {
            $data['favicon'] = $this->update_image("favicon");
        }

        $data['name']         = $this->input->post('name');
        $data['email']        = $this->input->post('email');
        $data['phone']        = $this->input->post('phone');
        $data['whatsapp']     = $this->input->post('whatsapp');
        $data['facebook']     = $this->input->post('facebook');
        $data['twitter']      = $this->input->post('twitter');
        $data['instagram']    = $this->input->post('instagram');
        $data['youtube']      = $this->input->post('youtube');
        $data['meta_description']  = $this->input->post('meta_description');
        $data['meta_keywords']     = $this->input->post('meta_keywords');

        $query = $this->main_model->update_data('admin_web', $data, 'id', $id);

        if($query) {
            $response = 1;
        }
        echo json_encode($response);
    }

    function update_image($name)
    {
        $config['upload_path']   = './assets/files/logo/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name']     = $name.'-'.substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);

        $query = $this->db->query("SELECT favicon FROM admin_web WHERE id = 1 ")->row_array();
        
        if($query['favicon']) {
            if (file_exists(FCPATH.'assets/files/logo/'.$query['favicon'])) {
                unlink(FCPATH.'assets/files/logo/'.$query['favicon']);
            }
        }
        
        $this->upload->initialize($config);

        if ($this->upload->do_upload($name)) {
            return $this->upload->data('file_name');
        }
        return '';
    }
}
