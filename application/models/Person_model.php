<?php

/**
 * summary
 */
class Person_model extends CI_Model
{
	/**
	 * summary
	 */
	/*public function __construct()
	    {

	    }*/

	public function getRegionById($id)
	{
		return $this->db->get_where('regions', ['region_id' => $id])->row_array();
	}

	public function getRegion()
	{
		$query = $this->db->get('regions');
		return $query->result_array();
	}

	public function getPersonById($id)
	{
		return $this->db->get_where('person', ['person_id' => $id])->row_array();
	}

	// public function getAllPerson($limit, $offset)
	// {
	// 	$this->db->order_by('created_at', 'desc');

	// 	$keyword = $this->input->post('search', true);
	// 	$this->db->like('id', $keyword);
	// 	$this->db->or_like('name', $keyword);
	// 	$this->db->or_like('region_id', $keyword);
	// 	$this->db->or_like('address', $keyword);

	// 	$query = $this->db->get('person', $limit, $offset);
	// 	return $query->result_array();
	// }

	public function getAllPerson($limit, $offset, $keyword)
	{
		$this->db->select('*');
		$this->db->from('person');
		$this->db->join('regions', 'regions.region_id = person.region_id');

		if ($keyword) {
			$this->db->like('person_id', $keyword);
			$this->db->or_like('person_name', $keyword);
			$this->db->or_like('region_name', $keyword);
			$this->db->or_like('person_address', $keyword);
		}

		$this->db->order_by('person.created_at', 'desc');

		$this->db->limit($limit, $offset);

		$query = $this->db->get();
		return $query->result_array();
	}

	public function countAllPerson()
	{
		return $this->db->get('person')->num_rows();
	}

	// public function getSearchPerson($limit, $offset)
	// {
	// 	$keyword = $this->input->post('search', true);
	// 	$this->db->like('id', $keyword);
	// 	$this->db->or_like('name', $keyword);
	// 	$this->db->or_like('region_id', $keyword);
	// 	$this->db->or_like('address', $keyword);

	// 	return $this->db->get('person', $limit, $offset)->result_array();
	// }

	public function getOptionRegion()
	{
		$this->db->order_by('region_name', 'asc');
		$query = $this->db->get('regions');
		return $query->result_array();
	}

	public function checkNamePerson($value, $data)
	{
		$this->db->select($value);
		$this->db->where($value, $data);

		$query = $this->db->get('person');

		if ($query->num_rows() > 0) {

			return TRUE;
		} else {

			return FALSE;
		}
	}

	public function insertDataPerson($file)
	{
		$this->db->set('created_at', 'NOW()', FALSE);
		$this->db->insert('person', $file);
	}

	public function updateDataPerson($file)
	{
		$this->db->where('person_id', $this->input->post('id'));
		$this->db->update('person', $file);
	}

	public function deleteDataPerson($id)
	{
		$this->db->where('person_id', $id);
		$this->db->delete('person');
	}
}
