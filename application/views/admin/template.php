<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="/static/style/common/fw.css">
</head>
<body>
	<div class="header">
		<dl>
			<dd class="menu" ><a href="/admin/">首页</a></dd>
			<dd class="menu" ><a href="/admin/article">文章</a></dd>
			<dd class="menu" ><a href="/admin/product">产品</a></dd>
			<dd class="menu" ><a href="/admin/system">系统</a></dd>
			<dd class="menu" ><a href="/admin/user">用户</a></dd>
		</dl>
	</div>
	<div class="center-body">
		<table>
			<td width="10%" class="left-bar">
				{block name="left-bar"}{/block}
			</td>
			<td width="90%" class="main-div">
				{block name="main-div"}{/block}
			</td>
		</table>
	</div>
</body>
<script type="text/javascript" src="/static/js/lib/sea.js"></script>
</html>
