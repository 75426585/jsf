<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class System extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->sm->view('admin/system/info.php');
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
		$this->sm->view('admin/product/lists.php');
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
		}else{
			$top_cat = $this->article_model->get_cat('0');
			$all_cat = $this->article_model->get_cat('all');
			$data = get_defined_vars();
			$this->sm->assign($data);
			$this->sm->view('admin/article/cat.php');
		}
	}
}
