<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload extends MY_Controller {
	public $url_prefix = 'http://img.je4.cn/';//图片域名前缀
	public function index(){
		$this->sm->view('upload/index.php');
	}

	//kindeditor 编辑器上传使用
	public function kind(){
		//定义允许上传的文件扩展名
		$ext_arr = array(
			'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
			'flash' => array('swf', 'flv'),
			'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
			'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
		);
		//最大文件大小
		$max_size = 1000000;

		//PHP上传失败
		if (!empty($_FILES['imgFile']['error'])) {
			switch($_FILES['imgFile']['error']){
			case '1':
				$error = '超过php.ini允许的大小。';
				break;
			case '2':
				$error = '超过表单允许的大小。';
				break;
			case '3':
				$error = '图片只有部分被上传。';
				break;
			case '4':
				$error = '请选择图片。';
				break;
			case '6':
				$error = '找不到临时目录。';
				break;
			case '7':
				$error = '写文件到硬盘出错。';
				break;
			case '8':
				$error = 'File upload stopped by extension。';
				break;
			case '999':
			default:
				$error = '未知错误。';
			}
			alert($error);
		}

		//有上传文件时
		if (empty($_FILES) === false) {
			//原文件名
			$file_name = $_FILES['imgFile']['name'];
			//服务器上临时文件名
			$tmp_name = $_FILES['imgFile']['tmp_name'];
			//文件大小
			$file_size = $_FILES['imgFile']['size'];
			//检查文件名
			if (!$file_name) {
				alert("请选择文件。");
			}
			if ($file_size > $max_size) {
				alert("上传文件大小超过限制。");
			}
			//获得文件扩展名
			$temp_arr = explode(".", $file_name);
			$file_ext = array_pop($temp_arr);
			$file_ext = trim($file_ext);
			$file_ext = strtolower($file_ext);
			//检查扩展名
			$dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
			if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
				$this->alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
			}
			$this->load->library('qn');
			$key = $this->qn->upload('imgFile');
			if(! $key) $this->alert("上传失败");
			$url = $this->url_prefix.$key;
			header('Content-type: text/html; charset=UTF-8');
			echo json_encode(array('error' => 0, 'url' => $url));
			exit;
		}

	}

	public function alert($msg){
		header('Content-type: text/html; charset=UTF-8');
		echo json_encode(array('error' => 1, 'message' => $msg));
		exit;
	}

	//plupload上传接口
	public function qn($file='file'){
		$this->load->library('qn');
		$data['key'] = $this->qn->upload($file);
		echo json_encode($data);
	}











}
