<?php
class Article_model extends CI_model{

	//获取所有分类
	public function get_cat($type = 'all'){
		if($type == 'all'){
			$sql = "select AC1.*,AC2.cat_name parent_name,count(A.art_id) art_num from article_cat AC1 
				left join article_cat AC2 on AC1.parent_id = AC2.id 
				left join article A on AC1.id = A.cat_id group by AC1.id
				order by ord asc";
		}else{
			$sql = "select AC1.*,AC2.cat_name parent_name from article_cat AC1 left join article_cat AC2 on AC1.parent_id = AC2.id
				where AC1.parent_id = $type order by ord asc";
		}
		return $this->db->query($sql)->result_array();
	}

	//插入数据
	public function cat_insert($data){
		return $this->db->insert('article_cat',$data);
	}

	//检测是否有子目录
	public function exist_son($cid){
		$sql = "select * from article_cat where parent_id = $cid";
		$res = $this->db->query($sql)->result_array();
		return $res?true:false;
	}

	//检测是否有文章
	public function exist_art($cid){
		$sql = "select * from article where cat_id = $cid";
		$res = $this->db->query($sql)->result_array();
		return $res?true:false;
	}

	//删除文章分类
	public function cat_del($cid){
		if($this->exist_son($cid) == false && $this->exist_art($cid) == false){
			$sql = "delete from article_cat where id = $cid";
			$res = $this->db->query($sql);
			return $res?true:false;
		}else{
			return false;
		}
	}

	//修改文章分类
	public function cat_edit($data,$cid){
		$this->db->where('id', $cid);
		return $this->db->update('article_cat', $data); 
	}







}
