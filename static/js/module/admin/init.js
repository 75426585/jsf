define(function(require, exports) {
	require('dlg');
	//ajax提交
	$('.sub').click(function() {
		var post_url = $('#add-form').attr('action');
		var jump_url = $('#add-form').attr('jump');
		$.post(post_url, $('#add-form').serialize(), function(data) {
			if (data.status == '1') {
				art.dialog({
					title: '提示信息',
					content: data.msg,
					icon: 'succeed',
					ok: function() {
						location.href = jump_url;
					}
				})
			} else {
				art.dialog({
					title: '提示信息',
					content: data.msg,
					icon: 'error',
					ok: true
				})
			}
		},
		'json')
	})
	//fancybox 的ajax提交
	$('.fancy_sub').click(function() {
		var post_url = $('#add-form').attr('action');
		$.post(post_url, $('#add-form').serialize(), function(data) {
			if (data.status == '1') {
				art.dialog({
					title: '提示信息',
					content: data.msg,
					icon: 'succeed',
					ok: function() {
						parent.jQuery.fancybox.close();
						parent.location.reload();
					}
				})
			} else {
				art.dialog({
					title: '提示信息',
					content: data.msg,
					icon: 'error',
					ok: true
				})
			}
		},
		'json')
	})

	//删除链接
	$('.del-link').click(function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		$.get(url, function(data) {
			if (data.status == '1') {
				art.dialog({
					title: '提示信息',
					content: data.msg,
					icon: 'succeed',
					ok: function() {
						location.reload();
					}
				})
			} else {
				art.dialog({
					title: '提示信息',
					content: data.msg,
					icon: 'error',
					ok: true
				})
			}
		},
		'json')
		
	})
})

