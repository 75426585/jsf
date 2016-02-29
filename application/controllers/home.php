<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$get = $this->input->get();
		$page = (int) max($get['page'],1);
		$per_page = 10;
		$this->db->where('cat_id != ',0);
		$this->db->order_by('id desc');
		$this->db->limit($per_page,($page-1)*$per_page);
		$articles = $this->db->get('article')->result_array();
		$data = get_defined_vars();
		$this->sm->assign($data);
		$this->sm->view('home/index.html');
	}

}
