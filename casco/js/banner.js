$.fn.banner = function(cla,tim){
	var $obj = $(cla);
	var timer;
	var len = $obj.find(".banner").length;		
	var str = "<li><a href='javascript:;'></a></li>";
	for (var i=0;i<len;i++)
		$obj.find("ul").append(str);
	var wid = $obj.find("ul").width();
	$obj.find("ul").css("marginLeft","-"+wid/2+"px");
	if ($obj.find(".banner").length<2)
				return false;
	$obj.find("ul li a").on("mouseover",function(){
		var index = $obj.find("ul li a").index($(this));
		changeImg(index);
	}).eq(0).mouseover();
	
	timer = setInterval(function(){
		var index = $obj.find("ul li a").index($obj.find("ul li a.cur"));
		timerFun(index);
	},tim);
	
	
	$obj.hover(function(){
		clearInterval(timer);	
	},function(){
		timer = setInterval(function(){
			var index = $obj.find("ul li a").index($obj.find("ul li a.cur"));
			timerFun(index);
		},tim);
	});
	
	$obj.find(".btn").click(function(){
		var index = $obj.find("ul li a").index($obj.find("ul li a.cur"));
		if ($(this).hasClass("left"))
		{
			index > 1 ? index-- : index = $obj.find(".banner").length-1;
			changeImg (index);		
		}
		else if ($(this).hasClass("right"))
		{
			index < $obj.find(".banner").length-1 ? index++ : index = 0;
			changeImg (index);		
		}
	});
	
	function timerFun(index)
	{
		index<len-1?index++:index=0;
		changeImg(index);		
	}
	
	function changeImg (index)
	{
		if (!$obj.find(".banner").is(":animated"))
		{
			$obj.find("ul li a").removeClass("cur").eq(index).addClass("cur");	
			$obj.find(".banner").fadeOut(300).eq(index).fadeIn(500);	
		}
			
	}
	
}