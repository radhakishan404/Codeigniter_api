<?php

defined('BASEPATH') or exit ("No direct script access allowed");

class User_model extends CI_Model() {
	private $table = 'users';

	function get_all_user() {
		$query = $this->db->select("*")->get($table);
		return $query->result();
	}

	function getUniqueUserById($id) {
		return $this->db->get_where($table, array('id' => $id));
	}
}