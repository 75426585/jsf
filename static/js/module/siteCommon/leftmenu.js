define(function(require,exports){
	var template = require('template');
	var init = function(){
		showLeftMenu(0);
	}
	//显示菜单
	exports.showLeftMenu = function(index){
		$.post('/admin/home/getsubmenu',{index:index},function(data){
			var html = template('submenu',data);
			document.getElementById('leftbar').innerHTML = html;
		},"json")
	}
	//初始化窗口大小
	exports.initSize = function(){
		var w_height = $(window).height();
		var w_width = $(window).width();
		$(".left_menu").height(w_height-80);
		$(".main").width(w_width-100);
		$(".main").height(w_height-80);
	}
})
