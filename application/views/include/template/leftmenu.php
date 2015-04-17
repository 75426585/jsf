<script id="submenu" type="text/html">
    {{each submenu as value i}}
	<dd><a href="{{value.url}}" target="main">{{value.name}}</a></dd>
    {{/each}}
</script>
