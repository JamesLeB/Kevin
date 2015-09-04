<?php
	session_start();

	$func = $_POST['func'];
	$rtn = array();

	switch($func)
	{
		case 'start':
			$_SESSION['tic'] = 0;
			break;
		case 'run':
			$tic = ++$_SESSION['tic'];
			$rtn['tic'] = $tic;
			$rtn['payload'] = $_POST['payload'];
			break;
	}

	echo json_encode($rtn);

?>
