<?php defined('BASEPATH') or exit('No direct script access allowed');

class Data_administrator extends CI_Controller
{

    private $numbering_row = 0;

    function __construct()
    {
        parent::__construct();
        $this->main_model->logged_in_admin();
    }

    public function Index()
    {
        $this->breadcrumbs->push('Pengaturan', 'backoffice/administrator/administrator');
        $this->breadcrumbs->push('Pengaturan', '#');

        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = 'Data Administrator';
        $data['description'] = '';
        $data['keywords']    = '';
        $data['page']        = 'backoffice/administrator/data_administrator';
        $this->load->view('backoffice/index', $data);
    }

    private function sql()
    {
        $result   = array();
        $id_admin = $this->session->userdata('id_admin');

        $sql = "SELECT
            '' as checkbox,
            id_user,
            photo,
            nama_lengkap,
            email,
            no_telp,
            terakhir_login,
            '' as action 
            FROM admin_user 
            WHERE id_user != '" . $id_admin . "'
        ";
        $sql .= "ORDER BY id_user DESC";

        return $sql;
    }

    private function callback_column($key, $col, $row)
    {
        if ($key == 'checkbox') {
            $col = '<label class="checkbox-custome"><input type="checkbox" name="check-record" value="' . $row['id_user'] . '" class="check-record"></label>';
        }

        if ($key == 'id_user') {
            $this->numbering_row = $this->numbering_row + 1;
            $col = $this->numbering_row;
        }

        if ($key == 'photo') {
            if ($row['photo'] == '') {
                $url_image = base_url() . 'assets/files/no-images.png';
            } else {
                $url_image = base_url() . 'assets/files/admin/' . $row['photo'];
            }
            $col = '<img src="' . $url_image . '" class="img-fluid rounded-50" style="height: 40px; width: 40px;">';
        }

        if ($key == 'nama_lengkap') {
            $col = character_limiter($row['nama_lengkap'], 10);
        }

        if ($key == 'terakhir_login') {
            if ($row['terakhir_login'] == "0000-00-00 00:00:00") {
                $col = '-';
            } else {
                $col = date('d-m-Y H.i', strtotime($row['terakhir_login']));
            }
        }

        if ($key == 'action') {
            $col = '
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v font-20 icon-lg text-muted pb-3px"></i>
                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                        <a href="#" class="dropdown-item font-16 py-2" id="edit-data" data="' . $row['id_user'] . '">
                            <i class="fa fa-edit mr-2"></i> <span>Edit</span>
                        </a>
                        <a href="#" class="dropdown-item font-16 py-2" id="reset-password" data="' . $row['id_user'] . '">
                            <i class="fa fa-key mr-2"></i> <span>Reset Password</span>
                        </a>
                        <a href="#" class="dropdown-item font-16 py-2" id="delete-data" data="' . $row['id_user'] . '">
                            <i class="fa fa-trash-o mr-2"></i> <span>Delete</span>
                        </a>
                    </div>
                </div>
                ';
        }

        return $col;
    }

    public function datatables()
    {
        $sql = $this->sql();
        $total_row = $this->db->query("SELECT count(*) as total FROM (" . $sql . ") as tb ")->row_array()['total'];

        $result = $this->db->query($sql)->result_array();

        $datatables_format = array(
            'data'            => array(),
            'recordsTotal'    => $total_row,
            'recordsFiltered' => $total_row,
        );

        foreach ($result as $row) {
            $buffer = array();

            foreach ($row as $key => $col) {
                $col = $this->callback_column($key, $col, $row);
                array_push($buffer, $col);
            }
            array_push($datatables_format['data'], $buffer);
        }
        header('Content-Type: application/json');
        echo json_encode($datatables_format);
    }




    function cek_email()
    {
        $email = $this->input->post('email');
        $query = $this->db->query("SELECT * FROM admin_user WHERE email = '" . $email . "' ")->result();

        if ($query) {
            $response = 0;
        } else {
            $response = 1;
        }

        echo json_encode($response);
    }

