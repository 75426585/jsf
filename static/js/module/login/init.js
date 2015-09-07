define(function(require,exports){
	$('#updateCode').click(function(){
		$('#code').attr('src', $('#code').attr('xsrc') + '?' + Math.random());
	})
})
