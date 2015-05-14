<?php
/*SAE的storage的图床应用*/
class img{
	public $domain;//storage的域名地址
	public $tmpPath = 'temp/';//缓存目录
	static $ss;//storage的对象
	public $filePath;//文件的路径及名字
	private $pathInfo;
	public $fileName;
	public $thumbTruthName;

	//初始化数据
	public function __construct($domain){
		$this->domain = $domain;
		$this->filePath = ltrim($_SERVER['PATH_INFO'],'/');
		$this->pathInfo = pathinfo($_SERVER['QUERY_STRING']);
		$fileInfo = pathinfo($this->filePath);
		$this->truthName = $fileInfo['filename'];
		$this->extension = $fileInfo['extension'];
		$this->thumbTruthName = $this->tmpPath.$this->truthName.'-'.$this->pathInfo['basename'].'.'.$this->extension;
		self::$ss = new SaeStorage();
	}

	//检测文件是否存在$type=1:源文件，$type=2:缩略图文件
	public function checkExists($type='1'){
		if($type == '1'){
			$fileName=$this->filePath;
		}else{
			$fileName=$this->thumbTruthName;
		}
		$res = self::$ss->fileExists($this->domain,$fileName);
		if($res){
			return true;
		}else{
			return false;
		}
	}

	//对接受的数据进行分析处理
	public function proceGet(){
		$tmpArr = explode('-',$this->pathInfo['basename']);
		$width = '';
		$height = '';
		$type = '';
		foreach($tmpArr as $v){
			if($v[0] == 'w'){
				$width = str_replace('w','',$v);
				continue;
			}	
			if($v[0] == 'h'){
				$height = str_replace('h','',$v);
				continue;
			}	
			if($v[0] == 't'){
				$type = str_replace('t','',$v);
				continue;
			}
		}
		return array('width'=>$width,'height'=>$height,'type'=>$type);
	}

	//生成缩略图
	public function createThumb(){
		$size = $this->proceGet();
		$imgStr = self::$ss->read($this->domain,$this->filePath);
		$sourceImg = imagecreatefromstring($imgStr);
		$sourceImgW = imagesx($sourceImg);
		$sourceImgH = imagesy($sourceImg);
		$newImg = imagecreatetruecolor($size['width'],$size['height']);
		$sourceImg = imagecreatefromstring(self::$ss->read($this->domain,$this->filePath)); 
		imagecopyresampled($newImg,$sourceImg, 0, 0,0,0,$size['width'],$size['height'],$sourceImgW,$sourceImgH);
		ob_start();
		imagejpeg($newImg);
		$newString = ob_get_contents();
		$result = self::$ss->write($this->domain,$this->thumbTruthName,$newString);
		ob_end_clean();
		if($result){
			return $result;
		}else{
			echo self::$ss->errmsg();
			return false;
		}
	}

	//输出图像
	public function showImg($type){
		if($type == '1'){
			$fileName=$this->filePath;
		}else{
			$fileName=$this->thumbTruthName;
		}
		header('Content-Type: image/jpeg');
		echo self::$ss->read($this->domain,$fileName);
	}

}
