<?php /* Smarty version Smarty-3.1.18, created on 2015-05-25 22:07:46
         compiled from "application\views\admin\article\add.php" */ ?>
<?php /*%%SmartyHeaderCode:527556329c20037a9-40627470%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ddeeac08722e6aae050ca6e0ffcf02446bb040c' => 
    array (
      0 => 'application\\views\\admin\\article\\add.php',
      1 => 1432562863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '527556329c20037a9-40627470',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_556329c20519c4_34130919',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556329c20519c4_34130919')) {function content_556329c20519c4_34130919($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/static/style/common/base.css" />
<script type="text/javascript" src="/static/js/lib/sea.js"></script>
<?php echo $_smarty_tpl->getSubTemplate ('common/kindeditor.php', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</head>
<body>
<div class="main">
	<div class="item_title">
		<div class="cur-title">添加文章</div>
		<a href="/admin/article/cat" class="link_btn">分类管理</a>
	</div>
	<div class="tabbox">
		<form method="post" action="/admin/article/doadd">
			<table>
				<tr>
					<td class="td2">文章标题：</td>
					<td><input type="text" name="capital" /><span class="info_red">　　*必须填写(4-20)个字符</span></td>
				</tr>
				<tr>
					<td class="td2">文章分类：</td>
					<td>
						<select name="cid">
						</select>
						<span class="info_red">　　　*必须选择</span>
					</td>
				</tr>
				<tr>
					<td class="td2">关键字：</td>
					<td><input type="text" name="keyword" /><span class="info_grey">　　(多个词时用逗号隔开)</span></td>
				</tr>
				<tr>
					<td class="td2" style="height: 450px;">文章内容：</td>
					<script id="editor" type="text/plain" style="width:1024px;height:500px;"></script>
					<td><textarea name="content" style="width:800px;height:400px;visibility:hidden;"></textarea></td>
				</tr>
				<tr>
					<td colspan="2"><input id ="btn_sub" class="link_btn" style="height:30px;margin-left:300px;" type="submit" value="提交" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>
<?php }} ?>
