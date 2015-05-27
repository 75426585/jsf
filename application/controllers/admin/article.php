<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('article_model');
	}

	public function index(){
		$this->cat();
	}

	public function add($function=''){
		if($function == 'doadd'){
			$data = $this->input->post();
			var_dump($data);exit;
		}else{
			$this->sm->view('admin/article/add.php');
		}
	}

	public function lists(){
		$this->sm->view('admin/article/lists.php');
	}

	public function cat($function=''){
		if($function == 'add'){
			$data = $this->input->post();
			$res = $this->article_model->insert($data);
			if($res){
				echojson('1',$res,'添加成功！');
			}else{
				echojson('0',$res,'添加失败');
			}
		}elseif($function=='del'){
			$cid =(int) $this->input->get('cid');
			$res = $this->article_model->del_cat($cid);
			if($res){
				echojson('1','','删除成功！');
			}else{
				echojson('0','','删除失败！请确认是否有子目录或者目录下有文章！');
			}
		}else{
			$top_cat = $this->article_model->get_cat('0');
			$all_cat = $this->article_model->get_cat('all');
			$data = get_defined_vars();
			$this->sm->assign($data);
			$this->sm->view('admin/article/cat.php');
		}
	}
}
