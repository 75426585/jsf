define(function(require,exports){
	if(location.href.match('admin')){
		require('module/admin/init');
	}
})
