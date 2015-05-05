<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>管理登陆</title>
<style type="text/css">
<!--
.STYLE1 {
	font-size: 11pt;
	font-weight: bold;
}
-->
*{
font-family:'微软雅黑';
}
.submit{
cursor:pointer;
}
.red{
	color:red;
}
.green{
	color:green;
}
#refresh{
	cursor:pointer;
}
}
</style>
<script src="/static/js/lib/jquery.min.js"></script>
</head>
<body style="background-image:url(/static/images/login/admin_login_bg.gif); margin:0 auto; width:500px;">
<div style="background-image:url(/static/images/login/admin_login.png); width:500px; height:200px; margin-top:130px;">
  <form>
	<table width="500" border="0" cellpadding="0" cellspacing="0">
		<input type="hidden" class="postsrc" src="/login/ajaxpost/" style="height:25px; width:200px; font-size:15pt; font-weight:bold;" />
	  <tr>
		<td width="250">&nbsp;</td>
		<td colspan="2">&nbsp;</td>
	  </tr>
	  <tr>
		<td height="35"><div align="right" class="STYLE1">用户名：</div></td>
		<td height="35" colspan="2"><input type="text" name="username" style="height:25px; width:200px; font-size:15pt; font-weight:bold;" /></td>
	  </tr>
	  <tr>
		<td height="35"><div align="right" class="STYLE1">密　码：</div></td>
		<td height="35" colspan="2"><input type="password" name="password" class="password" style="height:25px; width:200px; font-size:15pt; font-weight:bold;" /></td>
	  </tr>
	  <tr>
		<td height="35"><div align="right" class="STYLE1">验证码：</div></td>
		<td width="100" height="35"><input type="text" name="checkcode" style="height:25px; width:85px; font-size:15pt; font-weight:bold;" /></td>
		<td width="150"><img id="refresh" src="/login/createcode"/></td>
	  </tr>
	  <tr>
		<td height="35">&nbsp;</td>
		<td height="35" colspan="2"><div class="submit" style="width:130px; height:30px; background-image:url(/static/images/login/admin_login_button.png); border:0; background-color: transparent; "/><div></td>
	  </tr>
		<tr><td></td><td colspan="2"><span class="msg"></span></td></tr>
	</table>
  </form>
</div>
<script>
$(function(){
	$('.submit').click(function(){
		var username = $("input[name='username']").val();
		var password = $("input[name='password']").val();
		var checkcode = $("input[name='checkcode']").val();
		if(username.length > 20 || username.length < 4 ){
			showMsg('用户名不正确','red');
			return false;
		}
		if(password.length > 20 || password.length < 4 ){
			showMsg('密码不正确','red');
			return false;
		}
		if(checkcode.length != 4 ){
			showMsg('验证码不正确','red');
			return false;
		}
		var src = $('.postsrc').attr('src');
		$.post(src,{
			username:username,
			password:password,
			checkcode:checkcode
		},function(data){
			if(data.status == '1'){
				showMsg(data.msg,'green');
				window.location.href="/admin/";
			}else{
				showMsg(data.msg,'red');
				$('#refresh').attr('src',"/login/createcode?"+Math.random(1000,9999));
			}
		},'json')
	})

	function showMsg(msg,type){
		$('.msg').html(msg);
		$('.msg').addClass(type);
	}

	$('#refresh').click(function(){
		$(this).attr('src',"/login/createcode?"+Math.random(1000,9999))

	})
})
	</script>
</body>
</html>
