<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
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

  public function _getAllData()
  {
    $this->db->select('*, COUNT(*) AS jumlah, SUM(person_income) AS total, AVG(person_income) AS rata_rata');
    $this->db->from('person');
    $this->db->join('regions', 'regions.region_id = person.region_id');
    $this->db->group_by('regions.region_id');

    $query = $this->db->get();
    return $query->result_array();
  }
}

  /* End of file Report_model.php */
