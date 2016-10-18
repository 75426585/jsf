$(function($) {
	var options = {
		//是否自动播放
		$AutoPlay: true,
		//播放间隔时间
		$AutoPlayInterval: 4000,
		//滚动的时间
		$SlideDuration: 500,
		//拖动方向
		$DragOrientation: 3,
		//???
		$UISearchMode: 0,
		$ThumbnailNavigatorOptions: {
			//实例
			$Class: $JssorThumbnailNavigator$,
			//缩略图显示方式,0:nerver,1:mouse over show,2:always
			$ChanceToShow: 2,
			//是否循环显示
			$Loop: 0,
			//缩略图横向间隔
			$SpacingX: 3,
			//缩略图纵向间隔
			$SpacingY: 3,
			//图片个数
			$DisplayPieces: 6,
			//停留的边框
			$ParkingPosition: 253,
			$ArrowNavigatorOptions: {
				$Class: $JssorArrowNavigator$,
				$ChanceToShow: 2,
				$AutoCenter: 2,
				$Steps: 6
			}
		}

	};

	var jssor_slider1 = new $JssorSlider$("slider1_container", options);

	//自适应屏幕的缩放
	function ScaleSlider() {
		var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
		if (parentWidth) jssor_slider1.$ScaleWidth(Math.min(parentWidth, 720));
		else window.setTimeout(ScaleSlider, 30);
	}
	ScaleSlider();

	$(window).bind("load", ScaleSlider);
	$(window).bind("resize", ScaleSlider);
	$(window).bind("orientationchange", ScaleSlider);
	//$('#slider1_container').show();
})

