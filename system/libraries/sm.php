<?php
require_once(__DIR__.'/smarty/Smarty.class.php');
class CI_sm extends Smarty{
	function __construct() {
		parent::__construct();
		$this->compile_dir = $_SERVER['CACHE_PATH']?$_SERVER['CACHE_PATH']:APPPATH .'../temp';
		$this->template_dir = APPPATH . "views";
		$this->config_dir= APPPATH . "config";
		$this->left_delimiter = "{"; //左定界符 
		$this->right_delimiter = "}"; //右定界符 
		if(ENVIRONMENT == 'development'){
			$this->compile_check = true;
		}else{
			$this->compile_check = false;
		}

	}

	public function view($tpl){
		$this->display($tpl);
	}

}
