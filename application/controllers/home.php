<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('page');
	}
	public function index(){
		$get = $this->input->get();
		$page = (int) max($get['page'],1);
		$per_page = 10;
		$this->db->order_by('update_time desc');
		$this->db->limit($per_page,($page-1)*$per_page);
		$this->db->select('id,title,vicetitle,summary_content,update_time,view_count');
		$articles = $this->db->get('js_posts')->result_array();
		$articles_count = $this->db->query('select count(*) as num from js_posts')->row()->num;
		$page_count = ceil($articles_count/$per_page);
		foreach($articles as $k => $v){
			$articles[$k]['summary_content'] = htmlspecialchars_decode($v['summary_content']);
			$posts_ids[] = $v['id'];
		}
		$this->load->model('tags_model');
		$tags = $this->tags_model->get_post_tags($posts_ids);
		$page_links = $this->page->create($articles_count,$per_page);

		$data = get_defined_vars();
		$this->sm->assign($data);
		$this->sm->view('home/index.html');
	}

	public function test(){
		echo DB_FW_USER;
	}

}
