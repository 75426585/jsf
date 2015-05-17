<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function index(){
		//var_dump($GLOBALS);exit;
		$this->load->library('qn');
		$res = $this->qn->upload('file3');
		//$res = $this->qn->info('test.jpg','test2.jpg');
		var_dump($res);exit;
	}
}
