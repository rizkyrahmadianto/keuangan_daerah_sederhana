<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Region_model extends CI_Model
{
    /* public function __construct()
        {
            
        } */

    public function getRegionById($id)
    {
        return $this->db->get_where('regions', ['region_id' => $id])->row_array();
    }

    public function getAllRegion($limit, $offset, $keyword)
    {
        if ($keyword) {
            $this->db->like('region_name', $keyword);
        }

        $this->db->order_by('region_name', 'ASC');

        $query = $this->db->get('regions', $limit, $offset);
        return $query->result_array();
    }

    public function getSearchRegion()
    {
        $keyword = $this->input->post('search', true);
        $this->db->like('region_id', $keyword);
        $this->db->or_like('region_name', $keyword);

        return $this->db->get('regions')->result_array();
    }

    public function searchData($query)
    {
        $this->db->select('*');
        $this->db->from('regions');

        if ($query != '') {
            $this->db->like('region_name', $query);
        }

        $this->db->order_by('region_id', 'DESC');
        return $this->db->get();
    }

    public function checkNameRegion($value, $data)
    {
        $this->db->select($value);
        $this->db->where($value, $data);

        $query = $this->db->get('regions');

        if ($query->num_rows() > 0) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function insertDataRegion($file)
    {
        $this->db->set('created_at', 'NOW()', FALSE);
        $this->db->insert('regions', $file);
    }

    public function updateDataRegion($file)
    {
        $this->db->where('region_id', $this->input->post('id'));
        $this->db->update('regions', $file);
    }

    public function deleteDataRegion($id)
    {
        $this->db->where('region_id', $id);
        $this->db->delete('regions');
    }
}
