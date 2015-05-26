<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class tool extends CI_Controller{
	public $src;
	public $dir;
	public $cr = PHP_EOL;
	public $str = '';
	public function __construct(){
		parent::__construct();
		$this->cr = '/*hh*/'.PHP_EOL;
	}

	public function jieya(){
		$zip = new ZipArchive;
		$file = '../'.$_POST['file'].'.zip';
		$path = '../'.$_POST['path'];
		if(! file_exists($file)){
			exit('找不到此压缩文件');
		}
		if ($zip->open($file) === TRUE) {
			$zip->extractTo($path);
			$zip->close();
			echo '解压成功,请用FTP下载';
		} else {
			echo '解压失败';
		}
	}
	public function yasuo(){
		$sourcePath = $_SERVER['DOCUMENT_ROOT'];
		$outZipPath = $_POST['file'].'.zip';
		$pathInfo = pathInfo($sourcePath); 
		$parentPath = $pathInfo['dirname']; 
		$dirName = $pathInfo['basename']; 
		$sourcePath=$parentPath.'/'.$dirName;//防止传递'folder' 文件夹产生bug 
		$z = new ZipArchive(); 
		$z->open($outZipPath, ZIPARCHIVE::CREATE);//建立zip文件 
		$z->addEmptyDir($dirName);//建立文件夹 
		self::folderToZip($sourcePath, $z, strlen("$parentPath/")); 
		$z->close();
		echo '压缩成功';
	}
	private static function folderToZip($folder, &$zipFile, $exclusiveLength) { 
		$handle = opendir($folder); 
		while (false !== $f = readdir($handle)) { 
			if ($f != '.' && $f != '..') { 
				$filePath = "$folder/$f"; 
				$localPath = substr($filePath, $exclusiveLength); 
				if (is_file($filePath)) { 
					$zipFile->addFile($filePath, $localPath); 
				} elseif (is_dir($filePath)) { 
					// 添加子文件夹 
					$zipFile->addEmptyDir($localPath); 
					self::folderToZip($filePath, $zipFile, $exclusiveLength); 
				} 
			}
		} 
		closedir($handle); 
	}
	public function dump(){
		global $cfg;
		$this->lib('db');
		$tables = $this->db->query("show tables from ".$cfg['dbname']);
		while(($tab = mysql_fetch_row($tables)) !== false){
			$this->str .= "drop table if exists `$tab[0]`;$this->cr";
			$this->get_t_cons($tab[0]);
			$this->get_t_cont($tab[0]);
		}
		$filename = getTime(1).'.sql';
		if(!$this->str){
			exit('数据库没数据');
		}
		if(file_put_contents($filename,$this->str)){
			echo '备份成功，请用FTP下载';
		}

	}
	private function get_t_cons($table){
		$res = mysql_query("show create table $table");
		$sql_cre = mysql_fetch_row($res);
		$this->str .= "$sql_cre[1];$this->cr";
	}
	private function get_t_cont($table){
		$res = mysql_query("select * from $table");
		while($row = mysql_fetch_assoc($res)){
			$this->str .= "insert into $table values (";
			foreach($row as $k ){
				$this->str .= " '".addslashes($k)."',";
			}	
			$this->str = rtrim($this->str,',');
			$this->str .= ");$this->cr";
		}
	}
	public function sqlin(){
		$i = 0;
		$str = file_get_contents($_FILES['sql']['tmp_name']);
		$sqlarr = explode(';/*hh*/',$str);
		array_pop($sqlarr);
		$a = count($sqlarr);
		foreach($sqlarr as $v){
			if($this->db->query($v)){
				$i++;
			}
		}
		echo '共'.$a.'条语句，执行成功'.$i.'条';
	}
}
