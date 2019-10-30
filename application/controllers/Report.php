<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    check_session_log();
  }

  public function index()
  {
    $info['title']   = 'Report Sensus';
    $info['user']  = $this->Auth_model->getUserSession();

    // SEARCHING
    if ($this->input->post('search', true)) {
      $info['keyword'] = $this->input->post('search', true);
      $this->session->set_userdata('keyword', $info['keyword']);
    } else {
      $info['keyword'] = $this->session->set_userdata('keyword');
    }
    // SEARCHING

    // DB PAGINATION FOR SEARCHING
    $this->db->select('*, COUNT(*) AS jumlah, SUM(person_income) AS total, AVG(person_income) AS rata_rata');
    $this->db->from('person');
    $this->db->join('regions', 'regions.region_id = person.region_id');

    $this->db->like('region_name', $info['keyword']);
    // DB PAGINATION FOR SEARCHING

    $config['base_url']     = base_url() . 'report/index';
    $config['total_rows']   = $this->db->count_all_results();
    $config['per_page']     = 5;
    $config['num_links']    = 5;

    // STYLING
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
    $config['full_tag_close']   = '</ul></nav></div>';

    $config['first_link']       = 'First';
    $config['first_tag_open']   = '<li class="page-item">';
    $config['first_tag_close']  = '</li>';

    $config['last_link']        = 'Last';
    $config['last_tag_open']    = '<li class="page-item">';
    $config['last_tag_close']   = '</li>';

    $config['next_link']        = '&raquo';
    $config['next_tag_open']    = '<li class="page-item">';
    $config['next_tag_close']   = '</li>';

    $config['prev_link']        = '&laquo';
    $config['prev_tag_open']    = '<li class="page-item">';
    $config['prev_tag_close']   = '</li>';

    $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close']    = '</a></li>';

    $config['num_tag_open']     = '<li class="page-item">';
    $config['num_tag_close']    = '</li>';
    $config['attributes']       = array('class' => 'page-link');
    // STYLING

    $this->pagination->initialize($config);

    $info['start']   = $this->uri->segment(3);
    $info['data']    = $this->Report_model->getAllData($config['per_page'], $info['start'], $info['keyword']);

    $info['pagination'] = $this->pagination->create_links();

    $this->load->view('template/header', $info);
    $this->load->view('template/sidebar', $info);
    $this->load->view('template/topbar', $info);
    $this->load->view('reports/index', $info);
    $this->load->view('template/footer');
  }

  public function printReport()
  {
    $this->load->library('pdf');
    $filename = "Report_Admin_" . date('dmY');
    $data['data'] = $this->Admin_model->_getAllData();
    $this->pdf->generate('reports/print-report', $data, $filename);
  }
}

  /* End of file Report.php */
