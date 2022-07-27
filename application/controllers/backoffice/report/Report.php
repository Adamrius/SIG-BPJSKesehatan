<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->main_model->logged_in_admin();
    }

    public function index()
    {
        $this->breadcrumbs->push('Report', 'backoffice/report/data_report');
        $this->breadcrumbs->push('Report', '#');

        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = 'Data Report';
        $data['description'] = '';
        $data['keywords']    = '';
        $data['page']        = 'backoffice/report/report';
        $this->load->view('backoffice/index', $data);
    }


    function fetch_data_pendapatan() 
    {
        $date  = date('Y-m-d');
        $day   = date('d');
        $month = date('m');
        $year  = date('Y');

        $query_by_years = $this->db->query("SELECT SUM(total_bayar) as total FROM tb_order WHERE status = 'success' AND YEAR(tanggal_bayar)='".$year."'")->row_array();
        $query_by_month = $this->db->query("SELECT SUM(total_bayar) as total FROM tb_order WHERE status = 'success' AND MONTH(tanggal_bayar)='".$month."' AND YEAR(tanggal_bayar)='".$year."'")->row_array();
        $query_by_today = $this->db->query("SELECT SUM(total_bayar) as total FROM tb_order WHERE status = 'success' AND DAY(tanggal_bayar)='".$day."' AND MONTH(tanggal_bayar)='".$month."' AND YEAR(tanggal_bayar)='".$year."'")->row_array();



        $response['pendapatan_by_years'] = 'Rp'.number_format($query_by_years['total'], 0,',','.');
        $response['pendapatan_by_month'] = 'Rp'.number_format($query_by_month['total'], 0,',','.');
        $response['pendapatan_by_today'] = 'Rp'.number_format($query_by_today['total'], 0,',','.');

        echo json_encode($response);
	}

}