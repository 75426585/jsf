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
			beforeRemove: beforeRemove
		}
	};

	$(function() {
		$.get('/admin/article/tree_json', function(data) {
			$.fn.zTree.init($("#tree"), setting, data.data);
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
		//一级不能成为二级
		if (!targetNode || targetNode.drop == false) {
			return false;
		}
		//二级不能成为1级
		if (treeNodes[0].pId != '0' && moveType != 'inner' && targetNode.pId == null ) {
			return false;
		}
		$.post('/admin/article/tree/change_order', {
			id_one: treeNodes[0].id,
			id_two: targetNode.id,
			type: moveType,
			pid: targetNode.pId
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
		var curDragPId = curDragNodes[0].pId;
		if (!curDragPId && ! targetNode.pId) {
			return false;
		}
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
		$.post('/admin/article/tree/remove', {
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
		$.post('/admin/article/tree/rename', {
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
			var zTree = $.fn.zTree.getZTreeObj("tree");
			$.post('/admin/article/tree/add_node', {
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

})

