<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class QQlogin extends CI_Controller {

	//QQ登陆默认页面
	public function index(){
		$this->load->view('common/qqlogin.html');
	}

	//弹出qq登陆页面
	public function auth(){
		$this->load->library('qq');
		$this->qq->qc->qq_login();
	}

	//调用qq的回调页面,获取access_token
	public function callback(){
		$this->load->library('qq');
		$this->qq->qc->qq_callback();
		$open_id = $this->qq->qc->get_openid();
		$res = $this->db->get_where('qquser',array('openid'=>$open_id))->row_array();
		if($res){
			$_SESSION['userid'] = $res['id'];
			$_SESSION['openid'] = $res['openid'];
			header('Location:/');
		}else{
			$_SESSION['userid'] = '';
			$_SESSION['openid'] = '';
		}
	}

}
