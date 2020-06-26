<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		check_session_log();
	}

	public function index()
	{
		$info['title'] 	= 'Dashboard';
		$info['user']	= $this->Auth_model->getUserSession();

		$info['count_region'] = $this->Admin_model->getCountRegion();
		$info['good_region'] = $this->Admin_model->getGoodRegion();
		$info['warning_region'] = $this->Admin_model->getWarningRegion();
		$info['danger_region'] = $this->Admin_model->getDangerRegion();
		$info['user_online'] = $this->Admin_model->getUserOnline();

		$this->load->view('template/header', $info);
		$this->load->view('template/sidebar', $info);
		$this->load->view('template/topbar', $info);
		$this->load->view('admin/index', $info);
		$this->load->view('template/footer');
	}
}
