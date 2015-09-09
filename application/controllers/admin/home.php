<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller{

	public function __construct(){
		parent::__construct();

	}

	public function index(){
		var_dump($_SESSION);exit;
		$this->sm->view('admin/home/index.php');
	}

	/**
	 * Description : 获取子菜单(点击菜单ajax调用)
	 * Author      : jishuai
	 * Created Time: 2015-02-26 17:08
	 */
	public function getSubMenu(){
		$index = (int) (isset($_POST['index'])?$_POST['index']:'0');
		$menu = $this->config->item('menu');
		$submenu = $menu[$index];
		array_shift($submenu);
		$data['submenu'] = $submenu;
		echo json_encode($data);
	}
}
