<?php
class Tags_model extends CI_model{

	//查找所有tag标签
	public function get_all_tags($tag_type=0){
		$this->db->select('tag_id,tag_name');
		$this->db->from('js_tags');
		if($tag_type) $this->db->where('tag_type',$tag_type);
		return $this->db->get()->result_array();
	}

	//查找某个文章tag标签
	public function get_post_tags($post_id=0){
		$this->db->from('js_post_tag');
		$this->db->where('post_id',$post_id);
		$res = $this->db->get()->result_array();
		$tags = array();
		if($res){
			foreach($res as $v){
				$tags[] = $v['tag_id'];
			}
		}
		return  $tags;
	}
}
