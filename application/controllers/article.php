<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends CI_Controller {
	public function show($post_id){
		$post_id = max(intval($post_id),1);
		$posts = $this->db->get_where('js_posts',array('id'=>$post_id))->row_array();
		$this->load->model('tags_model');
		$tags = $this->tags_model->get_post_tags($post_id);
		//如果是markdown语法，则转换一下
		if($posts['post_type'] == 1){
			$this->load->library('MdTpl');
			$mt = new MdTpl();
			$mt->code_skin = 'emacs';
			$mt->text_skin = '';
			$mt->static_dir = '/static/js/lib';
			$posts['content'] = $mt->display($posts['content']);
		}
		$this->sm->assign('posts',$posts);
		$this->sm->assign('tags',$tags);
		$this->sm->view('home/article.html');
	}
}
