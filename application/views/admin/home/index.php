{extends file="../template.html"}
{block name="main-wrap"}
<ul class="breadcrumb">当前位置：
	<a href="#">首页</a> <span class="divider">/</span>
	<a href="#">业务处理</a> <span class="divider">/</span>
	电脑开票
</ul>
<div class="title_right"><strong>客户投诉</strong></div>
<div style="width:900px; margin:auto">
	<table class="table table-bordered" >
		<tr>
			<td width="12%" align="right" nowrap="nowrap" bgcolor="#f1f1f1">票号：</td>
			<td width="38%"><input type="text" name="input" id="input" class="span1-1"  /></td>
			<td width="12%" align="right" bgcolor="#f1f1f1">发货日期：</td>
			<td><input type="text"  class="laydate-icon span1-1" id="Calendar" value="2015-08-25"  /></td>
		</tr>
		<tr>
			<td align="right" nowrap="nowrap" bgcolor="#f1f1f1">客户姓名：</td>
			<td><input type="text" name="input3" id="input3" class="span1-1"  /></td>
			<td align="right" bgcolor="#f1f1f1">客户电话：</td>
			<td><input type="text" name="input4" id="input4" class="span1-1"  /></td>
		</tr>
		<tr>
			<td align="right" nowrap="nowrap" bgcolor="#f1f1f1">运费：</td>
			<td><input type="text" name="input2" id="input2" class="span1-1"  /></td>
			<td align="right" bgcolor="#f1f1f1">货款：</td>
			<td><input type="text" name="input5" id="input5" class="span1-1"  /></td>
		</tr>
		<tr>
			<td align="right" nowrap="nowrap" bgcolor="#f1f1f1">投诉内容：</td>
			<td colspan="3"><textarea name="input9" id="input9" class="span10"></textarea></td>
		</tr>
		<tr>
			<td align="right" nowrap="nowrap" bgcolor="#f1f1f1">客户要求：</td>
			<td colspan="3"><textarea name="input11" id="input11" class="span10"></textarea></td>
		</tr>
		<tr>
			<td align="right" nowrap="nowrap" bgcolor="#f1f1f1">客户建议：</td>
			<td colspan="3"><textarea name="input12" id="input12" class="span10"></textarea></td>
		</tr>
		<tr>
			<td align="right" nowrap="nowrap" bgcolor="#f1f1f1">被投诉部门：</td>
			<td><input type="text" name="input6" id="input6" class="span1-1" /></td>
			<td align="right" bgcolor="#f1f1f1">被投诉人：</td>
			<td><input type="text" name="input8" id="input8" class="span1-1" /></td>
		</tr>
		<tr>
			<td align="right" nowrap="nowrap" bgcolor="#f1f1f1">受理人：</td>
			<td><input type="text" name="input7" id="input7" class="span1-1" /></td>
			<td align="right" bgcolor="#f1f1f1">受理日期：</td>
			<td><input type="text"  class="laydate-icon span1-1" id="Calendar2" value="2015-08-25"  /></td>
		</tr>
	</table>
	<table  class="margin-bottom-20 table  no-border" >
		<tr>
			<td class="text-center"><input type="button" value="确定" class="btn btn-info " style="width:80px;" /></td>
		</tr>
	</table>
</div> 
{/block}
