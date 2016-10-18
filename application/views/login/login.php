<!DOCTYPE html>
<html lang="zh-cn">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>内网拍系统socket后台服务管理</title>
	<link href="/static/js/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript">
function toQzoneLogin()
{
	location.href='/common/qqlogin/auth';

} 
</script>
  </head>
  <body>
	<input type="hidden" id="page" js="common/login"/>
	<div class="container-fluid" style="padding-top:150px;">
		<div class="row">
			<div class="col-xs-4 col-xs-offset-3">
				<h3 class="text-center">够意思博客后台管理</h2>
			</div>
		</div>
		<div class="row" style="padding-top:20px;">
			<div class="col-xs-2 col-xs-offset-4">
			<form class="form-horizontal" role="form" action="/manage/login.php" method="post">
				<div class="form-group">
					<label for="user_name" class="control-label col-sm-4">用　户：</label>
					<div class="col-sm-8">
						<input type="text" class="form-control col-sm-9" id="user_name" name="user_name"/>
					</div>
				</div>
				<div class="form-group">
					<label for="passwd" class="col-xs-4 control-label">密　码：</label>
					<div class="col-xs-8">
						<input type="password" class="form-control" id="passwd" name="password"/>
					</div>
				</div>
				<div class="form-group">
					<label for="passwd" class="col-xs-4 control-label">验证码：</label>
					<div class="col-xs-4">
						<input type="text" class="form-control" style="font-size:20px;" name="checkcode"/>
					</div>
					<div class="col-xs-4">
						<img style="padding-top:2px;" id="refresh" src="/common/login/createcode"/>
					</div>
				</div>
				<div>
					<button type="button" id="submit" class="btn btn-primary col-xs-5 col-xs-offset-4">登陆</button>
				</div>
				<div style="padding-top:10px;">
					<div class="col-xs-5 col-xs-offset-4">
						{if isset($smarty.session.userid) && $smarty.session.userid }
							用户{$smarty.session.userid}已登录<a href="/common/login/logout">退出</a>
						{else}
						<a href="#" onclick="toQzoneLogin()"><img style="margin-left:-15px;padding-top:10px;" src="/static/images/login/qq_login.png"></a>
						{/if}
					</div>
				</div>
			</form>
			</div>
		</div>
		<div class="row" style="padding-top:20px;display:none;" id="show_box">
			<div class="col-xs-2 col-xs-offset-4">
				<div class="alert alert-danger" role="alert">
					  <strong>警告：</strong><span id="error_msg"></span>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
<script type="text/javascript" src="/static/js/lib/sea.js"></script>
