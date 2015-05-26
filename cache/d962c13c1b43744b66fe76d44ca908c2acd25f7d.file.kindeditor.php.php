<?php /* Smarty version Smarty-3.1.18, created on 2015-05-25 21:56:43
         compiled from "application\views\common\kindeditor.php" */ ?>
<?php /*%%SmartyHeaderCode:8860556329c20596c6-45855912%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd962c13c1b43744b66fe76d44ca908c2acd25f7d' => 
    array (
      0 => 'application\\views\\common\\kindeditor.php',
      1 => 1432562146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8860556329c20596c6-45855912',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_556329c20613c6_76047578',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556329c20613c6_76047578')) {function content_556329c20613c6_76047578($_smarty_tpl) {?><link rel="stylesheet" href="/static/js/lib/kind/themes/default/default.css" />
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
<?php }} ?>
