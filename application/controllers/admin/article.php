<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends MY_Controller{

	public function __construct(){
		parent::__construct();

	}

	public function add(){
		$this->load->view('admin/article/add');
	}
	public function lists(){
		$this->load->view('admin/article/lists');
	}
	public function cat(){
		$this->load->view('admin/article/cat');
	}
}
