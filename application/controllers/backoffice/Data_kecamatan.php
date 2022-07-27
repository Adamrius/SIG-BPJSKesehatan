<?php defined('BASEPATH') or exit('No direct script access allowed');

class Data_kecamatan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->main_model->logged_in_admin();
    }


    public function Index()
    {
        $this->breadcrumbs->push('Kecamatan', 'backoffice/data_kecamatan');
        $this->breadcrumbs->push('Data Kecamatan', '#');

        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = 'Data Kecamatan';
        $data['description'] = '';
        $data['keywords']    = '';
        $data['page']        = 'backoffice/data_kecamatan';
        $this->load->view('backoffice/index', $data);
    }

    function _sql()
    {
        $this->db->select('kec.*');
        $this->db->from('tb_kecamatan kec');
        $this->db->where('kec.id_kabupaten', 3302);

        return $this->db->get();
    }

    function datatables()
    {
        $table  = 'tb_kecamatan';
        $valid_columns = array(
            0 => 'id',
            1 => 'nama',
            2 => 'kode',
        );

        $this->main_model->datatable($valid_columns);

        $query = $this->_sql();

        $no   = $_POST['start'];
        $data = array();

        foreach ($query->result_array() as $key) {
            $no++;

            $data[] = array(
                '<label class="checkbox-custome"><input type="checkbox" name="check-record" value="' . $key['id'] . '" class="check-record"></label>',
                $no,
                '<a href="javascript:void(0);" data="' . $key['id'] . '" class="detail-data">' . character_limiter($key['nama'], 20) . '</a>',
                $key['kode'],
                '<div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdown-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v font-20 icon-lg text-muted pb-3px"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-action">
                        <a href="javascript:void(0);" data="' . $key['id'] . '" class="dropdown-item font-16 py-2 detail-data">
                            <i class="fa fa-eye mr-2"></i> <span>Detail</span>
                        </a>
                        <a href="javascript:void(0);" data="' . $key['id'] . '" id="edit-data" class="dropdown-item font-16 py-2">
                            <i class="fa fa-edit mr-2"></i> <span>Edit</span>
                        </a>
                        <a href="javascript:void(0);" data="' . $key['id'] . '" id="delete-data" class="dropdown-item font-16 py-2">
                            <i class="fa fa-trash-o mr-2"></i> <span>Delete</span>
                        </a>
                    </div>
                </div>'
            );
        }

        $response = array(
            "draw"            => intval($this->input->post("draw")),
            "recordsTotal"    => $this->_sql()->num_rows(),
            "recordsFiltered" => $this->_sql()->num_rows(),
            "data"            => $data
        );

        echo json_encode($response);
    }

    function cek_nama_kecamatan()
    {
        $value = $this->input->post('value');
        $query = $this->db->query("SELECT nama FROM tb_kecamatan WHERE nama = '" . $value . "' ")->result();

        if ($query) {
            $response = 0;
        } else {
            $response = 1;
        }

        echo json_encode($response);
    }

    function cek_kode_kecamatan()
    {
        $value = $this->input->post('value');
        $query = $this->db->query("SELECT kode FROM tb_kecamatan WHERE kode = '" . $value . "' ")->result();

        if ($query) {
            $response = 0;
        } else {
            $response = 1;
        }

        echo json_encode($response);
    }

    function add_data()
    {
        $data['id']           = $this->get_last_id();
        $data['id_kabupaten'] = 3302;
        $data['nama']         = $this->input->post('kecamatan');
        $data['kode']         = $this->input->post('kode');

        $query = $this->db->insert('tb_kecamatan', $data);

        if ($query) {
            $response = 1;
        } else {
            $response = 2;
        }
        echo json_encode($response);
    }

    function get_last_id()
    {
        $query = $this->db->query("SELECT MAX(RIGHT('id', 3)) AS id_last FROM tb_kecamatan");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $qr) {
                $id = sprintf('%03s', ((int)$qr->id_last) + 1);
            }
        } else {
            $id = "001";
        }
        return '3302' . $id;
    }

    function get_data()
    {
        $id = $this->input->get('id');

        $query = $this->db->query("SELECT kec.* FROM tb_kecamatan kec WHERE kec.id = " . $id . " ")->row_array();

        $response['id']        = $query['id'];
        $response['kecamatan'] = $query['nama'];
        $response['kode']      = $query['kode'];

        echo json_encode($response);
    }

    function edit_data()
    {
        $id = $this->input->post('id');

        $data['nama']         = $this->input->post('kecamatan');
        $data['kode']         = $this->input->post('kode');

        $query = $this->main_model->update_data('tb_kecamatan', $data, 'id', $id);

        if ($query) {
            $response = 3;
        } else {
            $response = 4;
        }
        echo json_encode($response);
    }

    function delete_data()
    {
        $method = $this->input->post('method');

        if ($method == 'single') {
            $id = $this->input->post('id');

            $query = $this->db->query("DELETE FROM tb_kecamatan WHERE id = '" . $id . "'");

            if ($query) {
                $response = 1;
            }
            echo json_encode($response);
        } else {
            $json = $this->input->post('id');
            $id = array();

            if (strlen($json) > 0) {
                $id = json_decode($json);
            }

            if (count($id) > 0) {
                $id_str = "";
                $id_str = implode(',', $id);

                $query = $this->db->query("DELETE FROM tb_kecamatan WHERE id in (" . $id_str . ")");

                if ($query) {
                    $response = 2;
                }
                echo json_encode($response);
            }
        }
    }
}
