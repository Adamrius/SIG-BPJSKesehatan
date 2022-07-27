<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
    }

	public function index()
	{

	}

    function fetch_data_kriminalitas()
    {
        $id_kriminalitas = $this->input->post('id_kriminalitas');

        $get_kriminalitas = $this->db->query("SELECT kr.* FROM tb_kriminalitas kr WHERE kr.status = 1 ORDER BY kr.name ASC")->result_array();
        
        $data    = array();
        $laporan = array();

        foreach ($get_kriminalitas as $key1) {

            $count = $this->db->query("SELECT COUNT(id) as total FROM tb_laporan WHERE id_kriminalitas = ".$key1['id']." ")->row_array();

            $data1['id']    = $key1['id'];
            $data1['name']  = $key1['name'];
            $data1['color'] = $key1['color'];
            $data1['total'] = $count['total'];

            array_push($data, $data1);
        }
        

        $where = '';

        if ($id_kriminalitas) {
            $where .= 'AND l.id_kriminalitas = '.$id_kriminalitas;
        } 

        $get_laporan = $this->db->query("
            SELECT l.*, kec.nama as nama_kecamatan, kr.name as nama_kriminalitas, kr.color   
            FROM tb_laporan l
            LEFT JOIN tb_kecamatan kec ON kec.id = l.id_kecamatan
            LEFT JOIN tb_kriminalitas kr ON kr.id = l.id_kriminalitas 
            WHERE l.status = 1 
            ".$where."
        ")->result_array();

        foreach ($get_laporan as $key2) {

            if ($key2['foto']) {
                $foto = base_url().'assets/files/kriminalitas/'.$key2['foto'];
            } else {
                $foto = '';
            }

            $data2['kecamatan']     = $key2['nama_kecamatan'];
            $data2['longitude']     = $key2['longitude'];
            $data2['latitude']      = $key2['latitude'];
            $data2['alamat']        = $key2['alamat'];
            $data2['tanggal']       = date('d F Y H.i', strtotime($key2['tanggal']));
            $data2['kriminalitas']  = $key2['nama_kriminalitas'];
            $data2['color']         = $key2['color'];
            $data2['foto']          = $foto;

            array_push($laporan, $data2);
        }        

        $response['data']    = $data;
        $response['laporan'] = $laporan;

        echo json_encode($response);
    }

}