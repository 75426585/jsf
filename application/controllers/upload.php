<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload extends CI_Controller {
	public function index(){
		$this->sm->view('upload/index.php');
	}
}
