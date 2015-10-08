define(function(require,exports){
	var template = require('template');

	//初始化中间栏的高度
	exports.initSize = function(){
		var w_height = $(window).height();
		$(".left-bar").height(w_height-80);
		$(".main-div").height(w_height-80);
	}

})
