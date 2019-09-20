<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Region extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        check_session_log();
    }

    public function index()
    {
        $info['title']  = "Regions";
        $info['user']   = $this->Auth_model->getUserSession();
        /*$info['region'] = $this->Region_model->getAllRegion();*/

        // SEARCHING
        if ($this->input->post('search', true)) {
            $info['keyword'] = $this->input->post('search', true);
            $this->session->set_userdata('keyword', $info['keyword']);
        } else {
            $info['keyword'] = $this->session->set_userdata('keyword');
        }
        // SEARCHING

        // DB PAGINATION FOR SEARCHING
        $this->db->like('region_id', $info['keyword']);
        $this->db->or_like('region_name', $info['keyword']);
        $this->db->from('regions');
        // DB PAGINATION FOR SEARCHING

        $config['base_url']     = base_url() . 'region/index';
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
        $info['region']    = $this->Region_model->getAllRegion($config['per_page'], $info['start'], $info['keyword']);

        $info['pagination'] = $this->pagination->create_links();

        $this->load->view('template/header', $info);
        $this->load->view('template/sidebar', $info);
        $this->load->view('template/topbar', $info);
        $this->load->view('region/index', $info);
        $this->load->view('template/footer');
    }

    public function searchingShow()
    {
        $output = '';
        $query  = '';

        if ($this->input->post('query', true)) {
            $query = $this->input->post('query', true);
        }

        $data = $this->Region_model->searchData($query);
        $output .= '
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Region Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $no = 1;
                $output .= '
                <tbody>
                    <tr>
                      <td>' . $no++ . '</td>
                      <td>' . $row->name . '</td>
                      <td>
                        <!-- <a href="' . base_url() . 'region/deleteRegion/' . $row->id . '" class="btn btn-sm btn-danger button-delete">Delete</a> -->
                        <a href="' . base_url() . 'region/editRegion/' . $row->id . '" class="btn btn-sm btn-warning">Edit</a>
                        <a href="' . base_url() . 'region/detailRegion/' . $row->id . '" class="btn btn-sm btn-success">Detail</a>
                      </td>
                    </tr>

                ';
            }
        } else {
            $output .= '
                    <tr>
                        <td colspan="3" align="center">No data record.</td>
                    </tr>
                </tbody>
            ';
        }
        $output .= '
                </table>
            </div>
        ';
    }

    public function addRegion()
    {
        $info['title']  = "Add New Region";
        $info['user']   = $this->Auth_model->getUserSession();

        $this->form_validation->set_rules('name', 'nama region', 'trim|required|min_length[3]|is_unique[regions.region_name]', [
            'is_unique' => 'region name has been registered, please use another region name.'
        ]);

        $file = ["region_name" => $this->security->xss_clean(html_escape($this->input->post('name', true)))];

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $info);
            $this->load->view('template/sidebar', $info);
            $this->load->view('template/topbar', $info);
            $this->load->view('region/add_region', $info);
            $this->load->view('template/footer');
        } else {
            $this->Region_model->insertDataRegion($file);
            $this->session->set_flashdata('success', 'Your data has been added !');
            redirect('region', 'refresh');
        }
    }

    public function editRegion($id)
    {
        $info['title']  = "Edit Data Region";
        $info['user']   = $this->Auth_model->getUserSession();
        $info['region'] = $this->Region_model->getRegionById($id);

        $this->form_validation->set_rules('name', 'nama region', 'trim|required|min_length[3]|is_unique[regions.region_name]', [
            'is_unique' => 'region name has been registered, please use another region name.'
        ]);

        $file = ["region_name" => $this->security->xss_clean(html_escape($this->input->post('name', true)))];

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $info);
            $this->load->view('template/sidebar', $info);
            $this->load->view('template/topbar', $info);
            $this->load->view('region/edit_region', $info);
            $this->load->view('template/footer');
        } else {
            $this->Region_model->updateDataRegion($file);
            $this->session->set_flashdata('success', 'Your data has been updated !');
            redirect('region', 'refresh');
        }
    }

    public function detailRegion($id)
    {
        $info['title']  = 'Detail Region';
        $info['user']   = $this->Auth_model->getUserSession();
        $info['detail'] = $this->Region_model->getRegionById($id);

        $this->load->view('template/header', $info);
        $this->load->view('template/sidebar', $info);
        $this->load->view('template/topbar', $info);
        $this->load->view('region/detail_region', $info);
        $this->load->view('template/footer');
    }

    public function deleteRegion($id)
    {
        $this->Region_model->deleteDataRegion($id);
        $this->session->set_flashdata('success', 'Your data has been deleted !');
        redirect('region', 'refresh');
    }
}
