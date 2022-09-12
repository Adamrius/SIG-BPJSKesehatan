<?php defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    }

    function fetch_data_faskes()
    {
        $id_faskes = $this->input->post('id_faskes');

        $get_faskes = $this->db->query("SELECT kr.* FROM tb_faskes kr WHERE kr.status = 1 ORDER BY kr.name ASC")->result_array();

        $data    = array();
        $laporan = array();

        foreach ($get_faskes as $key1) {

            $count = $this->db->query("SELECT COUNT(id) as total FROM tb_laporan WHERE id_faskes = " . $key1['id'] . " ")->row_array();

            $data1['id']    = $key1['id'];
            $data1['name']  = $key1['name'];
            $data1['color'] = $key1['color'];
            $data1['total'] = $count['total'];

            array_push($data, $data1);
        }


        $where = '';

        if ($id_faskes) {
            $where .= 'AND l.id_faskes = ' . $id_faskes;
        }

        $get_laporan = $this->db->query("
            SELECT l.*, kec.nama as nama_kecamatan, kr.name as nama_faskes, kr.color   
            FROM tb_laporan l
            LEFT JOIN tb_kecamatan kec ON kec.id = l.id_kecamatan
            LEFT JOIN tb_faskes kr ON kr.id = l.id_faskes 
            WHERE l.status = 1 
            " . $where . "
        ")->result_array();

        foreach ($get_laporan as $key2) {

            if ($key2['foto']) {
                $foto = base_url() . 'assets/files/faskes/' . $key2['foto'];
            } else {
                $foto = '';
            }

            $data2['kecamatan']     = $key2['nama_kecamatan'];
            $data2['longitude']     = $key2['longitude'];
            $data2['latitude']      = $key2['latitude'];
            $data2['kode_faskes']   = $key2['kode_faskes'];
            $data2['nama']          = $key2['nama'];
            $data2['alamat']        = $key2['alamat'];
            $data2['no_telp']       = $key2['no_telp'];
            $data2['keterangan']    = $key2['keterangan'];
            $data2['tanggal']       = date('d F Y H.i', strtotime($key2['tanggal']));
            $data2['faskes']  = $key2['nama_faskes'];
            $data2['color']         = $key2['color'];
            $data2['foto']          = $foto;

            array_push($laporan, $data2);
        }

        $response['data']    = $data;
        $response['laporan'] = $laporan;

        echo json_encode($response);
    }


    function export_data_kriminalitas()
    {
        require_once APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $year  = date('Y');

        $id_faskes = $this->input->get('id');

        $data = $this->db->query("
            SELECT l.*, kec.nama as nama_kecamatan, kr.name as nama_faskes, kr.color   
            FROM tb_laporan l
            LEFT JOIN tb_kecamatan kec ON kec.id = l.id_kecamatan
            LEFT JOIN tb_faskes kr ON kr.id = l.id_faskes 
            WHERE l.status = 1 
            AND l.id_faskes = " . $id_faskes . " 
            AND YEAR(l.tanggal) = '" . $year . "' 
        ")->result_array();


        $dataArray = array(
            array(
                'No',
                'Kecamatan',
                'Fasilitas Kesehatan',
                'Kode Faskes',
                'Nama',
                'Alamat',
                'No Telp',
                'Data Terakhir',
            )
        );

        $i = 1;
        foreach ($data as $key) {

            $buff = array(
                $i,
                $key['nama_kecamatan'],
                $key['nama_faskes'],
                $key['kode_faskes'],
                $key['nama'],
                $key['alamat'],
                $key['no_telp'],
                $key['tanggal'],
            );

            array_push($dataArray, $buff);
            $i++;
        }

        $doc = new PHPExcel();
        $doc->setActiveSheetIndex(0);
        $doc->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
        $doc->getActiveSheet()->fromArray($dataArray);
        $filename = 'Kategori Fasilitas Kesehatan.xls';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }


    function fetch_data_faskes_chart()
    {
        // $get_kecamatan = $this->db->query("SELECT id, nama FROM tb_kecamatan WHERE id_kabupaten = 3302 ")->result_array();
        $year  = date('Y');

        $query = $this->db->query("
            SELECT COUNT(l.id) as total_kriminal, kec.nama as nama_kecamatan 
            FROM tb_laporan l
            LEFT JOIN tb_kecamatan kec ON kec.id = l.id_kecamatan
            WHERE l.status = 1 
            AND YEAR(l.tanggal) = '" . $year . "'  
            GROUP BY l.id_kecamatan 
            ORDER BY nama_kecamatan ASC 
        ")->result_array();

        $data = '[';
        $data .= '{';
        $array_data = array();

        foreach ($query as $key) {
            $total = (float)$key['total_kriminal'];
            array_push($array_data, $total);
        }

        $data .= '"name": "Total Fasilitas Kesehatan ",';
        $data .= '"data": ' . json_encode($array_data) . '';
        $data .= '}';
        $data .= ']';


        $kecamatan = array();

        foreach ($query as $key2) {
            array_push($kecamatan, $key2['nama_kecamatan']);
        }

        $response['title']        = 'Fasilitas BPJS Kesehatan Kabupaten Banyumas ' . $year;
        $response['faskes'] = $data;
        $response['kecamatan']    = $kecamatan;
        $response['status']          = 1;

        echo json_encode($response);
    }
}
