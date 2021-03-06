var stop = 0;
var ws = {};
var message = 0;
var sequence = 0;
var activeBuffer = 1;
var buffer1 = [];
var buffer2 = [];

function start()
{
	var p = {func: 'start'};
	$.post('kevin.php',p,function(d){
		tick();
	});
}

function tick()
{
	var payload = [];
	if( activeBuffer == 1 )
	{
		activeBuffer = 2;
		payload = buffer1;
		buffer1 = [];
	}
	else
	{
		activeBuffer = 1;
		payload = buffer2;
		buffer2 = [];
	}

	var p = { func: 'run', payload: payload };
	$.post('kevin.php',p,function(d)
	{
		var o = $.parseJSON(d);

		$('#kTime').html(o.tic);
		if(o.book != 0){
			$('#kOrderBook').html(o.book);
		}


		//if(o.payload != null){$('#kOrderBook').html(o.payload);}

		$('#kSocket').html('');
		$('#kSocket').append('Msg: ' +message);
		$('#kSocket').append(' B1: ' +buffer1.length);
		$('#kSocket').append(' B2: ' +buffer2.length);
		$('#kSocket').append(' Seq: '+sequence);
		$('#kSocket').append(' stop: '+o.stop);
		if(o.stop==1){stopx();}
		if(stop==0){tick();}
	});
}

function webSocket()
{
	ws = new WebSocket('wss://ws-feed.exchange.coinbase.com');
	ws.onopen = function()
	{
		ws.send('{ "type": "subscribe", "product_id": "BTC-USD" }');
	}
	ws.onmessage = function(evt)
	{
		message++;
		if(message==10){start();}

 		buffer1.push(evt.data);
		buffer2.push(evt.data);

		var obj = $.parseJSON(evt.data);
		sequence = obj.sequence;

	};
}

function stopx()
{
	ws.close();
	stop=1;
}

function getBook()
{
	var p = {func: 'book'};
	$.post('kevin.php',p,function(d){
		var o = $.parseJSON(d);
		$('#kOrders').html(o.book);
	});
}

$(document).ready(function()
{
	//$('#tabs').tabs({active:0});
	//$('#go').click(function(){stop=0;message=0;webSocket();});
	//$('#stopB').click(function(){stopx();});
	//$('#getBook').click(function(){getBook();});
	//webSocket();
});
