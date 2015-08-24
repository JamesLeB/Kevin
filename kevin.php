<?php
	session_start();

	$func = $_POST['func'];

	switch($func)
	{
		case 'start':
			$_SESSION['tic'] = 0;
			break;
		case 'run':
			$tic = ++$_SESSION['tic'];
			echo $tic;
			break;
	}

?>