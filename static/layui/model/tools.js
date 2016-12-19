layui.use(['form'], function() {
	var form = layui.form();
	form.on('submit(tms)', function() {
		alert('ddd')
		return false;
	})
});

