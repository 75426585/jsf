<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$get = $this->input->get();
		$page = (int) max($get['page'],1);
		$per_page = 10;
		$this->db->order_by('id desc');
		$this->db->limit($per_page,($page-1)*$per_page);
		$articles = $this->db->get('js_posts')->result_array();
		foreach($articles as $k => $v){
			$res=preg_split('/<hr style="page-break-after:always;" class="ke-pagebreak"/',$v['content']);
			$articles[$k]['content'] = $res[0];
			$posts_ids[] = $v['id'];
		}
		$this->load->model('tags_model');
		$tags = $this->tags_model->get_post_tags($posts_ids);
		$data = get_defined_vars();
		$this->sm->assign($data);
		$this->sm->view('home/index.html');
	}

}
