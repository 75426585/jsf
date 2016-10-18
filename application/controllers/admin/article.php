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

	//添加文章分类
	public function add_article_cat(){
		$post = $this->input->post();
		$tag_data['tag_name']= $post['cat_name'];
		$tag_data['tag_parent']= $post['parent_id'];
		$tag_data['tag_type']= 2;
		$res = $this->db->insert('js_tags',$tag_data);
		if($res){
			echojson('1');
		}else{
			echojson('0');
		}
	}

	//添加文章标签
	public function add_article_tag(){
		$tag_data['tag_name'] = $this->input->post('tag_name');
		$tag_data['tag_type']= 1;
		$res = $this->db->insert('js_tags',$tag_data);
		if($res){
			echojson('1');
		}else{
			echojson('0');
		}
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
			$this->sm->view('admin/article/add.html');
		}elseif($function == 'do'){
			$post = $this->input->post();
			$posts_data['post_id'] = $post['post_id'];
			$posts_data['title'] = htmlspecialchars($post['title']);
			$posts_data['vicetitle'] =  htmlspecialchars($post['vicetitle']);
			$posts_data['content'] =   htmlspecialchars($post['content']);
			$posts_data['post_status'] = $post['type'];
			$posts_data['create_time'] = time();
			$tags = $post['tags'];
			$res = $this->article_model->edit($posts_data,$tags);
			if($res){
				echojson('1','','添加成功');
			}else{
				echojson('0','','添加失败');
			}
		}elseif($function=='addtitle'){
			$res = $this->article_model->addtitle($title);
			if($res){
				echojson('1',$res,'添加成功');
			}else{
				echojson('0','','添加失败');
			}
		}elseif($function == 'draft'){
			$title = $this->input->post('title');
			$res = $this->db->insert('js_posts',array('title'=>$title));
			if($res){
				$post_id = $this->db->insert_id();
				echojson('1',$post_id,'');
			}else{
				echojson('0','','生成草稿失败');
			}
		}
	}

	//文章删除
	public function dodel($aid){
		$res = $this->db->delete('js_posts',array('id'=>intval($aid)));
		if($res){
			echojson('1','','删除成功！');
		}else{
			echojson('0','','删除失败！');
		}
	}

	//文章修改
	public function edit($article_id=0){
		if(!$article_id) return false;
		$this->load->model('tags_model');
		$cat_tree = $this->article_model->get_cat_tree();
		$all_tags = $this->tags_model->get_all_tags(1);
		$select_tags = $this->tags_model->get_post_tags($article_id);
		$post_data = $this->db->get_where('js_posts',array('id'=>$article_id))->row_array();
		$data = get_defined_vars();
		$this->sm->assign($data);
		$this->sm->view('admin/article/add.html');
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

	//获取某文章的分类情况
	public function json_tag($article_id=0){
		$this->load->model('tags_model');
		$cat_tree = $this->article_model->get_cat_tree();
		$all_tags = $this->tags_model->get_all_tags(1);
		$select_tags = $this->tags_model->get_post_tags($article_id);
		foreach($cat_tree as $k => $v){
			if(in_array($v['id'],$select_tags)){
				$cat_tree[$k]['is_selected'] = true;
			}else{
				$cat_tree[$k]['is_selected'] = false;
			}
		}
		foreach($all_tags as $k => $v){
			if(in_array($v['tag_id'],$select_tags)){
				$all_tags[$k]['is_selected'] = true;
			}else{
				$all_tags[$k]['is_selected'] = false;
			}
		}
		$data['cat_tree'] = $cat_tree;
		$data['all_tags'] = $all_tags;
		echojson(1,$data);
	}
}
