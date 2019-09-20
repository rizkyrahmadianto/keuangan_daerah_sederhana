<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getMenuById($id)
	{
		return $this->db->get_where('user_menu', ['id' => $id])->row_array();
	}

	public function getAllMenu($limit, $offset, $keyword)
	{
		if ($keyword) {
			$this->db->like('menu', $keyword);
		}

		$this->db->order_by('menu', 'ASC');

		$query = $this->db->get('user_menu', $limit, $offset);
		return $query->result_array();
	}

	//for submenu get menu
	public function getAllMenu_()
	{
		$query = $this->db->get('user_menu');
		return $query->result_array();
	}
	//for submenu get menu

	public function getSearchMenu($limit, $offset)
	{
		$keyword = $this->input->post('search', true);
		$this->db->or_like('menu', $keyword);

		return $this->db->get('user_menu', $limit, $offset)->result_array();
	}

	public function insertMenu($file)
	{
		$this->db->insert('user_menu', $file);
	}

	public function updateMenu($data)
	{
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('user_menu', $data);
	}

	public function deleteMenu($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_menu');
	}

	public function getAllSubMenu($limit, $offset, $keyword)
	{
		if ($keyword) {
			$this->db->like('title', $keyword);
			$this->db->or_like('menu', $keyword);
			$this->db->or_like('url', $keyword);
			$this->db->or_like('icon', $keyword);
			$this->db->or_like('level', $keyword);
		}

		// $this->db->select('user_sub_menu.*, user_menu.menu');
		$this->db->select('*, user_sub_menu.id as submenu_id');
		$this->db->from('user_sub_menu');
		$this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');

		$this->db->order_by('title', 'ASC'); // must be specify which the part of table

		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getAllSubMenu_()
	{
		$query = $this->db->get('user_sub_menu');
		return $query->result_array();
	}

	public function getTotalRow()
	{
		$this->db->select('COUNT(*)');
		$this->db->from('user_sub_menu');
		$this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');

		return $this->db->count_all_results();
	}

	public function getSubMenuById($id)
	{
		return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
	}

	public function insertSubMenu($data)
	{
		$this->db->insert('user_sub_menu', $data);
	}

	public function updateSubMenu($data)
	{
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('user_sub_menu', $data);
	}

	public function deleteSubMenu($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user_sub_menu');
	}
}
