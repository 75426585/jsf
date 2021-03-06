<?php
class Menu_model extends CI_model{

	//添加文章分类
	public function cat_add($name){
		$res = $this->db->insert('menu',array('title'=>$name));
		if($res){
			$id = $this->db->insert_id();
			$this->db->update('menu',array('sort'=>$id),array('id'=>$id));
			return true;
		}else{
			return false;
		}
	}

	//删除文章分类
	public function cat_del($cid){
		$has_menu = $this->db->get_where('menu',array('cat_id'=>$cid))->result_array();
		if($has_menu) return false;
		return $this->db->delete('menu',array('id'=>$cid));
	}

	//添加文章
	public function add($data){
		$res = $this->db->insert('menu',$data);
		if($res){
			$id = $this->db->insert_id();
			$this->db->update('menu',array('sort'=>$id),array('id'=>$id));
			return true;
		}else{
			return false;
		}
	}

	//调换顺序$id1为被拖动的id，$id2为放置位置的id,$pid为放置的父id
	public function change_order($id1,$id2,$type,$pid){
		$this->load->model('log_model');
		$info1 = $this->db->get_where('menu',array('id'=>$id1))->row_array();
		$info2 = $this->db->get_where('menu',array('id'=>$id2))->row_array();
		$sort1 = $info1['sort'];
		$sort2 = $info2['sort'];
		$this->db->trans_start();
		if($sort1  > $sort2){//往前挪
			if($type=='prev'){
				$this->db->query("update menu set sort = sort + 1 where sort between {$sort2} and $sort1");
				$this->db->query("update menu set sort = {$info2['sort']},cat_id = {$pid} where id = $id1");
			}elseif($type=='next'){
				$this->db->query("update menu set sort = sort + 1 where sort between ".($sort2+1)." and $sort1");
				$this->db->query('update menu set sort = '.($info2['sort']+1).",cat_id = {$pid} where id = $id1");
			}elseif($type =='inner'){
				$this->db->query("update menu set cat_id = {$id2} where id = $id1");
			}
		}else{//往后挪
			if($type=='prev'){
				$this->db->query("update menu set sort = sort - 1 where sort between ".$sort1 ." and ".($sort2-1));
				$this->db->query("update menu set sort = ".($sort2-1).",cat_id = {$pid} where id = $id1");
			}elseif($type=='next'){
				$this->db->query("update menu set sort = sort - 1 where sort between $sort1 and $sort2" );
				$this->db->query("update menu set sort = {$info2['sort']},cat_id = {$pid} where id = $id1");
			}elseif($type =='inner'){
				$this->db->query("update menu set cat_id = {$id2} where id = $id1");
			}
		}
		$this->db->trans_complete(); 
		if ($this->db->trans_status()){
			echojson('1','');
		}else{
			echojson('0','');
		}
		//$res = $this->db->query("select sort from menu")->result_array();
		/*
		$data = array('id1'=>$id1,'id2'=>$id2,'sort1'=>$sort1,'sort2'=>$sort2,'type'=>$type,'sql'=>$this->db->last_query());
		$r = array();
		foreach($res as $v){
			$r[] = $v['sort'];
		}
		$res = implode(',',$r);
		$this->log_model->log($data);
		$this->log_model->log($res);
		 */
	}
}
