<?php /* Smarty version Smarty-3.1.18, created on 2015-05-25 22:34:34
         compiled from "application\views\admin\article\cat.php" */ ?>
<?php /*%%SmartyHeaderCode:2084455632d1bcfb002-89427367%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddb253e6445db44d77574f124f2ee6fad5d762d6' => 
    array (
      0 => 'application\\views\\admin\\article\\cat.php',
      1 => 1432564472,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2084455632d1bcfb002-89427367',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_55632d1bd37f07_65225588',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55632d1bd37f07_65225588')) {function content_55632d1bd37f07_65225588($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/static/style/common/base.css" />
<script type="text/javascript" src="/static/js/lib/sea.js"></script>
</head>
<body>
<div class="main">
	<div class="item_title">
		<div class="cur-title">添加分类</div>
	</div>
	<div class="tabbox">
		<form method="post" action="/admin/article/cat/add">
			<table>
				<tr>
					<td class="td2">文章分类：</td>
					<td><input type="text" name="capital" /><span class="info_red">　　*必须填写(4-20)个字符</span></td>
				</tr>
				<tr>
					<td class="td2">父级分类：</td>
					<td>
						<select name="cid">
							<option value="0">顶级菜单</option>
						</select>
						<span class="info_red">　　　*必须选择</span>
					</td>
				</tr>
				<tr>
					<td></td><td><div class="button blue center">提交</div></td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>
<?php }} ?>
