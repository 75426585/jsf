<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends CI_Controller {
	public function show($post_id){
		$post_id = max(intval($post_id),1);
		$posts = $this->db->get_where('js_posts',array('id'=>$post_id))->row_array();
		$this->load->model('tags_model');
		$tags = $this->tags_model->get_post_tags($post_id);
		$this->sm->assign('posts',$posts);
		$this->sm->assign('tags',$tags);
		$this->sm->view('home/article.html');
	}
}
