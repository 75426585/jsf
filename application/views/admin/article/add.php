<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/static/style/common/base.css" />
<script src="/static/js/lib/kindeditor.js"></script>
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
							<option value="74">|--->行业资讯</option>
							<option value="76">|--->工程案例</option>
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
					<td><textarea name="content" style="width: 700px; height: 450px; visibility: hidden;"></textarea>
					</td>
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
