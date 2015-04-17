seajs.config({
	base:'/static/js/',
	alias:{
		'jquery':'/static/js/lib/jquery.min',
		'template':'/static/js/lib/template'
	}
})
seajs.use('jquery',function(){
	//加载全站都需要的入口
	seajs.use("module/siteCommon/init");
	
	var _page=$("#moduleId").attr("pagename");
	
	if(!_page){return false};
	
	seajs.use("module/"+_page+"/init");

})
