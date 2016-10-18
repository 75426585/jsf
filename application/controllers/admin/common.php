<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  Common extends MY_Controller{
	public function __construct(){
		parent::__construct();
	}

	//获取产品图片
	public function get_pro_img($pro_id){
		$pro_id = (int)$pro_id;
		$imgs = $this->db->get_where('pro_img',array('pro_id'=>$pro_id))->result_array();
		echojson('1',$imgs,'查询成功');
	}

	//获取暂无修改图片产品id的
	public function get_tmp_img(){
		$imgs = $this->db->get_where('pro_img',array('pro_id'=>'-1'))->result_array();
		echojson('1',$imgs,'查询成功');
	}

	//删除图片
	public function del_pro_img($id){
		$id = (int)$id;
		$imgs = $this->db->delete('pro_img',array('id'=>$id));
		echojson('1',$imgs,'删除成功');
	}
}
