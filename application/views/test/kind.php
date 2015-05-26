<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Default Examples</title>
<link rel="stylesheet" href="/static/js/lib/kind/themes/default/default.css" />
<script charset="utf-8" src="/static/js/lib/kind/kindeditor-min.js"></script>
<script charset="utf-8" src="/static/js/lib/kind/lang/zh_CN.js"></script>
<style>
body{ font-size: 12px;}
body,p,div{ padding: 0; margin: 0;}
.upload-div{
	margin:0 auto;
	height:400px;
	width:500px;
}
</style>
<script>
var editor;
KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
uploadJson : '/common/upload/kind/'
});
		});
</script>
</head>
<body>
<h3>默认模式</h3>
<form>
	<textarea name="content" style="width:800px;height:400px;visibility:hidden;"></textarea>
</form>
<div class="upload-div">
	{include file='common/plupload.php'}
</div>
</body>
</html>
