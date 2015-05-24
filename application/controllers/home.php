<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function index(){
		$this->load->view('home/index.html');
	}

	public function upload(){
		$this->load->library('qn');
		$data['token'] = $this->qn->getToken();
		$this->sm->assign($data);
		$this->sm->view('index.php');
	}



	//plupload上传接口
	public function plupload(){
		$this->load->library('qn');
		$data['token'] = $this->qn->getToken();
		$this->sm->assign($data);
		$this->sm->view('common/plupload.php');
	}
}
