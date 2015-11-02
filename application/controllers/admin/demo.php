<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class demo extends MY_Controller{
	public function __construct(){
		parent::__construct();
	}

	//kindedir 编辑器
	public function kind(){
		$this->load->library('qn');
		$data['token'] = $this->qn->getToken();
		$this->sm->assign($data);
		$this->sm->view('demo/kind.html');
	}

	//七牛云上传
	public function qn(){
		$this->load->library('qn');
		$data['token'] = $this->qn->getToken();
		$this->sm->assign($data);
		$this->sm->view('demo/qn.html');
	}

	//ztree：树形目录
	public function ztree(){
		$this->sm->view('demo/ztree.html');
	}

	//nav_img 图片轮播器
	public function nav_img(){
		$nav_img = $this->db->get('nav_img')->result_array();
		$this->sm->assign('nav_img',$nav_img);
		$this->sm->view('demo/nav_img.html');
	}
	
}
