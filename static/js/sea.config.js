seajs.config({
	base: '/static/js/',
	alias: {
		'jquery': 'http://of8azey74.bkt.clouddn.com/jquery.1.10.0.min.js',
		'template': 'lib/template',
		'dlg': 'lib/artDialog/jquery.artDialog.js?skin=blue',
		'ztree': 'lib/ztree/jquery.ztree.all-3.5.min.js',
		//'fancybox': 'lib/fancybox/jquery.fancybox.pack.js',
		'fancybox': 'http://apps.bdimg.com/libs/fancybox/2.1.5/jquery.fancybox.pack.js',
		'jssor': 'lib/jssor.slider.mini.js',
		'sdmenu': 'lib/sdmenu.js',
	}
})
seajs.use('jquery', function() {
	//加载全站都需要的入口
	var url = location.href;
	if (url.match('\/admin')) {
		seajs.use("module/admin/init");
	} else {
		seajs.use("module/siteCommon/init");
	}
	if ($('#template').val() == 'main') {
		seajs.use("sdmenu");
	}		
	var _page = $("#page").attr("js");
	if (!_page) {
		return false
	};
	seajs.use("module/" + _page);
})

