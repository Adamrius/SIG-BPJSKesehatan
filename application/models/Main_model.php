<?php

class Main_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function logged_in()
    {
        if ($this->session->userdata("logged_in") == FALSE) {
            redirect('', 'refresh');
        }
    }

    function logged_in_true()
    {
        if ($this->session->userdata("logged_in") == TRUE) {
            redirect('dashboard', 'refresh');
        }
    }

    function logged_in_admin()
    {
        if ($this->session->userdata("logged_in_admin") == FALSE) {
            $this->session->set_flashdata('flash-warning-message', 'Silahkan login terlebih dahulu.');
            redirect('backoffice/login', 'refresh');
        }
    }

    function auto_id($table, $field, $kode)
    {
        $query = $this->db->query("SELECT MAX(RIGHT($field, 3)) AS id_last FROM $table");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $qr) {
                $id = sprintf('%03s', ((int)$qr->id_last) + 1);
            }
        } else {
            $id = "001";
        }
        return $kode . '-' . $id;
    }

    function cek_allready($table, $data)
    {
        $this->db->get_where($table, $data);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

    function get_data_row_array($table, $data)
    {
        return $this->db->get_where($table, $data)->row_array();
    }

    function get_data($table)
    {
        return $this->db->get($table)->result_array();
    }

    function get_data_where($table, $data)
    {
        return $this->db->get_where($table, $data)->result_array();
    }

    function get_data_order($table, $order_by)
    {
        $this->db->order_by($order_by);
        return $this->db->get($table)->result_array();
    }

    function update_data($table, $data, $column, $key)
    {
        $this->db->set($data);
        $this->db->where($column, $key);
        return $this->db->update($table);
    }

    function count_where($table, $data)
    {
        $this->db->where($data);
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    function count_total($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    function get_web()
    {
        $query = $this->db->query("SELECT * FROM admin_web WHERE id=1")->row_array();
        return $query;
    }


    // --------------------------- post visitors ---------------------------
    function post_visitors($page)
    {
        $this->load->library('user_agent');

        $date       = date('Y-m-d');
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $visitor = $this->db->query("SELECT * FROM admin_visitors WHERE date='" . $date . "' AND page_view='" . $page . "' AND ip_address='" . $ip_address . "'")->row_array();

        if ($visitor) {
            $hits = $visitor['hits'];
            $this->db->query("UPDATE admin_visitors SET hits=$hits+1 WHERE date='" . $date . "' AND page_view='" . $page . "' AND ip_address='" . $ip_address . "'");
        } else {
            if ($this->agent->is_referral()) {
                $referrer = $this->agent->referrer();
            } else {
                $referrer = base_url();
            }

            $data['referral']   = $referrer;
            $data['ip_address'] = $ip_address;
            $data['page_view']  = $page;
            $data['date']       = $date;
            $data['hits']       = 1;
            $data['browser']    = $this->agent->browser();
            $data['platform']   = $this->agent->platform();
            $data['waktu']      = date_create('now', timezone_open('Asia/Jakarta'))->format('Y-m-d H:i:s');

            $this->db->insert('admin_visitors', $data);
        }
    }
    // --------------------------- end post visitors ---------------------------


    // --------------------------- datatables ---------------------------
    function count_all($table, $where)
    {
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->count_all_results();
    }

    function total_records($table)
    {
        $query = $this->db->select("COUNT(*) as total")->get($table)->row();

        if (isset($query)) return $query->total;
        return 0;
    }

    function datatable($valid_columns)
    {
        $start  = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order  = $this->input->post("order");
        $search = $this->input->post("search");
        $search = $search['value'];
        $col    = 0;
        $dir    = "";

        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }

        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }

        if ($order != null) {
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }

        $this->db->limit($length, $start);
    }
    // --------------------------- end datatables ---------------------------

}
