define(function(require,exports){
	var _page=$("#page").attr("js");
	if(!_page){return false};
	seajs.use("module/"+_page);
})
