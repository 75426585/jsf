<?php
class Article_model extends CI_model{

	//获取所有分类
	public function get_cat($type = 'all'){
		if($type == 'all'){
			$sql = "select AC1.*,AC2.cat_name parent_name from article_cat AC1 left join article_cat AC2 on AC1.parent_id = AC2.id order by ord asc";
		}else{
			$sql = "select AC1.*,AC2.cat_name parent_name from article_cat AC1 left join article_cat AC2 on AC1.parent_id = AC2.id
			  	where AC1.parent_id = $type order by ord asc";
		}
		return $this->db->query($sql)->result_array();
	}

}
