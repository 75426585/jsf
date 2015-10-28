define(function(require, exports) {
	var dlg = require('dlg');
	//删除文章
	$('.del-link').click(function() {
		var art_id = $(this).parent().attr('art_id');
		art.dialog({
			title: '确认信息',
			content: '确定要删除这篇文章吗？',
			icon: 'question',
			cancel: true,
			ok: function() {
				$.get('/admin/article/dodel/' + art_id, function(data) {
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
				'json');
			}
		})
	})

})

