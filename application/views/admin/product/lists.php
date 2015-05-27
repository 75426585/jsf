{extends file="../template.php"}
{block name="left-bar"}
{include file="./sub_menu.php"}
{/block}
{block name="main-div"}
<link rel="stylesheet" type="text/css" href="/static/style/common/base.css">
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
				<th>分类ID</th><th>名称</th><th>父级名称</th><th>操作</th><th>排序</th>
			</tr>
			{foreach $all_cat as $v}
			<tr>
				<td>{$v.id}</td><td>{$v.cat_name}</td><td>{$v.parent_name}</td><td>修改　　删除</td><td>{$v.ord}</td>
			</tr>
			{/foreach}
		</table>
	</div>
</div>
<form class="dlg-form" id="add-form" method="post" action="/admin/article/cat/add">
	<table>
		<tr>
			<td class="td2">文章分类：</td>
			<td><input type="text" name="capital" /><span class="info_red">　　*必须填写(4-20)个字符</span></td>
		</tr>
		<tr>
			<td class="td2">父级分类：</td>
			<td>
				<select name="cid">
					<option value="0">顶级分类</option>
					{foreach $top_cat as $v}
					<option value="{$v.id}">{$v.cat_name}</option>
					{/foreach}
				</select>
				<span class="info_red">　　　*必须选择</span>
			</td>
		</tr>
		<tr>
			<td></td><td><div class="button blue center sub-btn">添加</div></td>
		</tr>
	</table>
</form>
{/block}
