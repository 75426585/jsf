define(function(require, exports) {
	require('ztree');
	//ztree 配置
	var setting = {
		view: {
			addHoverDom: addHoverDom,
			removeHoverDom: removeHoverDom
		},
		data: {
			simpleData: {
				enable: true
			}
		},
		edit: {
			enable: true,
			drag: {
				autoExpandTrigger: true,
				prev: dropPrev,
				inner: dropInner,
				next: dropNext
			},
		},
		callback: {
			beforeDrag: beforeDrag,
			beforeDrop: beforeDrop,
			onRemove: onRemove,
			onRename: onRename,
			beforeRemove: beforeRemove,
			onRightClick: OnRightClick
		}
	};

	var zTree, rMenu;
	$(function() {
		$.get('/admin/system/tree_json', function(data) {
			$.fn.zTree.init($("#tree"), setting, data.data);
			zTree = $.fn.zTree.getZTreeObj("tree");
			rMenu = $("#rMenu");
		},
		'json')
	})

	//拖动触发前
	function beforeDrag(treeId, treeNodes) {
		for (var i = 0, l = treeNodes.length; i < l; i++) {
			if (treeNodes[i].drag === false) {
				return false;
			}
		}
		return true;
	}
	//放置触发前
	function beforeDrop(treeId, treeNodes, targetNode, moveType) {
		/*
		//一级不能成为二级
		if (!targetNode || targetNode.drop == false) {
		return false;
		}
		//二级不能成为1级
		if (treeNodes[0].pId != '0' && moveType != 'inner' && targetNode.pId == null) {
		return false;
		}
		*/
		pid = (targetNode.pId == null) ? 0: targetNode.pId;
		$.post('/admin/system/tree/change_order', {
			id_one: treeNodes[0].id,
			id_two: targetNode.id,
			type: moveType,
			pid: pid
		},
		function(data) {
			return false;
		},
		'json');

	}

	var log, className = "dark",
	curDragNodes, autoExpandNode;

	//放置到节点前面触发
	function dropPrev(treeId, nodes, targetNode) {
		var pNode = targetNode.getParentNode();
		if (pNode && pNode.dropInner === false) {
			return false;
		} else {
			for (var i = 0, l = curDragNodes.length; i < l; i++) {
				var curPNode = curDragNodes[i].getParentNode();
				if (curPNode && curPNode !== targetNode.getParentNode() && curPNode.childOuter === false) {
					return false;
				}
			}
		}
		var curDragPId = curDragNodes[0].pId;
		if (!curDragPId && targetNode.pId) {
			return false;
		}
		return true;
	}

	//放置到节点内部触发
	function dropInner(treeId, nodes, targetNode) {
		if (targetNode && targetNode.dropInner === false) {
			return false;
		} else {
			for (var i = 0, l = curDragNodes.length; i < l; i++) {
				if (!targetNode && curDragNodes[i].dropRoot === false) {
					return false;
				} else if (curDragNodes[i].parentTId && curDragNodes[i].getParentNode() !== targetNode && curDragNodes[i].getParentNode().childOuter === false) {
					return false;
				}
			}
		}
		/*
		   var curDragPId = curDragNodes[0].pId;
		   if (!curDragPId && ! targetNode.pId) {
		   return false;
		   }
		   */
		return true;
	}

	//放置到节点下面触发
	function dropNext(treeId, nodes, targetNode) {
		var pNode = targetNode.getParentNode();
		if (pNode && pNode.dropInner === false) {
			return false;
		} else {
			for (var i = 0, l = curDragNodes.length; i < l; i++) {
				var curPNode = curDragNodes[i].getParentNode();
				if (curPNode && curPNode !== targetNode.getParentNode() && curPNode.childOuter === false) {
					return false;
				}
			}
		}
		var curDragPId = curDragNodes[0].pId;
		if (!curDragPId && targetNode.pId) {
			return false;
		}
		return true;
	}
	//拖拽移动前给当前节点赋值
	function beforeDrag(treeId, treeNodes) {
		className = (className === "dark" ? "": "dark");
		for (var i = 0, l = treeNodes.length; i < l; i++) {
			if (treeNodes[i].drag === false) {
				curDragNodes = null;
				return false;
			} else if (treeNodes[i].parentTId && treeNodes[i].getParentNode().childDrag === false) {
				curDragNodes = null;
				return false;
			}
		}
		curDragNodes = treeNodes;
		return true;
	}

	//对节点进行删除
	function onRemove(treeId, treeNodes) {}

	function beforeRemove(treeId, treeNode) {
		$.post('/admin/system/tree/remove', {
			id: treeNode.id
		},
		function(data) {
			location.reload();
		},
		'json')
	}

	//对节点进行重命名
	function onRename(event, treeId, treeNode, isCancel) {
		var new_name = treeNode.name;
		var id = treeNode.id;
		$.post('/admin/system/tree/rename', {
			id: id,
			name: new_name
		},
		function(data) {},
		'json')
	}

	//增加节点显示
	var newCount = 1;
	function addHoverDom(treeId, treeNode) {
		var sObj = $("#" + treeNode.tId + "_span");
		if (treeNode.editNameFlag || $("#addBtn_" + treeNode.tId).length > 0 || treeNode.add == false) return;
		var addStr = "<span class='button add' id='addBtn_" + treeNode.tId + "' title='add node' onfocus='this.blur();'></span>";
		sObj.after(addStr);
		var btn = $("#addBtn_" + treeNode.tId);
		if (btn) btn.bind("click", function() {
			$.post('/admin/system/tree/add_node', {
				cat_id: treeNode.id
			},
			function(data) {
				location.reload();
			},
			'json')
			return false;
		});
	};

	//增加节点隐藏
	function removeHoverDom(treeId, treeNode) {
		$("#addBtn_" + treeNode.tId).unbind().remove();

	};

	//右键菜单
	function OnRightClick(event, treeId, treeNode) {
		$('#rMenu').attr('m_id', treeNode.id);
		if (!treeNode && event.target.tagName.toLowerCase() != "button" && $(event.target).parents("a").length == 0) {
			zTree.cancelSelectedNode();
			showRMenu("root", event.clientX, event.clientY);

		} else if (treeNode && ! treeNode.noR) {
			zTree.selectNode(treeNode);
			showRMenu("node", event.clientX, event.clientY);

		}

	}

	function showRMenu(type, x, y) {
		$("#rMenu ul").show();
		/*
		if (type == "root") {
			$("#m_del").hide();
			$("#m_check").hide();
			$("#m_unCheck").hide();

		} else {
			$("#m_del").show();
			$("#m_check").show();
			$("#m_unCheck").show();

		}
		*/
		rMenu.css({
			"top": y - 50 + "px",
			"left": x - 260 + "px",
			"visibility": "visible"
		});

		$("body").bind("mousedown", onBodyMouseDown);

	}
	function hideRMenu() {
		if (rMenu) rMenu.css({
			"visibility": "hidden"
		});
		$("body").unbind("mousedown", onBodyMouseDown);

	}
	function onBodyMouseDown(event) {
		if (! (event.target.id == "rMenu" || $(event.target).parents("#rMenu").length > 0)) {
			rMenu.css({
				"visibility": "hidden"
			});

		}

	}

	//添加分类
	$('.cat_add').click(function() {
		$.post('/admin/system/tree/add_node', {
			cat_id: 0
		},
		function(data) {
			if (data.status == '1') {
				location.reload();
			}
		},
		'json')

	})

	//修改菜单
	$('#m_edit').click(function() {
		var id = $('#rMenu').attr('m_id');
		$.get('/admin/system/menu/get_info?id=' + id, function(data) {
			$('#title').val(data.data.title);
		},
		'json')
		var dlg = require('dlg');
		art.dialog({
			title: '菜单修改',
			content: document.getElementById('menu_edit_div'),
			cancel: true,
			lock: true,
			ok: function() {
				$.post('/admin/system/menu/doedit', {
					id:id,
					title:$('#title').val(),
					url:$('#url').val()
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
				'json');
			}

		})
	})

	//选择菜单类型,选择显示内容
	$('#menu_type').change(function() {
		var menu_type = $(this).val();
		if (menu_type == '1' || menu_type == 2) {
			$.get('/admin/system/menu/get_content_options?type=' + menu_type, function(data) {
				var options_str = '<option value="0">请选择</option>';
				for (var i = 0; i < data.data.length; i++) {
					options_str = options_str + '<option value="' + data.data[i]['id'] + '">' + data.data[i]['title'] + '</option>';
				}
				$('#content_select').html(options_str);
				$('#content_id').show();
			},
			'json')
		} else if (menu_type == '3') {
			$('#url').val('/product');
		} else {
			return false;
		}
	})

	//选择内容id后更改url
	$('#content_select').change(function() {
		var type_id = $('#menu_type').val();
		var content_id = $(this).val();
		if (content_id <= 0) {
			$('#url').val('');
			return false;
		}
		if (type_id == '1') {
			$('#url').val('/single/show/' + content_id);
		} else if (type_id == '2') {
			$('#url').val('/article/cat/' + content_id);
		}

	})

})

