<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getAllData($limit, $offset, $keyword)
	{
		//coba materi count if dan sum if
		//https://jagowebdev.com/menghitung-fieldkolom-pada-tabel-mysql-dengan-kondisi-tertentu-menggunakan-count-if/

		// $this->db->select('regions.id AS regid, regions.name AS regname, COUNT(*) AS jumlah, SUM(person.income) AS total, AVG(person.income) AS rata_rata');
		// $this->db->from('regions');
		// $this->db->join('person', 'regions.id = person.region_id');
		$this->db->select('*, COUNT(*) AS jumlah, SUM(person_income) AS total, AVG(person_income) AS rata_rata');
		$this->db->from('person');
		$this->db->join('regions', 'regions.region_id = person.region_id');
		$this->db->group_by('regions.region_id');

		if ($keyword) {
			$this->db->like('region_name', $keyword);
		}

		$this->db->order_by('region_name', 'ASC');
		$this->db->limit($limit, $offset);

		$query = $this->db->get();
		return $query->result_array();
	}

	public function getTotalRow()
	{
		$this->db->select('COUNT(*)');
		$this->db->from('regions');
		$this->db->join('person', 'regions.id = person.region_id');
		//$this->db->group_by('regions.id');
		return $this->db->count_all_results();
	}

	public function getSearchData($limit, $offset)
	{
		$keyword = $this->input->post('search', true);
		$this->db->or_like('name', $keyword);

		return $this->db->get('regions', $limit, $offset)->result_array();
	}

	public function getSearchRole($limit, $offset)
	{
		$keyword = $this->input->post('search', true);
		$this->db->or_like('role', $keyword);

		return $this->db->get('user_role', $limit, $offset)->result_array();
	}

	public function getUserSession()
	{
		return $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
	}

	public function getAllMenu()
	{
		$this->db->where('id !=', 1);
		$query = $this->db->get('user_menu');
		return $query->result_array();
	}

	public function getAllRole($limit, $offset)
	{
		$query = $this->db->get('user_role', $limit, $offset);
		return $query->result_array();
	}

	public function getCheckRoleName($data)
	{
		$this->db->select('role');
		$this->db->where('role', $data);

		$query = $this->db->get('user_role');

		if ($query->num_rows() > 0) {
			//Value exists in database
			return TRUE;
		} else {
			//Value doesn't exist in database
			return FALSE;
		}
	}

	public function insertRole($data)
	{
		$this->db->insert('user_role', $data);
	}

	public function updateRole($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('user_role', $data);
	}

	public function getAccessById($id)
	{
		return $this->db->get_where('user_role', ['id' => $id])->row_array();
	}

	public function updateAccessRole($data)
	{
		$query = $this->db->get_where('user_access_menu', $data);

		if ($query->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}
	}

	public function modelDeleteRole($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_role');
	}
}
