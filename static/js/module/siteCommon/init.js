define(function(require,exports){
	var leftmenu = require('module/siteCommon/leftmenu.js');
	leftmenu.showLeftMenu();
	leftmenu.initSize();
	$('.menu').click(function(){
		var index = $(this).attr('index');
		leftmenu.showLeftMenu(index); 
	})

})
