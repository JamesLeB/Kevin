<!DOCTYPE html>
<html>
	<head>
		<title>Kevin</title>
		<script src='jquery/jquery-1.11.1.js'></script>
		<script src='jquery/jquery-ui.js'></script>
		<!--
		--!>
		<script src='script.js'></script>
		<link  href='jquery/jquery-ui.css' rel='stylesheet'/>
		<link  href='style.css' rel='stylesheet'/>
	</head>
	<body>
		<div id='wrapper'>
			<div id='header'></div>
			<div id='main'>
				<div id='tabs'>
					<ul>
						<li><a href='#tab1'>Bello</a></li>
					</ul>
					<div id='tab1'>
						<div id='kTime'></div>
						<div id='kSocket'></div>
						<div id='kOrderBook'></div>
						<div id='kTrader'>
							<button id='go'>GO</button>
							<button id='stopB'>Stop</button>
							<button id='getBook'>GetBook</button>
						</div>
						<div id='kOrders'>Orders</div>
						<div>Lots</div>
						<div id='kTrades'>Trades</div>
					</div>
				</div>
			</div>
			<div id='footer'></div>
		</div>
	</body>
</html>
