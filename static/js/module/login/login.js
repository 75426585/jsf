define(function(require, exports) {
	$('.submit').click(function() {
		var username = $("input[name='username']").val();
		var password = $("input[name='password']").val();
		var checkcode = $("input[name='checkcode']").val();
		if (username.length > 20 || username.length < 4) {
			showMsg('用户名不正确', 'red');
			return false;
		}
		if (password.length > 20 || password.length < 4) {
			showMsg('密码不正确', 'red');
			return false;
		}
		if (checkcode.length != 4) {
			showMsg('验证码不正确', 'red');
			return false;
		}
		var src = $('.postsrc').attr('src');
		$.post(src, {
			username: username,
			password: password,
			checkcode: checkcode
		},
		function(data) {
			if (data.status == '1') {
				showMsg(data.msg, 'green');
				window.location.href = "/admin/";
			} else {
				showMsg(data.msg, 'red');
				$('#refresh').attr('src', "/common/login/createcode?" + Math.random(1000, 9999));
			}
		},
		'json')
	})

	function showMsg(msg, type) {
		$('.msg').html(msg);
		$('.msg').addClass(type);
	}

	$('#refresh').click(function() {
		$(this).attr('src', "/common/login/createcode?" + Math.random(1000, 9999))

	})
})

