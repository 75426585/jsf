<?php
require_once __DIR__.'/qn/autoload.php';

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class CI_qn{
	public $bucket;
	public $err;
	public $res;
	public $auth;
	public $bucketMgr;
	public $token;
	public function __construct(){
		$this->accessKey = $_SERVER['QN_AK'];
		$this->secretKey = $_SERVER['QN_SK'];
		$this->bucket= $_SERVER['QN_BK'];
		$this->auth = new Auth($this->accessKey, $this->secretKey);
		$this->bucketMgr = New BucketManager($this->auth);
	}

	//获取文件的属性
	public function info($file=''){
		list($this->res,$this->err) = $this->bucketMgr->stat($this->bucket,$file);
		if ($this->err !== null) {
			return false;
		} else {
			return $this->res;
		}
	}

	//复制文件
	public function copy($res_file,$des_file){
		$err =  $this->bucketMgr->copy($this->bucket,$res_file,$this->bucket,$des_file);
		if ($err !== null) {
			return $err;
		} else {
			return true;
		}
	}

	//移动文件
	public function move($res_file,$des_file){
		$err = $this->bucketMgr->move($this->bucket,$res_file,$this->bucket,$des_file);
		if ($err !== null) {
			return $err;
		} else {
			return true;
		}
	}

	//删除文件
	public function delete($file){
		$err = $this->bucketMgr->delete($this->bucket,$file);
		if ($err !== null) {
			return $err;
		} else {
			return true;
		}
	}

	//列举出文件
	public function listFiles($prefix = ''){
		$err = $this->bucketMgr->listFiles($this->bucket,$prefix);
		if ($err !== null) {
			return $err[0];
		} else {
			return true;
		}
	}

	//获取token
	public function getToken(){
		$this->token = $this->auth->uploadToken($this->bucket,null,3600);
		return $this->token;
	}

	//上传文件
	public function upload($file,$new_name = ''){
		if(!(isset($_FILES[$file]['error']) && $_FILES[$file]['error'] == '0')) return false;
		$tmp_name = $_FILES[$file]['tmp_name'];
		$file_info = pathinfo($_FILES[$file]['name']);
		if($new_name == ''){
			$data_str = date('YmdHis');
			$new_name = $data_str.'_'.rand(10000,99999).'.'.$file_info['extension'];
		}
		$this->getToken();
		$uploadMgr = New UploadManager();
		$upres = $uploadMgr->putFile($this->token,$new_name,$tmp_name);
		if (! isset($upres[0]['key'])) {
			return false;
		} else {
			return $upres[0]['key'];
		}

	}

}

