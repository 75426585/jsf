<!DOCTYPE html>
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
