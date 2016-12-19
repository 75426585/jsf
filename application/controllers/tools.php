<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tools extends CI_Controller {
	public function index(){
		$current_date = date('Y-m-d H:i:s');
		$current_time = time();
		$current_year = date('Y');
		$current_month = date('m');
		$current_day = date('d');
		$current_hour = date('H');
		$current_minute = date('i');
		$current_second = date('s');

		//转换为时间戳
		if(isset($_GET['year']) && $_GET['year']){
			$current_year = (int) $_GET['year'];
			$current_month = (int) $_GET['month'];
			$current_day = (int) $_GET['day'];
			$current_hour = (int) $_GET['hour'];
			$current_minute = (int) $_GET['minute'];
			$current_second = (int) $_GET['second'];

			$str = $current_year.'-'.$current_month.'-'.$current_day.' '.$current_hour.':'.$current_minute.':'.$current_second;

			$str_to_time = strtotime($str);
		}elseif(isset($_GET['timestamp']) && $_GET['timestamp']){
			
			$timestamp = (int) $_GET['timestamp'];
			$time_to_str = date('Y-m-d H:i:s',$timestamp);

		}elseif(isset($_GET['md5_str']) && $_GET['md5_str']){
			
			$md5_str = trim($_GET['md5_str']);
			$md5_val_lower = md5($md5_str);
			$md5_val_upper = strtoupper($md5_val_lower);
		}

		$data = get_defined_vars();
		$this->sm->assign($data);
		$this->sm->view('tools/tools.html');
	}
}
