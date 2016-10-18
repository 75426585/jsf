<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('article_model');
	}

	//推送文章
	public function push() {
		$post = $this->input->post();
		$get = $this->input->get();
		$aid = intval(isset($get['aid'])?$get['aid']:0);

		$this->load->library('MdTpl');
		$mt = new MdTpl();
		$mt->code_skin = 'emacs';
		$mt->text_skin = '';
		$mt->static_dir = '/static/js/lib';
		$posts['content'] = $mt->display($posts['content']);
		var_dump($posts);exit;
	}

	//拉取文章
	public function pull(){
		$posts = $this->article_model->get_recent();
		echojson(1,$posts);
	}

}
