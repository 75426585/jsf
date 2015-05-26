<link rel="stylesheet" href="/static/js/lib/kind/themes/default/default.css" />
<script charset="utf-8" src="/static/js/lib/kind/kindeditor-min.js"></script>
<script charset="utf-8" src="/static/js/lib/kind/lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
			uploadJson : '/upload/kind/'
	});
});
</script>
<!--
<textarea name="content" style="width:800px;height:400px;visibility:hidden;">KindEditor</textarea>
-->
