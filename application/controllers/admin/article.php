<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('article_model');
	}

	//所有文章
	public function index(){
		$get = $this->input->get();
		$page = (int) max(1,$get['page']);
		$this->db->order_by('create_time');
		$posts = $this->db->get('js_posts')->result_array();
		$data = get_defined_vars();
		$this->sm->assign($data);
		$this->sm->view('admin/article/lists.html');
	}


	//文章分类
	public function cat($function=''){
		$post = $this->input->post();
		$get = $this->input->get();
		$cat_tree = $this->article_model->get_cat_tree();
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
		$this->db->order_by('create_time desc');
		$cat = $this->db->get_where('js_posts')->result_array();
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
			$art = $this->db->get_where('ji_posts','cat_id !=0')->result_array();
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
			$res = $this->article_model->add(array('title'=>$title,'cat_id'=>$post['cat_id']));
			if($res){
				echojson('1','');
			}else{
				echojson('0','');
			}
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
		$cat_tree = $this->article_model->get_cat_tree();
		foreach($cat_tree as $k => $v){
			if($v['level'] > 1){
				$cat_tree[$k]['dropInner'] = false;
			}else{
				$cat_tree[$k]['dropInner'] = true;
			}
		}
		echojson(1,$cat_tree);
	}
}
