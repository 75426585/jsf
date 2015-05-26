<?php /* Smarty version Smarty-3.1.18, created on 2015-05-25 15:49:35
         compiled from "application\views\home\index.html" */ ?>
<?php /*%%SmartyHeaderCode:72265562d40fd942c1-19986672%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb015ceec8bd6bb84d953cd4b3676ea1adec281e' => 
    array (
      0 => 'application\\views\\home\\index.html',
      1 => 1432540128,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '72265562d40fd942c1-19986672',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5562d40fdd2ad7_67574028',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5562d40fdd2ad7_67574028')) {function content_5562d40fdd2ad7_67574028($_smarty_tpl) {?><!doctype html>
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
uploadJson : '/upload/kind/'
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
	<?php echo $_smarty_tpl->getSubTemplate ('common/plupload.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>
</body>
</html>
<?php }} ?>
