<?php
class Article_model extends CI_model{

	//添加文章分类
	public function cat_add($name){
		$res = $this->db->insert('article_cat',array('name'=>$name));
		if($res){
			$id = $this->db->insert_id();
			$this->db->update('article_cat',array('sort'=>$id),array('id'=>$id));
			return true;
		}else{
			return false;
		}
	}

	//删除文章分类
	public function cat_del($cid){
		$has_article = $this->db->get_where('article',array('cat_id'=>$cid))->result_array();
		if($has_article) return false;
		return $this->db->delete('article_cat',array('id'=>$cid));
	}
}
