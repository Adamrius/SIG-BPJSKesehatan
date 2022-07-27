<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_Controller {

    private $numbering_row = 0;

    public function __construct() {
        parent::__construct();
        $this->main_model->logged_in_admin();
    }

    public function Index() {
        $this->breadcrumbs->push('Contact Us', 'ultrapanel/administrator/contact_us');
        $this->breadcrumbs->push('Data Contact Us', '#');

        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = 'Contact Us';
        $data['description'] = '';
        $data['keywords']    = '';
        $data['page']        = 'ultrapanel/administrator/contact_us';
        $this->load->view('ultrapanel/index', $data);
    }

    private function sql() 
    {
        $result = array();

        $sql = "SELECT
            '' as checkbox,
            id,
            name,
            phone,
            email,
            subject,
            date,
            '' as action 
            FROM contact_us
        ";

        $sql .= "ORDER BY id DESC";

        return $sql;
    }

    private function callback_column($key, $col, $row) 
    {
        if ($key == 'checkbox') {
            $col = '<label class="checkbox-custome"><input type="checkbox" name="check-record" value="'.$row['id'].'" class="check-record"></label>';
        }

        if ($key == 'id') {
            $this->numbering_row = $this->numbering_row + 1;
            $col = $this->numbering_row;
        }

        if ($key == 'name') {
            $col = '<a href="javascript:void(0)" class="detail-data" data="'.$row['id'].'">' . character_limiter($row['name'], 15) . '</a>';
        } 

        if ($key == 'subject') {
            $col = character_limiter($row['subject'], 20);
        } 

        if ($key == 'date') {
            $col = time_ago($row['date']);
        } 

        if ($key == 'action') {
            $col = '
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v font-20 icon-lg text-muted pb-3px"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                        <a href="javascript:void(0);" data="'.$row['id'].'" class="dropdown-item font-16 py-2 detail-data">
                            <i class="fa fa-edit mr-2"></i> <span>Detail</span>
                        </a>
                        <a href="javascript:void(0);" data="'.$row['id'].'" id="delete-data" class="dropdown-item font-16 py-2">
                            <i class="fa fa-trash-o mr-2"></i> <span>Delete</span>
                        </a>
                    </div>
                </div>
            ';
        }

        return $col;
    }

    function datatables() 
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


    function get_data()
    {
        $id = $this->input->get('id');

        $query = $this->db->query("SELECT * FROM contact_us WHERE id='".$id."'")->row_array();
        echo json_encode($query);
    }


    function delete_data()
    {
        $method = $this->input->post('method');

        if($method == 'single')
        {
            $id = $this->input->post('id');

            $query = $this->db->query("DELETE FROM contact_us WHERE id = '".$id."'");

            if($query) {
                $response = 1;
            }
            echo json_encode($response);
        }
        else
        {
            $json = $this->input->post('id');
            $id = array();

            if (strlen($json) > 0) {
                $id = json_decode($json);
            }

            if (count($id) > 0) {
                $id_str = "";
                $id_str = implode(',', $id);

                $query = $this->db->query("DELETE FROM contact_us WHERE id in (".$id_str.")");

                if($query) {
                    $response = 2;
                }
                echo json_encode($response);
            }
        }
    }


    public function export()
    {
        require_once APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $dataArray = array(
            array(
                'No',
                'Kategori',
                'Nilai',
                'Deskripsi kategori'
            )
        );

        $query = $this->db->query($this->sql())->result_array();

        $i = 1;
        foreach ($query as $row) {

            $buff = array(
                $i,
                $row['kategori'],
                $row['nilai'],
                $row['deskripsi_kategori'],
            );
            array_push($dataArray, $buff);
            $i++;
        }

        // create php excel object
        $doc = new PHPExcel();
        // set active sheet 
        $doc->setActiveSheetIndex(0);
        $doc->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
        $doc->getActiveSheet()->fromArray($dataArray);
        $filename = 'Data pertanyaan.xls';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }

}