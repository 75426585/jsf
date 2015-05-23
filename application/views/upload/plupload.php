<!DOCTYPE html>
<html>
<head>
	<script src="/static/js/lib/jquery.min.js"></script>
	<script src="/static/js/lib/plupload/plupload.full.min.js"></script>
</head>
<body>
	<p>
        <button id="browse">选择文件</button>
        <button id="start_upload">开始上传</button>
    </p>
	<p id="filename"></p>
	<p id="process"></p>
    <script>

    //实例化一个plupload上传对象
    var uploader = new plupload.Uploader({
        browse_button : 'browse', //触发文件选择对话框的按钮，为那个元素id
        url : '/upload/plupload', //服务器端的上传页面地址
        flash_swf_url : '/static/js/lib/plupload/Moxie.swf', //swf文件，当需要使用swf方式进行上传时需要配置该参数
        silverlight_xap_url : '/static/js/lib/plupload/Moxie.xap' //silverlight文件，当需要使用silverlight方式进行上传时需要配置该参数
    }); 
	uploader.init();
	uploader.bind('FilesAdded',function(uploader,files){
		$('#filename').html(files[0].name)
    });
	uploader.bind('UploadProgress',function(uploader,files){
		alert(uploader.total.percent)
    });
	document.getElementById('start_upload').onclick = function(){
        uploader.start(); //调用实例对象的start()方法开始上传文件，当然你也可以在其他地方调用该方法
    }
	</script>
</body>
</html>
