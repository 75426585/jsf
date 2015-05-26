<?php /* Smarty version Smarty-3.1.18, created on 2015-05-24 21:59:43
         compiled from "application\views\index.php" */ ?>
<?php /*%%SmartyHeaderCode:288405561d94f992a11-30526511%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c05e42aa64e69a0f1b4e16ca59dd9e931c32bd3f' => 
    array (
      0 => 'application\\views\\index.php',
      1 => 1432450576,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '288405561d94f992a11-30526511',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5561d94f9bd9a2_19998927',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5561d94f9bd9a2_19998927')) {function content_5561d94f9bd9a2_19998927($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>首页包含</title>
	<style>
		body{ font-size: 12px;}
		body,p,div{ padding: 0; margin: 0;}
		.upload-div{
			margin:0 auto;
			height:400px;
			width:500px;
		}
	</style>
</head>
<body>
	<div class="upload-div">
		<?php echo $_smarty_tpl->getSubTemplate ('common/plupload.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	</div>
</body>
</html>
<?php }} ?>
