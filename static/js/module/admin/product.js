define(function(require, exports) {
	var dlg = require('dlg');
	var tpl = require('template');
	require('fancybox');
	$('.fancybox').fancybox({
		width: 920
	});
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
	/*
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
	*/
	$('.add-img').click(function() {
		art.dialog({
			title: '添加组图片',
			content: document.getElementById('upload_main_div'),
			cancel: false,
		})
		$('.aui_close').show();
	})

	//确认插入
	$('#do-insert').click(function() {
		var ids = new Array();
		$('.file-list tr').find('.cancel-img').each(function(i) {
			ids[i] = $(this).attr('key');
		})
		$.post('/admin/product/add/img', {
			urls: ids
		},
		function(data) {
			if (data.status == '1') {
				var list = art.dialog.list;
				for (var i in list) {
					list[i].close();
				};
				var html = tpl('pro_img',data);
				$('#show_photo_div').html(html)
			}
		},
		'json');

	})

})

