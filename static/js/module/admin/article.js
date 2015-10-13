define(function(require, exports) {
	var dlg = require('dlg');
	//删除文章
	$('.del-link').click(function() {
		var cat_id = $(this).parent().attr('cat_id');
		art.dialog({
			title: '确认信息',
			content: '确定要删除这篇文章吗？',
			icon: 'question',
			cancel: true,
			ok: function() {
				$.get('/admin/article/dodel?cid=' + cat_id, function(data) {
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

	//修改文章
	$('.edit-link').click(function() {
		var cat_id = $(this).parent().attr('cat_id');
		$.get('/admin/article/cat/get_catname?cid=' + cat_id, function(data) {
			$('input[name="name"]').val(data.data);
			art.dialog({
				title: '修改分类',
				content: document.getElementById('add-form'),
				cancel: true,
				okVal: '确认修改',
				lock: true,
				ok: function() {
					var name = $('input[name="name"]').val()
					if (name == '') {
						alert('请输入分类名称!');
						return false;
					}
					$.post('/admin/article/cat/doedit?cid=' + cat_id, {
						name: name,
						cid: cat_id
					},
					function(data) {
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
				}
			});
		},
		'json');
	})


	//添加文章
	$('.sub').click(function() {
		$.post('/admin/article/add/do', $('#add-form').serialize(), function(data) {
			if (data.status == '1') {
				art.dialog({
					title: '提示信息',
					content: data.msg,
					icon: 'succeed',
					ok: function() {
						location.href='/admin/article/lists';
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

