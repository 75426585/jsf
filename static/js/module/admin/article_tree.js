define(function(require, exports) {
	require('ztree');
	//ztree 配置
	var setting = {
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
			beforeDrop: beforeDrop
		}
	};

	$(function() {
		$.get('/admin/article/tree_json', function(data) {
			$.fn.zTree.init($("#tree"), setting,data.data);
		},'json')
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
		console.log(moveType)
		return targetNode ? targetNode.drop !== false: true;
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

})

