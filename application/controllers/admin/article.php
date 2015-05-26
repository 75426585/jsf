<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends MY_Controller{

	public function __construct(){
		parent::__construct();

	}

	public function add($function=''){
		if($function == 'doadd'){
			$data = $this->input->post();
			var_dump($data);exit;
		}else{
			$this->sm->view('admin/article/add.php');
		}
	}

	public function lists(){
		$this->load->view('admin/article/lists');
	}

	public function cat($function=''){
		if($function == 'add'){

		}else{
			$this->sm->view('admin/article/cat.php');
		}
	}
}
