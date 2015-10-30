<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  Product extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('product_model');
	}

	//产品分类
	public function cat($function=''){
		$cat = $this->db->get_where('product',array('cat_id'=>0))->result_array();
		$post = $this->input->post();
		$get = $this->input->get();
		$cid = intval(isset($get['cid'])?$get['cid']:0);
		if($function == 'add'){
			$this->sm->view('admin/product/cat_add.html');
		}elseif($function=='doadd'){
			$name = trim($post['name']);
			$res = $this->product_model->cat_add($name);
			if($res){
				echojson('1','','添加成功');
			}else{
				echojson('1','','添加失败');
			}
		}elseif($function=='dodel'){
			$res = $this->product_model->cat_del($cid);
			if($res){
				echojson('1','','删除成功！');
			}else{
				echojson('0','','删除失败！请确认是否有子目录或者目录下有产品！');
			}
		}elseif($function=='get_catname'){
			$cat_name = $this->db->get_where('product',array('p_id'=>$cid))->row_array();
			echojson('1',$cat_name['title']);
		}elseif($function == 'doedit'){
			$res = $this->db->update('product',array('title'=>$post['name']),array('p_id'=>$cid));
			if($res){
				echojson('1',$res,'修改成功！');
			}else{
				echojson('0',$res,'修改失败');
			}
		}else{
			$this->sm->assign('cat',$cat);
			$this->sm->view('admin/product/cat_list.html');
		}
	}

	//添加产品
	public function add($function=''){
		if($function==''){
			$this->load->library('qn');
			$token = $this->qn->getToken();
			$cat = $this->db->get_where('product',array('cat_id'=>0))->result_array();
			$cat_options = array();
			if($cat){
				foreach($cat as $v){
					$cat_options[$v['p_id']] = $v['title'];
				}
			}
			$data = get_defined_vars();
			$this->sm->assign($data);
			$this->sm->view('admin/product/add.html');
		}elseif($function == 'do'){
			$post = $this->input->post();
			$res = $this->product_model->add($post);
			if($res){
				echojson('1','','添加成功');
			}else{
				echojson('1','','添加失败');
			}
		}elseif($function == 'img'){
			$url_arr = $this->input->post('urls');
			foreach($url_arr as $v){
				$this->db->insert('pro_img',array('url'=>$v,'pro_id'=>-1));
			}
			$imgs = $this->db->get_where('pro_img',array('pro_id'=>'-1'))->result_array();
			echojson('1',$imgs,'添加成功');
		}
	}

	//产品删除
	public function dodel($aid){
		$res = $this->db->delete('product',array('p_id'=>intval($aid)));
		if($res){
			echojson('1','','删除成功！');
		}else{
			echojson('0','','删除失败！');
		}
	}

	//产品修改
	public function edit($aid,$function=""){
		$aid = intval($aid);
		$pro = $this->db->get_where('product',array('p_id'=>$aid))->row_array();
		if($function=='doedit'){
			$post = $this->input->post();
			$res = $this->db->update('product',$post,array('p_id'=>$aid));
			if($res){
				echojson('1','','修改成功');
			}else{
				echojson('1','','修改失败');
			}
		}else{
			$cat = $this->db->get_where('product',array('cat_id'=>0))->result_array();
			$cat_options = array();
			if($cat){
				foreach($cat as $v){
					$cat_options[$v['p_id']] = $v['title'];
				}
			}
			$data = get_defined_vars();
			$this->sm->assign($data);
			$this->sm->view('admin/product/edit.html');
		}
		
	}

	//产品列表
	public function lists($function = '') {
		$post = $this->input->post();
		$get = $this->input->get();
		$aid = intval(isset($get['aid'])?$get['aid']:0);
		$cat = $this->db->get_where('product',array('cat_id'=>0))->result_array();
		if($function=='dodel'){
			$res = $this->product_model->cat_del($cid);
			if($res){
				echojson('1','','删除成功！');
			}else{
				echojson('0','','删除失败！请确认是否有子目录或者目录下有产品！');
			}
		}elseif($function=='get_catname'){
			$cat_name = $this->db->get_where('product_cat',array('id'=>$cid))->row_array();
			echojson('1',$cat_name['name']);
		}elseif($function == 'doedit'){
			$res = $this->db->update('product_cat',array('name'=>$post['name']),array('id'=>$cid));
			if($res){
				echojson('1',$res,'修改成功！');
			}else{
				echojson('0',$res,'修改失败');
			}
		}else{
			$cat_res = array();
			if($cat){
				foreach($cat as $v){
					$cat_res[$v['p_id']] = $v['title'];
				}
			}
			$this->db->select('p_id,cat_id,title,sort');
			$pro = $this->db->get_where('product','cat_id !=0')->result_array();
			foreach($pro as $k => $v){
				$pro[$k]['cat_name'] = $cat_res[$v['cat_id']];
			}
			$this->sm->assign('pro',$pro);
			$this->sm->view('admin/product/lists.html');
		}
	}

	//树形结构
	public function tree($func=''){
		$post = $this->input->post();
		if($func=='rename'){
			$this->db->update('product',array('title'=>$post['name']),array('p_id'=>$post['id']));
		}elseif($func=='add_node'){
			$title = $post['cat_id']?'新建产品':'新建分类';
			$res = $this->product_model->add(array('title'=>$title,'cat_id'=>$post['cat_id']));
			if($res){
				echojson('1','');
			}else{
				echojson('0','');
			}
		}elseif($func=='remove'){
			$this->db->delete('product',array('p_id'=>intval($post['id'])));
		}elseif($func=='change_order'){
			$id1 = intval($post['id_one']);
			$id2 = intval($post['id_two']);
			$type = trim($post['type']);
			$pid = trim($post['pid']);
			$this->product_model->change_order($id1,$id2,$type,$pid);
		}else{
			$this->sm->view('admin/product/tree.html');
		}
	}

	//获取树节点单json
	public function tree_json($pid=0){
		$tree_nodes = array();
		$this->db->order_by('sort asc');
		$cat = $this->db->get_where('product',array('cat_id'=>0))->result_array();
		foreach($cat as $v){
			$temp['id'] = $v['p_id'] ;
			$temp['pId'] = 0 ;
			$temp['name'] = $v['title'] ;
			$temp['open'] = true ;
			$temp['dropInner'] = true;
			$temp['add'] = true;
			$tree_nodes[] = $temp;
			$this->db->order_by('sort asc');
			$pro = $this->db->get_where('product',array('cat_id'=>$v['p_id']))->result_array();
			foreach($pro as $v1){
				$temp1['id'] = $v1['p_id'] ;
				$temp1['pId'] = $v['p_id'] ;
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
