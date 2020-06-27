<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('email')) {
			redirect('auth', 'refresh');
		}
	}

	public function index()
	{
		$info['title'] 	= 'User Page';
		$info['user']	= $this->Auth_model->getUserSession();

		$this->load->view('template/header', $info);
		$this->load->view('template/sidebar', $info);
		$this->load->view('template/topbar', $info);
		$this->load->view('user/index', $info);
		$this->load->view('template/footer');
	}

	private function _uploadImage()
	{
		$config['upload_path']    = './assets/img/profile/';
		$config['allowed_types']  = 'gif|jpg|png';
		$config['max_size']       = '2048';
		$config['maintain_ratio'] = TRUE;
		$config['quality'] = '60%';
		$config['encrypt_name'] = TRUE; // md5(uniqid(mt_rand())).$this->file_ext;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('image')) {
			return $this->upload->data('file_name');
		} else {
			$this->session->set_flashdata('error', $this->upload->display_errors());
		}
	}

	public function edit()
	{
		$info['title'] 	= "Edit User Page";
		$info['user']	= $this->Auth_model->getUserSession();

		$this->form_validation->set_rules('name', 'full name', 'trim|required|min_length[5]');

		if (empty($_FILES['image']['name'])) {
			$data = [
				'name' => $this->security->xss_clean(html_escape($this->input->post('name', true)))
			];
		} else {
			$data = [
				'name' => $this->security->xss_clean(html_escape($this->input->post('name', true))),
				'image' => $this->_uploadImage()
			];

			if ($this->input->post('old_image') != "default.png") {
				@unlink('./assets/img/profile/' . $this->input->post('old_image'));
			}
		}

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header', $info);
			$this->load->view('template/sidebar', $info);
			$this->load->view('template/topbar', $info);
			$this->load->view('user/edit-user', $info);
			$this->load->view('template/footer');
		} else {
			$this->User_model->updateUser($data);

			$this->session->set_flashdata('success', 'Updated !');
			redirect('user', 'refresh');
		}
	}

	public function changePassword()
	{
		$info['title'] 	= "Change Password";
		$info['user']	= $this->Auth_model->getUserSession();

		$this->form_validation->set_rules('oldpass', 'current password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('newpass', 'new password', 'trim|required|min_length[6]|matches[repass]');
		$this->form_validation->set_rules('repass', 'retype new password', 'trim|required|min_length[6]|matches[newpass]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header', $info);
			$this->load->view('template/sidebar', $info);
			$this->load->view('template/topbar', $info);
			$this->load->view('user/changepassword', $info);
			$this->load->view('template/footer');
		} else {
			$old_pass 	= $this->security->xss_clean(html_escape($this->input->post('oldpass', true)));
			$newpass	= $this->security->xss_clean(html_escape($this->input->post('newpass', true)));

			if (!password_verify($old_pass, $info['user']['password'])) {
				$this->session->set_flashdata('error', 'Wrong current password !');
				redirect('user/changepassowrd', 'refresh');
			} else {
				if ($old_pass == $newpass) {
					$this->session->set_flashdata('error', 'New password cannot be the same as current password !');
					redirect('user/changepassowrd', 'refresh');
				} else {
					$hash_pass = password_hash($newpass, DEFAULT_PASSWORD);

					$data = [
						'password' => $hash_pass
					];

					$this->User_model->updatePassword($data);
					$this->session->set_flashdata('success', 'Updated !');
					redirect('user/changepassowrd', 'refresh');
				}
			}
		}
	}
}
