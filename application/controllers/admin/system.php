<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class System extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function menu($func=""){
		$get = $this->input->get();
		$post = $this->input->post();
		if($func=="get_info"){//获取菜单详情
			$menu_info = $this->db->get_where('menu',array('id'=>intval($get['id'])))->row_array();
			echojson('1',$menu_info);
		}elseif($func == 'get_content_options'){//获取可供选择的菜单选项
			if(intval($get['type']) == '1'){
				$art_cat = $this->db->get('single')->result_array();
			}else{
				$art_cat = $this->db->get_where('article',array('cat_id'=>0))->result_array();
			}
			echojson('1',$art_cat);
		}elseif($func == 'doedit'){//修改菜单地址
			$res = $this->db->update('menu',array('title'=>$post['title'],'url'=>$post['url']),array('id'=>intval($post['id'])));
			if($res){
				echojson('1',$res,'修改成功');
			}else{
				echojson('0',$res,'修改失败');
			}
		}else{
			$this->load->config('site',true);
			$site_config = $this->config->item('site');
			$this->sm->assign('site_config',$site_config);
			$this->sm->display('admin/system/menu.html');
		}
	}

	//菜单树形结构
	public function tree($func=''){
		$this->load->model('menu_model');
		$post = $this->input->post();
		if($func=='rename'){
			$this->db->update('menu',array('title'=>$post['name']),array('id'=>$post['id']));
		}elseif($func=='add_node'){
			$title = '新建菜单';
			$res = $this->menu_model->add(array('title'=>$title,'cat_id'=>$post['cat_id']));
			if($res){
				echojson('1','');
			}else{
				echojson('0','');
			}
		}elseif($func=='remove'){
			$this->db->delete('menu',array('car_id'=>intval($post['id'])));
		}elseif($func=='change_order'){
			$id1 = intval($post['id_one']);
			$id2 = intval($post['id_two']);
			$type = trim($post['type']);
			$pid = trim($post['pid']);
			$this->menu_model->change_order($id1,$id2,$type,$pid);
		}else{
			$this->sm->view('admin/menu/tree.html');
		}
	}

	//获取菜单树节点单json
	public function tree_json($pid=0){
		$tree_nodes = array();
		$this->db->order_by('sort asc');
		$cat = $this->db->get_where('menu',array('cat_id'=>0))->result_array();
		foreach($cat as $v){
			$temp['id'] = $v['id'] ;
			$temp['pId'] = 0 ;
			$temp['name'] = $v['title'] ;
			$temp['open'] = true ;
			$temp['dropInner'] = true;
			$temp['add'] = true;
			$tree_nodes[] = $temp;
			$this->db->order_by('sort asc');
			$menu = $this->db->get_where('menu',array('cat_id'=>$v['id']))->result_array();
			foreach($menu as $v1){
				$temp1['id'] = $v1['id'] ;
				$temp1['pId'] = $v['id'] ;
				$temp1['name'] = $v1['title'] ;
				$temp1['dropInner'] = true;
				$temp1['add'] = false;
				$tree_nodes[] = $temp1;
			}

		}
		//var_dump($tree_nodes);exit;
		echojson(1,$tree_nodes);
	}

	//单页管理
	public function single($func = '',$sin_id=0){
		$post = $this->input->post();
		$sin_id = intval($sin_id); 
		if($func == 'add'){
			$this->sm->display('admin/system/single_add.html');
		}elseif($func == 'doadd'){
			$res = $this->db->insert('single',$post);
			if($res){
				echojson('1',$res,'添加成功');
			}else{
				echojson('0',$res,'添加失败');
			}
		}elseif($func == 'edit'){
			$sin_info = $this->db->get_where('single',array('id'=>$sin_id))->row_array();
			$this->sm->assign('sin_info',$sin_info);
			$this->sm->display('admin/system/single_edit.html');
		}elseif($func == 'doedit'){
			$res = $this->db->update('single',$post,array('id'=>$sin_id));
			if($res){
				echojson('1',$res,'修改成功');
			}else{
				echojson('0',$res,'修改失败');
			}
		}elseif($func == 'dodel'){
			$res = $this->db->delete('single',array('id'=>$sin_id));
			if($res){
				echojson('1',$res,'删除成功');
			}else{
				echojson('0',$res,'删除失败');
			}
		}else{
			$single = $this->db->get('single')->result_array();
			$this->sm->assign('single',$single);
			$this->sm->display('admin/system/single.html');
		}
	}

	//首页动画
	public function nav_img($func=''){
		if($func == 'insert'){
			$url_arr = $this->input->post('urls');
			foreach($url_arr as $v){
				$this->db->insert('nav_img',array('url'=>$v));
			}
			echojson('1','','添加成功');
		}elseif($func== 'edit'){

		}else{
			$data['imgs'] = $this->db->get('nav_img')->result_array();
			$this->load->library('qn');
			$data['token'] = $this->qn->getToken();
			$this->sm->assign($data);
			$this->sm->display('admin/system/nav_img.html');
		}
	}

	//环境信息
	public function evn(){
		phpinfo();
	}
}
