<?php
class Product_model extends CI_model{

	//添加产品分类
	public function cat_add($name){
		$res = $this->db->insert('product',array('title'=>$name));
		if($res){
			$id = $this->db->insert_id();
			$this->db->update('product',array('sort'=>$id),array('id'=>$id));
			return true;
		}else{
			return false;
		}
	}

	//删除产品分类
	public function cat_del($cid){
		$has_product = $this->db->get_where('product',array('cat_id'=>$cid))->result_array();
		if($has_product) return false;
		return $this->db->delete('product',array('p_id'=>$cid));
	}

	//添加产品
	public function add($data){
		$pro_data['title'] = $data['title'];
		$pro_data['cat_id'] = (int)$data['cat_id'];
		$pro_data['content'] = isset($data['content'])?$data['content']:'';
		$imgs_str = strval(isset($data['imgs'])?$data['imgs']:'');
		$imgs_arr = explode(',',$imgs_str);
		$imgs_arr = array_filter($imgs_arr);
		$res = $this->db->insert('product',$pro_data);
		if($res){
			$id = $this->db->insert_id();
			$this->db->update('product',array('sort'=>$id),array('p_id'=>$id));
			foreach($imgs_arr as $v){
				$this->db->update('pro_img',array('pro_id'=>$id),array('id'=>$v));
			}
			return true;
		}else{
			return false;
		}
	}

	//调换顺序$id1为被拖动的id，$id2为放置位置的id,$pid为放置的父id
	public function change_order($id1,$id2,$type,$pid){
		$this->load->model('log_model');
		$info1 = $this->db->get_where('product',array('id'=>$id1))->row_array();
		$info2 = $this->db->get_where('product',array('id'=>$id2))->row_array();
		$sort1 = $info1['sort'];
		$sort2 = $info2['sort'];
		$this->db->trans_start();
		if($sort1  > $sort2){//往前挪
			if($type=='prev'){
				$this->db->query("update product set sort = sort + 1 where sort between {$sort2} and $sort1");
				$this->db->query("update product set sort = {$info2['sort']},cat_id = {$pid} where id = $id1");
			}elseif($type=='next'){
				$this->db->query("update product set sort = sort + 1 where sort between ".($sort2+1)." and $sort1");
				$this->db->query('update product set sort = '.($info2['sort']+1).",cat_id = {$pid} where id = $id1");
			}elseif($type =='inner'){
				$this->db->query("update product set cat_id = {$id2} where id = $id1");
			}
		}else{//往后挪
			if($type=='prev'){
				$this->db->query("update product set sort = sort - 1 where sort between ".$sort1 ." and ".($sort2-1));
				$this->db->query("update product set sort = ".($sort2-1).",cat_id = {$pid} where id = $id1");
			}elseif($type=='next'){
				$this->db->query("update product set sort = sort - 1 where sort between $sort1 and $sort2" );
				$this->db->query("update product set sort = {$info2['sort']},cat_id = {$pid} where id = $id1");
			}elseif($type =='inner'){
				$this->db->query("update product set cat_id = {$id2} where id = $id1");
			}
		}
		$this->db->trans_complete(); 
		if ($this->db->trans_status()){
			echojson('1','');
		}else{
			echojson('0','');
		}
		//$res = $this->db->query("select sort from product")->result_array();
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
