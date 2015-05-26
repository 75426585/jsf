define(function(require,exports){

	//添加分类对话框显示
	$('.add-cat').click(function(){
		var dlg = require('dlg');
		art.dialog({
			title:'添加分类',
			content:document.getElementById('add-form')
		});
	})

	//保存分类
	$('.sub-btn').click(function(){
		var dlg = require('dlg');
		$.post($('.dlg-form').attr('action'),{
			cat_name:$('input[name="capital"]').val(),
			parent_id:$('select[name="cid"]').val(),
		},function(data){
			art.dialog({
				title:'提示信息',
				content:data.msg,
				ok:function(){
					location.reload();
				}
			});
		},'json')
		art.dialog({
			title:'添加分类',
			content:document.getElementById('add-form')
		});
	})
	
})
