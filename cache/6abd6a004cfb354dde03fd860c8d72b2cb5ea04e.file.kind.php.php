<?php /* Smarty version Smarty-3.1.18, created on 2015-05-26 11:52:41
         compiled from "application\views\test\kind.php" */ ?>
<?php /*%%SmartyHeaderCode:274035563edb45a5c01-29875057%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6abd6a004cfb354dde03fd860c8d72b2cb5ea04e' => 
    array (
      0 => 'application\\views\\test\\kind.php',
      1 => 1432612359,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '274035563edb45a5c01-29875057',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5563edb46fd856_16323706',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5563edb46fd856_16323706')) {function content_5563edb46fd856_16323706($_smarty_tpl) {?><!doctype html>
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
	<?php echo $_smarty_tpl->getSubTemplate ('common/plupload.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>
</body>
</html>
<?php }} ?>
