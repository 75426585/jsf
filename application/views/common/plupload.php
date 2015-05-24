<script src="/static/js/lib/jquery.min.js"></script>
<script src="/static/js/lib/plupload/plupload.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="/static/style/common/plupload.css" />
<div class="both-path">
	<div class="wraper">
		<table class="file-list">
		</table>
	</div>
	<div class="btn-wraper">
		<input type="button" class="btn" value="选择文件..." id="browse" />
		<input type="button" class="btn" value="开始上传" id="upload-btn" />
		<input type="button" class="btn" value="确认插入" id="do-insert"/>
	</div>
</div>
<script>
var uploader = new plupload.Uploader({ //实例化一个plupload上传对象
	browse_button : 'browse',
		url : 'http://up.qiniu.com/',
		flash_swf_url : '/stastic/js/lib/plupload/Moxie.swf',
		silverlight_xap_url : '/stastic/js/lib/plupload/Moxie.xap',
		multipart_params: {
			'token': '{$token}', 
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
	$('.cancel-img').click(function(){
		$(this).parent().remove();
	});
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
//上传按钮
$('#do-insert').click(function(){
	var ids = new Array();
	$('.file-list tr').each(function(i){
		ids[i] = $(this).attr('id');
	})
		alert(ids)
});
</script>
