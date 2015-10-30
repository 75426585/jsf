//首页动画
define(function(require, exports) {
	//上传按钮
	$('#do-insert').click(function() {
		var ids = new Array();
		$('.file-list tr').find('.cancel-img').each(function(i) {
			ids[i] = $(this).attr('key');
		})
		$.post('/admin/system/nav_img/insert', {
			urls: ids
		},
		function(data) {
			if (data.status == '1') {
				location.reload();
			}
		},
		'json');
	});

	//删除已添加图片
	$('.nav_img .close-btn').click(function() {
		var id = $(this).parent().attr('id');
		$.post('/admin/system/nav_img/del', {
			id: id
		},
		function(data) {
			if (data.status == '1') {
				location.reload();
			}
		},
		'json');
	})
})

