<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $data['title']       = 'Login';
        $data['description'] = '';
        $data['keywords']    = '';
        $data['page']        = 'backoffice/login';
        $this->load->view('backoffice/index_blank', $data);
    }


    function cek_email()
    {
        $value = $this->input->post('value');
        $query = $this->db->query("SELECT * FROM admin_user WHERE email='".$value."' OR username='".$value."'")->result();

        if ($query) {
            $response = 1;
        } else {
            $response = 0;
        }

        echo json_encode($response);
    }

    function post_login()
    {
        $email    = $this->input->post('email');
        $password = md5($this->input->post('password'));

        $query = $this->db->query("SELECT * FROM admin_user WHERE username='".$email."' OR email='".$email."' ")->row_array();

        if($query)
        {
           if($password == $query['password']) {
                $session = array(
                    'id_admin'        => $query['id_user'],
                    'logged_in_admin' => TRUE
                );
                $this->session->set_userdata($session);

                $data_update['terakhir_login'] = date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s');
                $this->main_model->update_data('admin_user', $data_update, 'id_user', $query['id_user']);

                $response['status']  = 1;
                $response['message'] = '';
            }
            else
            {
                $response['status']  = 0;
                $response['message'] = 'Password yang Anda masukan tidak sesuai.';
            } 
        }
        else
        {
            $response['status']  = 0;
            $response['message'] = 'Email Anda tidak ditemukan.';
        }

        echo json_encode($response);
    }

	public function logout()
    {
        $this->session->unset_userdata('id_admin');
        $this->session->unset_userdata('logged_in_admin');
        $this->session->sess_destroy();

        redirect('backoffice/login');
    }
}
