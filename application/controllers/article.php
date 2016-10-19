<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends CI_Controller {
	public function show($post_id){
		$post_id = max(intval($post_id),1);
		$posts = $this->db->get_where('js_posts',array('id'=>$post_id))->row_array();
		$this->db->query('update js_posts set view_count = view_count + 1 where id = '.$post_id);
		$posts['content'] = htmlspecialchars_decode($posts['content']);
		//如果是markdown则用markdown解析
		if($posts['post_type'] == 1){
			$this->load->library('MdTpl');
			$posts['content'] = $this->mdtpl->display($posts['content']);
		}

		$this->load->model('tags_model');
		$tags = $this->tags_model->get_post_tags($post_id);

		$this->sm->assign('posts',$posts);
		$this->sm->assign('tags',$tags);
		$this->sm->view('home/article.html');
	}
}
