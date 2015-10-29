define(function(require, exports) {
	var dlg = require('dlg');
	require('fancybox');
	$('.fancybox').fancybox({width:920});
	//删除产品
	$('.del-link').click(function() {
		var art_id = $(this).parent().attr('art_id');
		art.dialog({
			title: '确认信息',
			content: '确定要删除这篇产品吗？',
			icon: 'question',
			cancel: true,
			ok: function() {
				$.get('/admin/product/dodel/' + art_id, function(data) {
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

	//添加产品
	$('.sub').click(function() {
		var url = $('#add-form').attr('action');
		$.post(url, $('#add-form').serialize(), function(data) {
			if (data.status == '1') {
				art.dialog({
					title: '提示信息',
					content: data.msg,
					icon: 'succeed',
					ok: function() {
						location.href='/admin/product/lists';
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

