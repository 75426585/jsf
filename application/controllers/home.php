<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->sm->view('home/index.html');
	}

	public function kind(){
		$this->load->library('qn');
		$data['token'] = $this->qn->getToken();
		$this->sm->assign($data);
		$this->sm->view('test/kind.php');
	}

	public function upload(){
		$this->load->library('qn');
		$data['token'] = $this->qn->getToken();
		$this->sm->assign($data);
		$this->sm->view('index.php');
	}

}
