<?php /* Smarty version Smarty-3.1.18, created on 2015-05-24 18:27:11
         compiled from "application\views\common\plupload.php" */ ?>
<?php /*%%SmartyHeaderCode:2470755617030764662-88303519%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7dbb7484feb726396c0f14df7295e7c4504f735' => 
    array (
      0 => 'application\\views\\common\\plupload.php',
      1 => 1432463230,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2470755617030764662-88303519',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_556170307c6101_11315327',
  'variables' => 
  array (
    'token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556170307c6101_11315327')) {function content_556170307c6101_11315327($_smarty_tpl) {?><script src="/static/js/lib/jquery.min.js"></script>
<script src="/static/js/lib/plupload/plupload.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="/static/style/common/plupload.css" />
<div class="both-path">
	<div class="wraper">
		<table class="file-list">
		</table>
	</div>
	<div class="btn-wraper">
		<input type="button" value="选择文件..." id="browse" />
		<input type="button" value="开始上传" id="upload-btn" />
	</div>
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
		var html = '<tr id="tr-'+ files[i].id +'"><td class="thumb-img"></td><td><span class="file-name">' + file_name + '</span><div class="process"></div></td><td class="cancel-img"></td></tr>';
		$('.file-list').append(html)
	}
});

//绑定文件上传进度事件
uploader.bind('UploadProgress',function(uploader,file){
	$('#tr-'+file.id).find('.process').css('width',file.percent + '%');//控制进度条
});
uploader.bind('FileUploaded',function(uploader,file,responseObject){
	if(responseObject.status == 200){
		$('#tr-'+file.id).find('.process').css('background-color','#b4cbd4');//控制进度条
		var rpjson = JSON.parse(responseObject.response);
		$('#tr-'+file.id).find('.thumb-img').append('<img src="http://img.je4.cn/' + rpjson.key + '?imageView2/2/h/44" />');
		$('#tr-'+file.id).find('.cancel-img').attr('key',rpjson.key);
	}
});
//上传按钮
$('#upload-btn').click(function(){
	uploader.start(); //开始上传
});
</script>
<?php }} ?>
