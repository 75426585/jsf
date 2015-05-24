<?php /* Smarty version Smarty-3.1.18, created on 2015-05-24 09:22:29
         compiled from "application\views\upload\plupload.php" */ ?>
<?php /*%%SmartyHeaderCode:227265561106c988e97-13054943%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e08724eb982b7adb6851d0578764f11ab8aa3e21' => 
    array (
      0 => 'application\\views\\upload\\plupload.php',
      1 => 1432430545,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '227265561106c988e97-13054943',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5561106c9b7ca0_59768945',
  'variables' => 
  array (
    'token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5561106c9b7ca0_59768945')) {function content_5561106c9b7ca0_59768945($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>最基本的使用——plupload演示demo</title>
	<script src="/static/js/lib/jquery.min.js"></script>
	<script src="/static/js/lib/plupload/plupload.full.min.js"></script>
	<style>
	body{ font-size: 12px;}
	body,p,div{ padding: 0; margin: 0;}
	.wraper{ padding: 30px 0;}
	.btn-wraper{ text-align: center;}
	.btn-wraper input{ margin: 0 10px;}
	#file-list{ width: 350px; margin: 20px auto;}
	#file-list li{ margin-bottom: 10px;}
	.file-name{ line-height: 30px;}
	.progress{ height: 4px; font-size: 0; line-height: 4px; background: orange; width: 0;}
	.tip1{ text-align: center; font-size:14px; padding-top:10px;}
	.tip2{ text-align: center; font-size:12px; padding-top:10px; color:#b00}
	.catalogue{ position: fixed; _position:absolute; _width:200px; left: 0; top: 0; border: 1px solid #ccc;padding: 10px; background: #eee}
	.catalogue a{ line-height: 30px; color: #0c0}
	.catalogue li{ padding: 0; margin: 0; list-style: none;}
	</style>
</head>
<body>
	<div class="wraper">
		<div class="btn-wraper">
			<input type="button" value="选择文件..." id="browse" />
			<input type="button" value="开始上传" id="upload-btn" />
		</div>
		<ul id="file-list">

		</ul>
	</div>
<script>

var uploader = new plupload.Uploader({ //实例化一个plupload上传对象
	browse_button : 'browse',
	url : 'http://up.qiniu.com/',
	flash_swf_url : '/stastic/js/lib/plupload/Moxie.swf',
	silverlight_xap_url : '/stastic/js/lib/plupload/Moxie.xap',
	multipart_params: {
		'token': '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
', 
	},
});

uploader.init(); //初始化

//绑定文件添加进队列事件
uploader.bind('FilesAdded',function(uploader,files){
	for(var i = 0, len = files.length; i<len; i++){
		var file_name = files[i].name; //文件名
		//构造html来更新UI
		var html = '<li id="file-' + files[i].id +'"><p class="file-name">' + file_name + '</p><p class="progress"></p></li>';
		$(html).appendTo('#file-list');
	}
});

//绑定文件上传进度事件
uploader.bind('UploadProgress',function(uploader,file){
	$('#file-'+file.id+' .progress').css('width',file.percent + '%');//控制进度条
});
uploader.bind('FileUploaded',function(uploader,file,responseObject){
	if(responseObject.status == 200){
		var rpjson = JSON.parse(responseObject.response);
		$('#file-list').append('<img src="http://img.je4.cn/' + rpjson.key + '?imageView2/2/h/70" />');
	}
});
//上传按钮
$('#upload-btn').click(function(){
	uploader.start(); //开始上传
});

</script>
</body>
</html>
<?php }} ?>
