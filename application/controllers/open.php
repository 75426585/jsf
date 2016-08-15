<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Open extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function get_content($post_id){
		$post_id = max(intval($post_id),1);
		$posts = $this->db->get_where('js_posts',array('id'=>$post_id))->row_array();
		echo $posts['content'];
	}
	public function set_content($post_id){
		$post = $this->input->post();
		$post_id = max(intval($post_id),1);
		$content = strval($post['content']);
		$posts = $this->db->update('js_posts',array('content'=>$content),array('id'=>$post_id));
		if($posts){
			echo '发布成功';
		}else{
			echo '发布失败';
		}
	}
}