    function add_data()
    {
        if (!empty($_FILES["photo"]["name"])) {
            $data['photo'] = $this->upload_photo_admin();
        }

        $data['nama_lengkap'] = $this->input->post('nama_lengkap');
        $data['username']     = $this->input->post('username');
        $data['email']        = $this->input->post('email');
        $data['no_telp']      = $this->input->post('no_telp');
        $data['password']     = md5($this->input->post('password'));
        $data['role']         = 'admin';
        $data['status']       = 1;
        $data['tanggal']      = date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s');

        $query = $this->db->insert('admin_user', $data);

        if ($query) {
            $response['status']  = 1;
            $response['message'] = 'Data berhasil ditambahkan.';
        } else {
            $response['status']  = 2;
            $response['message'] = 'Gagal menambah data.';
        }
        echo json_encode($response);
    }


    function get_data()
    {
        $id = $this->input->get('id');

        $query = $this->db->query("SELECT * FROM admin_user WHERE id_user = " . $id . " ")->row_array();
        echo json_encode($query);
    }

    function edit_data()
    {
        $id = $this->input->post('id_user');

        if (!empty($_FILES["photo"]["name"])) {
            $data['photo'] = $this->upload_photo_admin();
        }

        $data['nama_lengkap'] = $this->input->post('nama_lengkap');
        $data['username']     = $this->input->post('username');
        $data['email']        = $this->input->post('email');
        $data['no_telp']      = $this->input->post('no_telp');
        // $data['password']     = md5($this->input->post('password'));

        $query = $this->main_model->update_data('admin_user', $data, 'id_user', $id);

        if ($query) {
            $response['status']  = 3;
            $response['message'] = 'Data berhasil Disimpan.';
        } else {
            $response['status']  = 4;
            $response['message'] = 'Gagal menyimpan data.';
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
            $query = $this->db->query("SELECT photo FROM admin_user WHERE id_user=" . $id . " ")->row_array();

            if ($query['photo']) {
                if (file_exists(FCPATH . 'assets/files/admin/' . $query['photo'])) {
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


    function reset_password()
    {
        $id = $this->input->post('id');

        $data['password'] = md5('123456');
        $query = $this->main_model->update_data('admin_user', $data, 'id_user', $id);

        if ($query) {
            $response = 1;
        } else {
            $response = 0;
        }

        echo json_encode($response);
    }


    function delete_data()
    {
        $method = $this->input->post('method');

        if ($method == 'single') {
            $id = $this->input->post('id');

            $this->delete_single_image($id);
            $query = $this->db->query("DELETE FROM admin_user WHERE id_user = " . $id . " ");

            if ($query) {
                $response = 1;
            }
        } else {
            $json = $this->input->post('id');
            $id = array();

            if (strlen($json) > 0) {
                $id = json_decode($json);
            }

            if (count($id) > 0) {
                $id_str = "";
                $id_str = implode(',', $id);

                $this->delete_multiple_image($id_str);
                $query = $this->db->query("DELETE FROM admin_user WHERE id_user in (" . $id_str . ")");

                if ($query) {
                    $response = 2;
                }
            }
        }

        echo json_encode($response);
    }

    private function delete_single_image($id)
    {
        $query = $this->db->query("SELECT photo FROM admin_user WHERE id_user = " . $id . " ")->row_array();

        if ($query['photo']) {
            if (file_exists(FCPATH . 'assets/files/admin/' . $query['photo'])) {
                $filename = explode(".", $query['photo'])[0];
                array_map('unlink', glob(FCPATH . "assets/files/admin/$filename.*"));
            }
        }
    }

    private function delete_multiple_image($id)
    {
        $return = '';
        $query = $this->db->query("SELECT photo FROM admin_user WHERE id_user in (" . $id . ") ")->result_array();

        foreach ($query as $key) {
            if ($key['photo']) {
                if (file_exists(FCPATH . 'assets/files/admin/' . $key['photo'])) {
                    $filename = explode(".", $key['photo'])[0];
                    array_map('unlink', glob(FCPATH . "assets/files/admin/$filename.*"));
                }
            }
        }
        return $return;
    }
}
