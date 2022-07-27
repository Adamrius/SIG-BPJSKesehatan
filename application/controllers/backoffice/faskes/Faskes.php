<?php defined('BASEPATH') or exit('No direct script access allowed');

class Faskes extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->main_model->logged_in_admin();
    }


    public function Index()
    {
        $this->breadcrumbs->push('Kesehatan', 'backoffice/faskes/faskes');
        $this->breadcrumbs->push('Data Kesehatan', '#');

        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = 'Data Kesehatan';
        $data['description'] = '';
        $data['keywords']    = '';
        $data['page']        = 'backoffice/faskes/faskes';
        $this->load->view('backoffice/index', $data);
    }

    function _sql()
    {
        $this->db->select('
            l.*, 
            kr.name as nama_faskes,
            kr.color, 
            kec.nama as nama_kecamatan, 
            kec.kode
        ');
        $this->db->from('tb_laporan l');
        $this->db->join('tb_kecamatan kec', 'kec.id = l.id_kecamatan', 'left');
        $this->db->join('tb_faskes kr', 'kr.id = l.id_faskes', 'left');

        return $this->db->get();
    }

    function datatables()
    {
        $valid_columns = array(
            0 => 'id',
            1 => 'nama_faskes',
            2 => 'nama_kecamatan',
        );

        $this->main_model->datatable($valid_columns);

        $query = $this->_sql();

        $no = $_POST['start'];
        $data = array();

        foreach ($query->result_array() as $key) {
            $no++;

            // tanggal
            if ($key['tanggal'] == '0000-00-00 00:00:00') {
                $tanggal = '-';
            } else {
                $tanggal = date('d-m-Y H:i', strtotime($key['tanggal']));
            }

            $url_edit = base_url() . 'backoffice/faskes/faskes/edit/' . encrypt_url($key['id']);

            $data[] = array(
                '<label class="checkbox-custome"><input type="checkbox" name="check-record" value="' . $key['id'] . '" class="check-record"></label>',
                $no,
                '<a href="javascript:void(0)" class="detail-data" data="' . $key['id'] . '">' . $key['nama_kecamatan'] . '</a>',
                character_limiter($key['nama_faskes'], 40),
                character_limiter($key['alamat'], 40),
                $tanggal,
                '<div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdown-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v font-20 icon-lg text-muted pb-3px"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-action">
                        <a href="javascript:void(0);" data="' . $key['id'] . '" class="dropdown-item font-16 py-2 detail-data">
                            <i class="fa fa-eye mr-2"></i> <span>Detail</span>
                        </a>
                        <a href="' . $url_edit . '" class="dropdown-item font-16 py-2">
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

    function get_detail_data()
    {
        $id = $this->input->get('id');

        $sql = "
            SELECT 
            l.*, 
            kr.name as nama_faskes,
            kr.color, 
            kec.nama as nama_kecamatan, 
            kec.kode
            FROM tb_laporan l 
            LEFT JOIN tb_kecamatan kec ON kec.id = l.id_kecamatan 
            LEFT JOIN tb_faskes kr ON kr.id = l.id_faskes 
            WHERE l.id = " . $id . "
        ";
        $query = $this->db->query($sql)->row_array();

        // alamat
        if ($query['alamat']) {
            $alamat = $query['alamat'];
        } else {
            $alamat = '-';
        }

        // longitude
        if ($query['longitude']) {
            $longitude = $query['longitude'];
        } else {
            $longitude = '-';
        }

        // latitude
        if ($query['latitude']) {
            $latitude = $query['latitude'];
        } else {
            $latitude = '-';
        }

        // keterangan
        if ($query['keterangan']) {
            $keterangan = $query['keterangan'];
        } else {
            $keterangan = '-';
        }

        // tanggal
        if ($query['tanggal'] == '0000-00-00 00:00:00') {
            $tanggal = '-';
        } else {
            $tanggal = date('d/m/Y H.i', strtotime($query['tanggal']));
        }

        // foto
        if ($query['foto']) {
            $foto = base_url() . 'assets/files/faskes/' . $query['foto'];
        } else {
            $foto = base_url() . 'assets/files/no-images.png';
        }

        $response['kecamatan']        = $query['nama_kecamatan'];
        $response['faskes']     = $query['nama_faskes'];
        $response['color']            = $query['color'];
        $response['alamat']           = $alamat;
        $response['keterangan']       = $keterangan;
        $response['tanggal']          = $tanggal;
        $response['longitude']        = $longitude;
        $response['latitude']         = $latitude;
        $response['foto']             = $foto;

        echo json_encode($response);
    }


    function add()
    {
        $this->breadcrumbs->push('Kesehatan', 'backoffice/faskes/faskes');
        $this->breadcrumbs->push('Tambah Data Kesehatan', '#');

        $data['param']       = 'add';
        $data['id_laporan']  = '';
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = 'Tambah Data Kesehatan';
        $data['description'] = '';
        $data['keywords']    = '';
        $data['page']        = 'backoffice/faskes/faskes_add';
        $this->load->view('backoffice/index', $data);
    }

    function edit($id_laporan_enc)
    {
        $this->breadcrumbs->push('Kesehatan', 'backoffice/faskes/faskes');
        $this->breadcrumbs->push('Tambah Data Kesehatan', '#');

        $data['param']       = 'edit';
        $data['id_laporan']  = $id_laporan_enc;
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = 'Edit Data Kesehatan';
        $data['description'] = '';
        $data['keywords']    = '';
        $data['page']        = 'backoffice/faskes/faskes_add';
        $this->load->view('backoffice/index', $data);
    }

    function get_data()
    {
        $id = $this->input->post('id');

        $query = $this->db->query("SELECT l.* FROM tb_laporan l WHERE l.id = " . $id . " ")->row_array();

        echo json_encode($query);
    }

    function add_data()
    {
        if (!empty($_FILES['foto']['name'])) {
            $data['foto'] = $this->upload_image('foto');
        }

        $data['id_kecamatan']    = $this->input->post('kecamatan');
        $data['id_faskes'] = $this->input->post('faskes');
        $data['alamat']          = $this->input->post('alamat');
        $data['keterangan']      = $this->input->post('keterangan');
        $data['longitude']       = $this->input->post('longitude');
        $data['latitude']        = $this->input->post('latitude');
        $data['status']          = 1;
        $data['tanggal']         = date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s');

        $query = $this->db->insert('tb_laporan', $data);

        if ($query) {
            $response['status']  = 1;
            $response['message'] = 'Data berhasil ditambahkan.';
        } else {
            $response['status']  = 2;
            $response['message'] = 'Gagal menambah data.';
        }
        echo json_encode($response);
    }

    function edit_data()
    {
        $id = $this->input->post('id');

        if (!empty($_FILES['foto']['name'])) {
            $data['foto'] = $this->upload_image('foto');
        }

        $data['id_kecamatan']    = $this->input->post('kecamatan');
        $data['id_faskes'] = $this->input->post('faskes');
        $data['alamat']          = $this->input->post('alamat');
        $data['keterangan']      = $this->input->post('keterangan');
        $data['longitude']       = $this->input->post('longitude');
        $data['latitude']        = $this->input->post('latitude');

        $query = $this->main_model->update_data('tb_laporan', $data, 'id', $id);

        if ($query) {
            $response['status']  = 1;
            $response['message'] = 'Perubahan berhasil di simpan.';
        } else {
            $response['status']  = 2;
            $response['message'] = 'Gagal menyimpan perubahan.';
        }
        echo json_encode($response);
    }

    private function upload_image($name)
    {
        $config['upload_path']   = './assets/files/faskes/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name']     = 'faskes-' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);

        if ($this->input->post('param') == 'edit') {
            $id = $this->input->post('id');
            $query = $this->db->query("SELECT foto FROM tb_laporan WHERE id = " . $id . " ")->row_array();

            if ($query['foto']) {
                if (file_exists(FCPATH . 'assets/files/faskes/' . $query['foto'])) {
                    unlink(FCPATH . 'assets/files/faskes/' . $query['foto']);
                }
            }
        }

        $this->upload->initialize($config);

        if ($this->upload->do_upload($name)) {
            return $this->upload->data('file_name');
        }
        return '';
    }

    function delete_data()
    {
        $method = $this->input->post('method');

        if ($method == 'single') {
            $id = $this->input->post('id');

            $this->delete_single_image($id);
            $query = $this->db->query("DELETE FROM tb_laporan WHERE id = " . $id . " ");

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

                $this->delete_multiple_image($id_str);
                $query = $this->db->query("DELETE FROM tb_laporan WHERE id in (" . $id_str . ")");

                if ($query) {
                    $response = 2;
                }
                echo json_encode($response);
            }
        }
    }

    private function delete_single_image($id)
    {
        $query = $this->db->query("SELECT * FROM tb_laporan WHERE id = " . $id . " ")->row_array();

        $filename = explode(".", $query['foto'])[0];
        array_map('unlink', glob(FCPATH . "assets/files/faskes/$filename.*"));
    }

    private function delete_multiple_image($id)
    {
        $return = '';
        $query = $this->db->query("SELECT * FROM tb_laporan WHERE id in (" . $id . ") ")->result_array();

        foreach ($query as $key) {
            if ($key['foto']) {
                $filename = explode(".", $key['foto'])[0];
                array_map('unlink', glob(FCPATH . "assets/files/faskes/$filename.*"));
            }
        }
        return $return;
    }


    function export_excel()
    {
        require_once APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $dataArray = array(
            array(
                'No',
                'Kecamatan',
                'faskes',
                'Alamat',
                'Keterangan',
                'Longitude',
                'Latitude',
                'Tanggal',
            )
        );

        $data = $this->_sql()->result_array();

        $i = 1;
        foreach ($data as $key) {

            $buff = array(
                $i,
                $key['nama_kecamatan'],
                $key['nama_faskes'],
                $key['alamat'],
                $key['keterangan'],
                $key['longitude'],
                $key['latitude'],
                $key['tanggal'],
            );

            array_push($dataArray, $buff);
            $i++;
        }

        $doc = new PHPExcel();
        $doc->setActiveSheetIndex(0);
        $doc->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
        $doc->getActiveSheet()->fromArray($dataArray);
        $filename = 'data-faskes.xls';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }
}
