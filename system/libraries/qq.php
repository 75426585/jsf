<?php
define('CLASS_PATH',__DIR__.'/qq/');
require_once("qq/QC.class.php");
//QQ登陆
class CI_qq{
	public $qc;
	public function __construct(){
		$this->qc = new QC();
	}

}
