<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('article_model');
	}

	public function cat($function=''){
		$post = $this->input->post();
		$get = $this->input->get();
		$cid = intval(isset($get['cid'])?$get['cid']:0);
		if($function == 'add'){
			$this->sm->view('admin/article/cat_add.html');
		}elseif($function=='doadd'){
			$name = trim($post['name']);
			$res = $this->article_model->cat_add($name);
			if($res){
				echojson('1','','添加成功');
			}else{
				echojson('1','','添加失败');
			}
		}elseif($function=='dodel'){
			$res = $this->article_model->cat_del($cid);
			if($res){
				echojson('1','','删除成功！');
			}else{
				echojson('0','','删除失败！请确认是否有子目录或者目录下有文章！');
			}
		}elseif($function=='get_catname'){
			$cat_name = $this->db->get_where('article_cat',array('id'=>$cid))->row_array();
			echojson('1',$cat_name['name']);
		}elseif($function == 'doedit'){
			$res = $this->db->update('article_cat',array('name'=>$post['name']),array('id'=>$cid));
			if($res){
				echojson('1',$res,'修改成功！');
			}else{
				echojson('0',$res,'修改失败');
			}
		}else{
			$cat = $this->db->get('article_cat')->result_array();
			$data = get_defined_vars();
			$this->sm->assign($data);
			$this->sm->view('admin/article/cat_list.html');
		}
	}
}
