<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Scroll_model extends CI_Model
{
	function fetch_data($limit, $start)
	{

		$this->db->select("*");
		$this->db->order_by("id", "ASC");
		$this->db->limit($limit, $start);
		$query = $this->db->get('tbl_task');
		return $query;
	}
}
