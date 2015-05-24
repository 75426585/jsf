<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {
	public function home(){
		$this->load->view('home/index');
	}
}
