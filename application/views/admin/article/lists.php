<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="http://www.bjbtss.com//templates/admin/style/main.css" />
<script src="http://www.bjbtss.com//system/plugins/kindeditor/kindeditor.js"></script>
</head>
<body>
<div id="main">
	<div class="item_title">
		<h3>文章列表</h3>
		<a href="http://www.bjbtss.com//admin/index.php/article/cat" class="link_btn">分类管理</a>
	</div>
	<div id="tabbox">
		<form method="post" action="http://www.bjbtss.com//admin/index.php/article/save">
			<table>
				<tr>
					<td class="td2">文章标题：</td>
					<td><input type="text" name="capital" /><span class="info_red">　　*必须填写(4-20)个字符</span></td>
				</tr>
				<tr>
					<td class="td2">文章分类：</td>
					<td><select name="cid"><option value="74">|--->行业资讯</option>
		<option value="76">|--->工程案例</option>
		</select><span class="info_red">　　　*必须选择</span></td>
				</tr>
				<tr>
					<td class="td2">关键字：</td>
					<td><input type="text" name="keyword" /><span class="info_grey">　　(多个词时用逗号隔开)</span></td>
				</tr>
				<tr>
					<td class="td2" style="height: 450px;">文章内容：</td>
					<td><textarea name="content"
							style="width: 700px; height: 450px; visibility: hidden;"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input id ="btn_sub" type="submit" value="提交" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>
