<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	public function index(){
		$this->load->view('login/login');
	}


	/**
	 * Description : 生产验证码
	 * Author      : jishuai
	 * Created Time: 2015-03-23 21:09
	 */
	public function createCode(){
		loadlib("checkcode");
		$checkcode = new chkcode();
		$checkcode->create();
	}

	/**
	 * Description : ajax登陆接口
	 * Author      : jishuai
	 * Created Time: 2015-04-11 22:28
	 */
	public function ajaxpost(){
		$username = trim($this->input->post('username'));
		$password = trim($this->input->post('password'));
		$checkcode = trim($this->input->post('checkcode'));
		if($_SESSION['chkcode'] !== $checkcode) echojson('0','','验证码不正确！');
		$this->load->model('login_model');
		$user = $this->login_model->get_user();
		if(!$user) echojson('0','','系统出错');
		$password = md5(md5($password.'ji'));
		if(($username === $user['name']) && ($password === $user['pas'])){
			$_SESSION['userid'] = $user['id'];
			echojson('1','','登录成功!正在跳转...'); 
		}else{
			echojson('0','','账号或者密码不对！'); 
		}
	}

	/**
	 * Description : ajax登陆接口
	 * Author      : jishuai
	 * Created Time: 2015-04-11 22:28
	 */
	public function logout(){
		unset($_SESSION['userid']);
		header('Location:/');
	}













}
