$(function(){
	
	$.fn.scrollImg = function (scro,leftBtn,rightBtn,dm,wid,speed)
	{
		
		var timer , flg = 0;
		var $obj = $(scro) , displayMum = dm;
		var $leftBtn = $(leftBtn) , $rightBtn = $(rightBtn);
		var len = $obj.find("li").length;
		var wid = wid;
		

		$rightBtn.click(function(){
			var lef = Math.abs($obj.css("left").split("px")[0]);
			if (!$obj.is(":animated"))
			{
				if (lef < (len-displayMum) * wid)
				{
					$leftBtn.addClass("have");
					$obj.animate({"left":"-"+(lef + +wid)+"px"},speed);
					var flg = (lef + +wid)/wid;
					if (lef==(len-displayMum-1) * wid)
						$rightBtn.removeClass("have");
				}
			}
			
		});
		
		$leftBtn.click(function(){
			var lef = $obj.css("left").split("px")[0];
			if (!$obj.is(":animated"))
			{
				if (lef < 0)	
				{
					$rightBtn.addClass("have");
					$obj.animate({"left":"-"+(Math.abs(lef)-wid)+"px"},speed);
					var flg = (Math.abs(lef)-wid)/wid;
					if (Math.abs(lef)==wid)
						$leftBtn.removeClass("have");
				}
			}
		});
			
	}
		

});