define(function(require, exports) {
	var dlg = require('dlg');
	var base_url = window.location.origin

	//当标题失去焦点，则添加新文章
	$('input[name="title"]').focusout(function() {
		if ($('#article_id').val() > 0) return false;
		var title = $('input[name="title"]').val();
		if (!title) return false;
		$.post('/admin/article/add/draft', {
			title: title
		},
		function(data) {
			if(data.status == 1){
				$('#article_id').val(data.data);
				var url = base_url+'/article/'+data.data;
				$('.link_box i').html('<a href="' + url + '" target="_blank">'+url+'</a>');
				$('.link_box').show();
			}
		},'json')
	});

	//发布文章或者保存草稿
	$('.article_sub').click(function() {
		var post_id = $('#article_id').val();
		var title = $('input[name="title"]').val();
		var vicetitle = $('input[name="vicetitle"]').val();
		var content = $('textarea[name="content"]').val();
		var type = $(this).attr('result');
		var tags = new Array();
		$('.tag_form .tags_box').each(function() {
			if ($(this)[0].checked == true) {
				tags.push($(this).val());
			}
		})
		if(!(post_id > 0)) return false;
		$.post('/admin/article/add/do', {
			post_id:post_id,
			title: title,
			vicetitle: vicetitle,
			content: content,
			type: type,
			tags: tags
		},
		function(data) {

		},
		'json')
	})

	exports.show_cat = function() {
		$.get('/admin/article/json_cat', function() {

		},
		'json');
	}

	//初始化加载
	$(function() {
		exports.show_cat();
		if($('#article_id').val() > 0){
			var url = base_url+'/article/'+$('#article_id').val();
			$('.link_box i').html('<a href="' + url + '" target="_blank">'+url+'</a>');
			$('.link_box').show();
		}else{
			$('.link_box').hide();
		}
	})

	//添加分类
	$('.add_cat').click(function() {
		var cat_name = $('input[name="cat_name"]').val();
		if (!cat_name) {
			alert('请输入分类名称');
			return false;
		}
		var parent_id = $('select[name="parent_id"]').val();
		$.post('/admin/article/add_article_cat', {
			cat_name: cat_name,
			parent_id: parent_id
		},
		function() {},
		'json')
	})
	//添加标签
	$('.add_tag').click(function() {
		var tag_name = $('input[name="tag_name"]').val();
		if (!tag_name) {
			alert('请输入标签名称');
			return false;
		}
		$.post('/admin/article/add_article_tag', {
			tag_name: tag_name,
		},
		function() {},
		'json')
	})
})

