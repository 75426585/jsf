define(function(require, exports) {
	var dlg = require('dlg');
	var tpl = require('template');
	require('fancybox');
	$('.fancybox').fancybox({
		width: 920
	});

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
				var html = tpl('pro_img', data);
				$('#show_photo_div').html(html)
			}
		},
		'json');

	})

	//刷新图片显示区域
	exports.update_img = function() {
		var url = location.href;
		if (url.match('\/add')) {
			var pro_id = - 1;
		} else if (url.match('\/edit')) {
			var p_id = $('#pro_id').val();
			if (p_id) {
				var pro_id = p_id;
			}
		}
		$.get('/admin/common/get_pro_img/' + pro_id, function(data) {
			if (data.status == '1') {
				var list = art.dialog.list;
				for (var i in list) {
					list[i].close();
				};
				var html = tpl('pro_img', data);
				$('#show_photo_div').html(html)
			}
		},
		'json');
	}

	//删除已添加图片
	$(document).on('click', '.nav_img .close-btn', function() {
		var id = $(this).parent().attr('id');
		$.post('/admin/common/del_pro_img/' + id, {},
		function(data) {
			if (data.status == '1') {
				exports.update_img();
			}
		},
		'json');
	})

	//插入产品
	$('.pro_sub').click(function() {
		var post_url = $('#add-form').attr('action');
		var img_str = '';
		$('.nav_img').each(function() {
			img_str = img_str + $(this).attr('id') + ',';
		})
		$.post(post_url, {
			title:$('input[name="title"]').val(),
			cat_id:$('select[name="cat_id"]').val(),
			content:$('textarea[name="content"]').val(),
			imgs:img_str,
		},
		function(data) {
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

	//加载完毕执行
	$(function() {
		var url = location.href;
		if (url.match('\/add') || url.match('\/edit')) {
			exports.update_img();
		}
	})
})

