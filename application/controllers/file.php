<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class File extends CI_Controller {
	public function index(){
		$this->load->view('file/dir_list.html');
	}
}
