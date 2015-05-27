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
				icon:'succeed',
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


	//删除分类
	$('.del-span').click(function(){
		var _that = $(this);
		art.dialog({
			title:'确认信息',
			content:'确定要删除这个分类吗？',
			icon:'question',
			cancel:true,
			ok:function(){
				var	cid = _that.parent().parent().attr('cid');
				$.get('/admin/article/cat/del?cid='+cid,function(data){
					if(data.status == '1'){
						art.dialog({
							title:'提示信息',
							content:data.msg,
							icon:'succeed',
							ok:function(){
								location.reload();
							}
						})
					}else{
						art.dialog({
							title:'提示信息',
							content:data.msg,
							icon:'error',
							ok:true
						})
					}
				},'json');
			}
		})
	})
	
})
