<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('article_model');
	}

	//文章分类
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
			$this->sm->assign('cat',$cat);
			$this->sm->view('admin/article/cat_list.html');
		}
	}

	//添加文章
	public function add($function=''){
		if($function==''){
			$cat = $this->db->get('article_cat')->result_array();
			$cat_options = array();
			if($cat){
				foreach($cat as $v){
					$cat_options[$v['id']] = $v['name'];
				}
			}
			$data = get_defined_vars();
			$this->sm->assign($data);
			$this->sm->view('admin/article/add.html');
		}elseif($function == 'do'){
			$post = $this->input->post();
			$res = $this->article_model->add($post);
			if($res){
				echojson('1','','添加成功');
			}else{
				echojson('1','','添加失败');
			}
		}
	}

	//文章列表
	public function lists($function = '') {
		$post = $this->input->post();
		$get = $this->input->get();
		$aid = intval(isset($get['aid'])?$get['aid']:0);
		if($function=='dodel'){
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
			$cat_res = $this->db->get('article_cat')->result_array();
			$cat = array();
			if($cat_res){
				foreach($cat_res as $v){
					$cat[$v['id']] = $v['name'];
				}
			}
			$this->db->select('id,cat_id,title,sort');
			$art = $this->db->get('article')->result_array();
			foreach($art as $k => $v){
				$art[$k]['cat_name'] = $cat[$v['cat_id']];
			}
			$this->sm->assign('art',$art);
			$this->sm->view('admin/article/lists.html');
		}
	}

	//树形结构
	public function tree(){
		$this->sm->view('admin/article/tree.html');
	}

	//获取树节点单json
	public function tree_json($pid=0){
		$tree_nodes = array();
		$this->db->order_by('sort asc');
		$cat = $this->db->get_where('article',array('cat_id'=>0))->result_array();
		foreach($cat as $v){
			$temp['id'] = $v['id'] ;
			$temp['pId'] = 0 ;
			$temp['name'] = $v['title'] ;
			$temp['open'] = true ;
			$temp['dropInner'] = true;
			$tree_nodes[] = $temp;
			$this->db->order_by('sort asc');
			$art = $this->db->get_where('article',array('cat_id'=>$v['id']))->result_array();
			foreach($art as $v1){
				$temp1['id'] = $v1['id'] ;
				$temp1['pId'] = $v['id'] ;
				$temp1['name'] = $v1['title'] ;
				$temp1['dropInner'] = false;
				$tree_nodes[] = $temp1;
			}

		}
		//var_dump($tree_nodes);exit;
		echojson(1,$tree_nodes);
	}
}
