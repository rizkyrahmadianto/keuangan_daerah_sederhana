<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
	}

	public function getUserById($id)
	{
		return $this->db->get_where('users', ['id' => $id])->row_array();
	}

	public function updateUser($data)
	{
		$this->db->where('email', $this->input->post('email'));
		$this->db->update('users', $data);
	}

	public function updatePassword($data)
	{
		$this->db->where('email', $this->session->userdata('email'));
		$this->db->update('users', $data);
	}
}
