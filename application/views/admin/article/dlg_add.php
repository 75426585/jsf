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
					<option value="0">顶级分类</option>
					{foreach $top_cat as $v}
					<option value="{$v.id}">{$v.cat_name}</option>
					{/foreach}
				</select>
				<span class="info_red">　　　*必须选择</span>
			</td>
		</tr>
		<tr>
			<td></td><td><div class="button blue center">提交</div></td>
		</tr>
	</table>
</form>
