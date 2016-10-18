<?php

/*
 *一个简单的php解析md的类
 */
class MdTpl {

	//普通的文字皮肤
	public $text_skin = 'default';

	//记录存在的代码高亮显示的包
	private $has_code = false;
	//代码高亮显示的皮肤
	public $code_skin = 'emacs';
	//静态文件和皮肤的保存位置
	public $static_dir = '/static';

	//核心的解析模板方法
	private function _tpl ($str){
		$str = preg_replace_callback('/^-{3,}/m','self::_replace_hr',$str);
		$str = preg_replace_callback('/^(#+)\s(.*)/m','self::_replace_title',$str);
		$str = preg_replace_callback('/^>(.*)/m','self::_replace_vicetitle',$str);
		$str = preg_replace_callback('/^-\s(.*)/m','self::_replace_li',$str);
		$str = preg_replace_callback('/^\s{2}-(.*)/m','self::_replace_li2',$str);
		$str = preg_replace_callback('/\[(\s|x)\]/m','self::_replace_checkbox',$str);
		$str = preg_replace_callback('/~~(.*)~~/Us','self::_replace_delete',$str);
		$str = preg_replace_callback('/==(.*)==/Us','self::_replace_mark',$str);
		$str = preg_replace_callback('/\*\*(.*)\*\*/Us','self::_replace_bold',$str);
		$str = preg_replace_callback('/\*(.*)\*/Us','self::_replace_italic',$str);
		$str = preg_replace_callback('/\+\+(.*)\+\+/Us','self::_replace_underline',$str);
		$str = preg_replace_callback('/```(.*) (.*)```/Us','self::_replace_code',$str);

		return $str;

	}



	//换行的替换
	private function _replace_hr($param){
		return '<hr></hr>';
	}

	//子标题的替换
	private function _replace_vicetitle($param){
		return 
			'<blockquote data-source-line="3">
			<p>'.$param[1].'</p>
			</blockquote>';
	}

	//匹配删除线
	private function _replace_delete($param){
		return '<s>'.$param[1].'</s>';
	}

	//高亮替换
	private function _replace_mark($param){
		return '<mark>'.$param[1].'</mark>';
	}

	//粗体替换
	private function _replace_bold($param){
		return '<b>'.$param[1].'</b>';
	}

	//斜体替换
	private function _replace_italic($param){
		return '<i>'.$param[1].'</i>';
	}

	//下划线替换
	private function _replace_underline($param){
		return '<ins>'.$param[1].'</ins>';
	}

	//匹配列表
	private function _replace_li($param){
		return '<li>'.$param[1].'</li>';
	}
	private function _replace_li2($param){
		return '<dd>'.$param[1].'</dd>';
	}

	//对选择框的替换
	private function _replace_checkbox($param){
		if($param[1] == 'x'){
			return '<input type="checkbox" checked="checked"/>';
		}elseif($param[1] == ' '){
			return '<input type="checkbox"/>';
		}
	}


	//对代码的替换
	private function _replace_code($param){
		$str = '';
		//加载公共的文件
		if(!$this->has_code){
			$str = '<script type="text/javascript" src="'.$this->static_dir.'/sl/scripts/shCore.js"></script>';
			$str .= '<link type="text/css" rel="stylesheet" href="'.$this->static_dir.'/sl/styles/shCore'.ucfirst($this->code_skin).'.css"/>';
			$str .= '<script type="text/javascript">SyntaxHighlighter.config.bloggerMode = true;SyntaxHighlighter.all();</script>';
		}
		//加载此类的文件
		if(! isset($this->has_code[$param[1]])){
			$str .= '<script type="text/javascript" src="'.$this->static_dir.'/sl/scripts/shBrush'.ucfirst($param[1]).'.js"></script>';
			$this->has_code[$param[1]] = true;
		}
		return $str.'<pre class="brush:'.$param[1].'">'.$param[2].'</pre>';
	}

	//对主标题的替换
	private function _replace_title($param){
		$level = strlen($param[1]);
		return '<h'.$level.'>'.$param[2].'</h'.$level.'>';
	}

	/*
	 *外部调用的解析函数
	 *$str:需要解析的文件名或者字符串
	 *$view:显示||返回
	 *$type:默认为字符串，file时为文件
	 */
	public function display($str,$view=false,$type='str'){
		if($type == 'file'){
			if(file_exists($str)){
				$str = file_get_contents($str);
			}
		}else{
			$str = strval($str);
		}
		//如果需要支持普通文本皮肤，则加载
		if($this->text_skin){
			$str .= '<link type="text/css" rel="stylesheet" href="'.$this->static_dir.'/sl/'.$this->text_skin.'.css"/>';
		}
		$str = $this->_tpl($str);
		if($view){
			echo $str;
		}else{
			return $str;
		}

	}

}


