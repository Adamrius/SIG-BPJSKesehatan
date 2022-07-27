<?php defined('BASEPATH') or exit('No direct script access allowed');

class Data_faskes extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->main_model->logged_in_admin();
    }


    public function Index()
    {
        $this->breadcrumbs->push('Faskes', 'backoffice/data_faskes');
        $this->breadcrumbs->push('Data Faskes', '#');

        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = 'Data Faskes';
        $data['description'] = '';
        $data['keywords']    = '';
        $data['page']        = 'backoffice/data_faskes';
        $this->load->view('backoffice/index', $data);
    }

    function _sql()
    {
        $this->db->select('kr.*');
        $this->db->from('tb_faskes kr');

        return $this->db->get();
    }

    function datatables()
    {
        $table  = 'tb_faskes';
        $valid_columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'color',
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
                '<a href="javascript:void(0);" data="' . $key['id'] . '" class="detail-data">' . character_limiter($key['name'], 20) . '</a>',
                $key['color'],
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
                        <a href="javascript:void(0);" data="' . $key['id'] . '" id="delete-data" class="dropdown-item font-16 py-2 delete-data">
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

    function cek_heading()
    {
        $value = $this->input->post('value');
        $query = $this->db->query("SELECT name FROM tb_faskes WHERE name = '" . $value . "' ")->result();

        if ($query) {
            $response = 0;
        } else {
            $response = 1;
        }

        echo json_encode($response);
    }

    function add_data()
    {
        $data['name']   = $this->input->post('faskes');
        $data['color']  = $this->input->post('color');
        $data['status'] = 1;

        $query = $this->db->insert('tb_faskes', $data);

        if ($query) {
            $response = 1;
        } else {
            $response = 2;
        }
        echo json_encode($response);
    }

    function get_data()
    {
        $id = $this->input->get('id');

        $query = $this->db->query("SELECT kr.* FROM tb_faskes kr WHERE kr.id = " . $id . " ")->row_array();

        $response['id']           = $query['id'];
        $response['faskes'] = $query['name'];
        $response['color']        = $query['color'];

        echo json_encode($response);
    }

    function edit_data()
    {
        $id = $this->input->post('id');

        $data['name']  = $this->input->post('faskes');
        $data['color'] = $this->input->post('color');

        $query = $this->main_model->update_data('tb_faskes', $data, 'id', $id);

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

            $query = $this->db->query("DELETE FROM tb_faskes WHERE id = '" . $id . "'");

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

                $query = $this->db->query("DELETE FROM tb_faskes WHERE id in (" . $id_str . ")");

                if ($query) {
                    $response = 2;
                }
                echo json_encode($response);
            }
        }
    }
}
