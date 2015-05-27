define(function(require,exports){
//添加分类
	$('.add-cat').click(function(){
		var dlg = require('dlg');
		art.dialog({
			title:'添加分类',
			content:document.getElementById('add-form'),
			cancel:true,
			okVal:'确认添加',
			ok:function(){
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
			}
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

	//修改分类
	$('.edit-span').click(function(){
		var _that = $(this);
		var catName;
		var	cid = _that.parent().parent().attr('cid');
		$('.sub-btn').html('修改');
		$.getJSON('/admin/article/cat/edit?cid='+cid,function(data){
			$('input[name="capital"]').val(data.data);
		});
		art.dialog({
			title:'修改分类',
			content:document.getElementById('add-form'),
			cancel:true,
			ok:function(){
				$.post('/admin/article/cat/doedit?cid='+cid,{ cat_name:$('input[name="capital"]').val(), parent_id:$('select[name="cid"]').val() }, function(data){
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
