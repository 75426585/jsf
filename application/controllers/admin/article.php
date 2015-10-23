<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('article_model');
	}

	//文章分类
	public function cat($function=''){
		$cat = $this->db->get_where('article',array('cat_id'=>0))->result_array();
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
			$cat_name = $this->db->get_where('article',array('id'=>$cid))->row_array();
			echojson('1',$cat_name['title']);
		}elseif($function == 'doedit'){
			$res = $this->db->update('article',array('title'=>$post['name']),array('id'=>$cid));
			if($res){
				echojson('1',$res,'修改成功！');
			}else{
				echojson('0',$res,'修改失败');
			}
		}else{
			$this->sm->assign('cat',$cat);
			$this->sm->view('admin/article/cat_list.html');
		}
	}

	//添加文章
	public function add($function=''){
		if($function==''){
			$cat = $this->db->get_where('article',array('cat_id'=>0))->result_array();
			$cat_options = array();
			if($cat){
				foreach($cat as $v){
					$cat_options[$v['id']] = $v['title'];
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

	//文章删除
	public function dodel($aid){
		$res = $this->db->delete('article',array('id'=>intval($aid)));
		if($res){
			echojson('1','','删除成功！');
		}else{
			echojson('0','','删除失败！');
		}
	}

	//文章修改
	public function edit($aid,$function=""){
		$aid = intval($aid);
		$art = $this->db->get_where('article',array('id'=>$aid))->row_array();
		if($function=='doedit'){
			$post = $this->input->post();
			$res = $this->db->update('article',$post,array('id'=>$aid));
			if($res){
				echojson('1','','修改成功');
			}else{
				echojson('1','','修改失败');
			}
		}else{
			$cat = $this->db->get_where('article',array('cat_id'=>0))->result_array();
			$cat_options = array();
			if($cat){
				foreach($cat as $v){
					$cat_options[$v['id']] = $v['title'];
				}
			}
			$data = get_defined_vars();
			$this->sm->assign($data);
			$this->sm->view('admin/article/edit.html');
		}
		
	}

	//文章列表
	public function lists($function = '') {
		$post = $this->input->post();
		$get = $this->input->get();
		$aid = intval(isset($get['aid'])?$get['aid']:0);
		$cat = $this->db->get_where('article',array('cat_id'=>0))->result_array();
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
			$cat_res = array();
			if($cat){
				foreach($cat as $v){
					$cat_res[$v['id']] = $v['title'];
				}
			}
			$this->db->select('id,cat_id,title,sort');
			$art = $this->db->get_where('article','cat_id !=0')->result_array();
			foreach($art as $k => $v){
				$art[$k]['cat_name'] = $cat_res[$v['cat_id']];
			}
			$this->sm->assign('art',$art);
			$this->sm->view('admin/article/lists.html');
		}
	}

	//树形结构
	public function tree($func=''){
		$post = $this->input->post();
		if($func=='rename'){
			$this->db->update('article',array('title'=>$post['name']),array('id'=>$post['id']));
		}elseif($func=='add_node'){
			$title = $post['cat_id']?'新建文章':'新建分类';
			$this->article_model->add(array('title'=>$title,'cat_id'=>$post['cat_id']));
		}elseif($func=='remove'){
			$this->db->delete('article',array('id'=>intval($post['id'])));
		}elseif($func=='change_order'){
			$id1 = intval($post['id_one']);
			$id2 = intval($post['id_two']);
			$type = trim($post['type']);
			$pid = trim($post['pid']);
			$this->article_model->change_order($id1,$id2,$type,$pid);
		}else{
			$this->sm->view('admin/article/tree.html');
		}
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
			$temp['add'] = true;
			$tree_nodes[] = $temp;
			$this->db->order_by('sort asc');
			$art = $this->db->get_where('article',array('cat_id'=>$v['id']))->result_array();
			foreach($art as $v1){
				$temp1['id'] = $v1['id'] ;
				$temp1['pId'] = $v['id'] ;
				$temp1['name'] = $v1['title'] ;
				$temp1['dropInner'] = false;
				$temp1['add'] = false;
				$tree_nodes[] = $temp1;
			}

		}
		//var_dump($tree_nodes);exit;
		echojson(1,$tree_nodes);
	}
}
