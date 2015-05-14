<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function index(){
		$data['title'] = 'smarty 测试';
		$this->sm->assign($data);
		$this->sm->view('home/index.html');
	}
}
