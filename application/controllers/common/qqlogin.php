<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class QQlogin extends CI_Controller {

	//QQ登陆默认页面
	public function index(){
		$this->load->view('common/qqlogin.html');
	}

	public function auth(){
		$this->load->library('qq');
		$this->qq->qc->qq_login();
	}

}
