<?php
class login_model extends CI_model{

	public function get_user(){
		$res = $this->db->query("select * from user where id = 1 limit 1");
		return $res->result_array();
	}

}
