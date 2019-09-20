<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * summary
 */
class Person extends CI_Controller
{
    /**
     * summary
     */
    public function __construct()
    {
        parent::__construct();

        check_session_log();
    }

    public function index()
    {
        $info['title']          = "Person";
        $info['user']           = $this->Auth_model->getUserSession();
        $info['region']            = $this->Person_model->getRegion();

        // Pencarian
        if ($this->input->post('submit', true)) {
            $info['keyword'] = $this->input->post('search', true);
            $this->session->set_userdata('keyword', $info['keyword']);
        } else {
            $info['keyword'] = $this->session->userdata('keyword');
        }

        $config['base_url']     = base_url() . 'person/index';

        // Pak Dika Ways

        // Db pagination for searching
        $this->db->like('person_id', $info['keyword']);
        $this->db->or_like('person_name', $info['keyword']);
        $this->db->or_like('region_id', $info['keyword']);
        $this->db->or_like('person_address', $info['keyword']);
        $this->db->from('person');
        // Db pagination for searching

        /* Untuk menambahkan fitur jumlah berapa rows cari yang ada bisa menggunakan cara
            $info['total_rows'] = $config['total_rows']; ->(lalu dilempar ke views)
            // <h5>Results: <?= $total_rows ?></h5> 
        */

        $config['total_rows']   = $this->db->count_all_results();
        $config['per_page']     = 5;
        $config['num_links']    = 5;

        // styling
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
        // initialize
        $this->pagination->initialize($config);

        $info['start'] = $this->uri->segment(3);
        $info['person'] = $this->Person_model->getAllPerson($config['per_page'], $info['start'], $info['keyword']);

        $info['pagination'] = $this->pagination->create_links();
        // Pak Dika Ways

        // if ($this->input->post('search', true)) {
        //     $info['person'] = $this->Person_model->getAllPerson($config['per_page'], $info['start']);
        // }

        $this->load->view('template/header', $info);
        $this->load->view('template/sidebar', $info);
        $this->load->view('template/topbar', $info);
        $this->load->view('person/index', $info);
        $this->load->view('template/footer');
    }

    public function addPerson()
    {
        $info['title']          = "Add New Person";
        $info['user']           = $this->Auth_model->getUserSession();
        $info['option_region']     = $this->Person_model->getOptionRegion();

        $this->form_validation->set_rules('name', 'person name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('address', 'person address', 'trim|required|min_length[10]');
        $this->form_validation->set_rules('salary', 'person salary', 'trim|required|min_length[3]');

        //Rubah Format Uang
        $uang       = $this->security->xss_clean(html_escape($this->input->post('salary', true)));
        $rubah_uang = preg_replace('/\D/', '', $uang);

        $file = [
            "person_name"         => $this->security->xss_clean(html_escape($this->input->post('name', true))),
            "region_id" => $this->security->xss_clean(html_escape($this->input->post('menu_opt', true))),
            "person_address"     => $this->security->xss_clean(html_escape($this->input->post('address', true))),
            "person_income"    => $rubah_uang,
        ];

        $person_name = $this->input->post('name', true);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $info);
            $this->load->view('template/sidebar', $info);
            $this->load->view('template/topbar', $info);
            $this->load->view('person/add_person', $info);
            $this->load->view('template/footer');
        } else {
            $this->Person_model->insertDataPerson($file);
            $this->session->set_flashdata('success', 'Your data has been added !');
            redirect('person', 'refresh');
        }
    }

    public function detailPerson($id)
    {
        $info['title']  = 'Detail Person';
        $info['user']   = $this->Auth_model->getUserSession();
        $info['detail'] = $this->Person_model->getPersonById($id);
        /*$info['daerah'] = $this->Person_model->getRegionById();*/
        $info['option_region']  = $this->Person_model->getOptionRegion();

        $this->load->view('template/header', $info);
        $this->load->view('template/sidebar', $info);
        $this->load->view('template/topbar', $info);
        $this->load->view('person/detail_person', $info);
        $this->load->view('template/footer');
    }

    public function editPerson($id)
    {
        $info['title']          = "Edit Data Person";
        $info['user']           = $this->Auth_model->getUserSession();
        $info['person']         = $this->Person_model->getPersonById($id);
        $info['option_region']     = $this->Person_model->getOptionRegion();

        $this->form_validation->set_rules('name', 'person name', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('address', 'person address', 'trim|required|min_length[10]');
        $this->form_validation->set_rules('salary', 'person salary', 'trim|required|min_length[3]');

        $uang       = $this->security->xss_clean(html_escape($this->input->post('salary', true)));
        $rubah_uang = preg_replace('/\D/', '', $uang);

        $file = [
            "person_name"         => $this->security->xss_clean(html_escape($this->input->post('name', true))),
            "region_id" => $this->security->xss_clean(html_escape($this->input->post('menu_opt', true))),
            "person_address"     => $this->security->xss_clean(html_escape($this->input->post('address', true))),
            "person_income"    => $rubah_uang
        ];

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $info);
            $this->load->view('template/sidebar', $info);
            $this->load->view('template/topbar', $info);
            $this->load->view('person/edit_person', $info);
            $this->load->view('template/footer');
        } else {
            $this->Person_model->updateDataPerson($file);
            $this->session->set_flashdata('success', 'Your data has been updated !');
            redirect('person', 'refresh');
        }
    }

    public function deletePerson($id)
    {
        $this->Person_model->deleteDataPerson($id);
        $this->session->set_flashdata('success', 'Your data has been deleted !');
        redirect('person', 'refresh');
    }
}
