<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="/static/style/common/base.css" />
	<script type="text/javascript" src="/static/js/lib/sea.js"></script>
</head>
<body>
<input type="hidden" id="page" js="admin/article"/> 
<div class="main-content">
	<div class="item_title">
		<div class="cur-title">文章分类</div>
		<div class="link-btn add-cat">添加分类</div>
		<div class="link-btn art-list">文章列表</div>
	</div>
	<div class="tabbox">
		<table>
			<tr>
				<th>分类ID</th><th>名称</th><th>父级名称</th><th>修改</th><th>排序</th>
			</tr>
			{foreach $all_cat as $v}
			<tr>
				<td>{$v.id}</td><td>{$v.cat_name}</td><td>{$v.parent_name}</td><td>修改</td><td>{$v.ord}</td>
			</tr>
			{/foreach}
		</table>
	</div>
</div>
</body>
</html>
