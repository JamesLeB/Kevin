
$(document).ready(function(){
	$('#tabs').tabs({active:0});
	$('#go').click(function(){start();});
	function start()
	{
		p = {func: 'start'};
		$.post('kevin.php',p,function(d){
			tick();
		});
	}
	function tick()
	{
		p = {func: 'run'};
		$.post('kevin.php',p,function(d){
			$('#clock').html(d);
			tick();
		});
	}
});
