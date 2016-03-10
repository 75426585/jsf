<?php
class Article_model extends CI_model{

	public static $cat_tree;
	//获取文章分类树
	public function get_cat_tree($parent_id = 0,$level = 0){
		$this->db->where('tag_parent',$parent_id);
		$this->db->where('tag_type',2);
		$cat = $this->db->get('js_tags')->result_array();
		if(! $cat) return false;
		$level++;
		foreach($cat as $v){
			self::$cat_tree[] = array('id'=>$v['tag_id'],'name'=>$v['tag_name'],'level'=>$level,'pId'=>$v['tag_parent']);
			$this->get_cat_tree($v['tag_id'],$level);
		}
		return self::$cat_tree;
	}

	//添加文章分类
	public function cat_add($name){
		$res = $this->db->insert('js_post_cat',array('title'=>$name));
		if($res){
			$id = $this->db->insert_id();
			$this->db->update('article',array('sort'=>$id),array('id'=>$id));
			return true;
		}else{
			return false;
		}
	}

	//删除文章分类
	public function cat_del($cid){
		$has_article = $this->db->get_where('article',array('cat_id'=>$cid))->result_array();
		if($has_article) return false;
		return $this->db->delete('article',array('id'=>$cid));
	}

	//添加文章
	public function edit($data,$tags = array()){
		$post_id = $data['post_id'];
		if(!$post_id) return false;
		unset($data['post_id']);
		$this->db->trans_begin();
		$this->db->update('js_posts',$data,array('id'=>$post_id));
		$this->db->delete('js_post_tag',array('post_id'=>$post_id));
		foreach($tags as $v){
			$this->db->insert('js_post_tag',array('post_id'=>$post_id,'tag_id'=>$v));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	//添加文章
	public function addtitle($title){
		$res = $this->db->insert('js_posts',$data);
		if($res){
			$id = $this->db->insert_id();
			$this->db->update('article',array('sort'=>$id),array('id'=>$id));
			return $id;
		}else{
			return false;
		}
	}

	//调换顺序$id1为被拖动的id，$id2为放置位置的id,$pid为放置的父id
	public function change_order($id1,$id2,$type,$pid){
		$this->load->model('log_model');
		$info1 = $this->db->get_where('article',array('id'=>$id1))->row_array();
		$is_top = $info1['cat_id'] == 0 ? true : false;
		$info2 = $this->db->get_where('article',array('id'=>$id2))->row_array();
		$sort1 = $info1['sort'];
		$sort2 = $info2['sort'];
		$this->db->trans_start();
		if((! $is_top) && $type != 'inner') $this->db->query("update article set cat_id = {$pid} where id = $id1");
		if($sort1  > $sort2){//往前挪
			if($type=='prev'){
				$this->db->query("update article set sort = sort + 1 where sort between {$sort2} and $sort1");
				$this->db->query("update article set sort = {$info2['sort']} where id = $id1");
			}elseif($type=='next'){
				$this->db->query("update article set sort = sort + 1 where sort between ".($sort2+1)." and $sort1");
				$this->db->query('update article set sort = '.($info2['sort']+1)." where id = $id1");
			}elseif($type =='inner'){
				$this->db->query("update article set cat_id = {$id2} where id = $id1");
			}
		}else{//往后挪
			if($type=='prev'){
				$this->db->query("update article set sort = sort - 1 where sort between ".$sort1 ." and ".($sort2-1));
				$this->db->query("update article set sort = ".($sort2-1)." where id = $id1");
			}elseif($type=='next'){
				$this->db->query("update article set sort = sort - 1 where sort between $sort1 and $sort2" );
				$this->db->query("update article set sort = {$info2['sort']} where id = $id1");
			}elseif($type =='inner'){
				$this->db->query("update article set cat_id = {$id2} where id = $id1");
			}
		}
		$this->db->trans_complete(); 
		if ($this->db->trans_status()){
			echojson('1','');
		}else{
			echojson('0','');
		}
	}
}
