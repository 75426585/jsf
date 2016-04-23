<?php
class Tags_model extends CI_model{

	//查找所有tag标签
	public function get_all_tags($tag_type=0){
		$this->db->select('tag_id,tag_name');
		$this->db->from('js_tags');
		if($tag_type) $this->db->where('tag_type',$tag_type);
		return $this->db->get()->result_array();
	}

	//查找文章tag标签
	public function get_post_tags($post_id=0,$tag_type=0){
		$this->db->join('js_tags','js_post_tag.tag_id = js_tags.tag_id','left');
		if(is_array($post_id)){
			$this->db->where_in('post_id',$post_id);
		}else{
			$this->db->where('post_id',$post_id);
		}
		if($tag_type) $this->db->where('tag_type',$tag_type);
		$tags_info = $this->db->get('js_post_tag')->result_array();
		if(is_array($post_id) && $tags_info){
			foreach($tags_info as $v){
				$tags_info_tmp[$v['post_id']][] = $v['tag_name'];
			}
			return  $tags_info_tmp;
		}
		return $tags_info;
	}

}
