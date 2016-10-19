<?php

/**
* Description : 分页类封装
* Author      : jishuai
* Created Time: 2015-04-08 13:29
*/
class page{
	public $total_num;//总数据量
	public $per_num;//每页数据量
	public $base_url='?';//基础链接地址
	public $num_links = 2;//当前页前后链接的个数
	public $type = 0;//显示的样式
	public $argu = 'p';//页码的参数设置

	public function __construct(){
	}

	/*生成普通的页码样式*/
	//$parms array 页码填上一些参数
	public function create($total,$per_page,$parms=array(),$style="page"){
		$CI =& get_instance();
		$CI->load->library('pagination');
		$CI->load->config ( 'page', true );
		$config = $CI->config->item ($style);
		$config ['page_query_string'] = TRUE;
		$get = $CI->input->get();
		unset($get['page']);
		$url_str = '?';
		foreach($parms as $k => $v){
			unset($get[$k]);
			$url_str .= $k.'='.$v.'&';
		}
		$config ['base_url'] = $url_str.http_build_query($get ? $get : array());
		$config ['total_rows'] = $total;
		$config ['per_page'] = $per_page;
		$config['cur_tag_open'] = '&nbsp;<a class="current_page">';
		$config['cur_tag_close'] = '</a>';
		$CI->pagination->initialize($config); 

		return $CI->pagination->create_links();
	}

	//生成ajax页码的连接(多了一个当前页码的状态)
	public function create_ajax($total,$per_page,$cur_page,$parms=array(),$style="page"){
		$CI =& get_instance();
		$CI->load->library('pagination');
		$CI->load->config ( 'page', true );
		$config = $CI->config->item ($style);
		$config ['page_query_string'] = TRUE;
		$get = $CI->input->get();
		unset($get['page']);
		$url_str = '?';
		foreach($parms as $k => $v){
			unset($get[$k]);
			$url_str .= $k.'='.$v.'&';
		}
		$config ['base_url'] = $url_str.http_build_query($get ? $get : array());
		$config ['total_rows'] = $total;
		$config ['per_page'] = $per_page;
		$config['uri_segment'] = 5;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$CI->pagination->initialize($config); 

		return $CI->pagination->create_links();
	}
}

