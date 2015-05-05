<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		session_start();
		if(!$_SESSION['admin']){
			header('/admin');
		}

	}
	public function index(){
		echo '后端首页';
	}
}
