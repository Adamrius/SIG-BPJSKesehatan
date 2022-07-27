<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->main_model->logged_in_admin();
    }

    public function index()
    {
        $this->breadcrumbs->push('Dashboard', 'backoffice/dashboard');
        $this->breadcrumbs->push('Dashboard', '#');

        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']         = 'Dashboard';
        $data['description'] = '';
        $data['keywords']    = '';
        $data['page']        = 'backoffice/dashboard';
        $this->load->view('backoffice/index', $data);
    }

    function data_info()
    {
        $get_kecamatan    = $this->db->query("SELECT COUNT(id) as total FROM tb_kecamatan WHERE id_kabupaten = 3302")->row_array();
        $get_faskes = $this->db->query("SELECT kr.* FROM tb_faskes kr WHERE kr.status = 1 ORDER BY kr.name ASC")->result_array();

        $data = array();

        foreach ($get_faskes as $key) {

            $count = $this->db->query("SELECT COUNT(id) as total FROM tb_laporan WHERE id_faskes = " . $key['id'] . " ")->row_array();

            $row['id']           = $key['id'];
            $row['faskes'] = $key['name'];
            $row['total']        = $count['total'];

            array_push($data, $row);
        }

        $response['data_kecamatan']    = $get_kecamatan['total'];
        $response['data_faskes'] = $data;

        echo json_encode($response);
    }


    function get_data_admin()
    {
        $id = $this->input->post('id');

        $query = $this->db->query("SELECT a.* FROM admin_user a WHERE a.id_user = " . $id . " ")->row_array();

        echo json_encode($query);
    }

    function edit_data_admin()
    {
        $id = $this->input->post('id_admin');

        if (!empty($_FILES['photo']['name'])) {
            $data['photo'] = $this->upload_photo_admin();
        }

        $data['nama_lengkap'] = $this->input->post('nama_lengkap');
        $data['username']     = $this->input->post('username');
        $data['no_telp']      = $this->input->post('no_telp');
        $data['email']        = $this->input->post('email');

        $query = $this->main_model->update_data('admin_user', $data, 'id_user', $id);

        if ($query) {
            $response['status']  = 1;
            $response['message'] = 'Perubahan berhasil di simpan.';
        } else {
            $response['status']  = 2;
            $response['message'] = 'Gagal menyimpan perubahan.';
        }
        echo json_encode($response);
    }

    private function upload_photo_admin()
    {
        $config['upload_path']  = './assets/files/admin/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name']    = $this->input->post('role') . '_' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
        $config['quality']      = '60%';

        if ($this->input->post('param') == 'edit') {
            $id = $this->input->post('id_user');
            $query = $this->db->query("SELECT * FROM admin_user WHERE id_user=" . $id . " ")->row_array();

            if ($query) {
                if ($query['photo']) {
                    $config['overwrite'] = true;
                    unlink(FCPATH . 'assets/files/admin/' . $query['photo']);
                }
            }
        }

        $this->upload->initialize($config);

        if ($this->upload->do_upload('photo')) {
            return $this->upload->data('file_name');
        }
        return '';
    }

    function ubah_password_admin()
    {
        $id = $this->input->post('id_admin_res');

        $data['password'] = md5($this->input->post('password_res'));
        $query = $this->main_model->update_data('admin_user', $data, 'id_user', $id);

        if ($query) {
            $response = 1;
        } else {
            $response = 0;
        }

        echo json_encode($response);
    }
}
