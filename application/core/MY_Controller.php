<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!(isset($_SESSION['userid']) and $_SESSION['userid'])){
			header('Location:/common/login');
		}
	}
}
