<?php
class log_model extends CI_model{
	public function log($data){
		$date = date('Ymd');
		$file = $_SERVER['SITE_LOG_DIR'].'/'.$date.'.log';
		if(! is_dir($_SERVER['SITE_LOG_DIR'])){
			mkdir($_SERVER['SITE_LOG_DIR'],0777,true);
		}
		file_put_contents($file,var_export($data,true),FILE_APPEND);
	}

}
