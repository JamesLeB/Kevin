<?php
	session_start();

	$func = $_POST['func'];
	$rtn = array();

	switch($func)
	{
		case 'start':
			$_SESSION['tic'] = 0;
			file_put_contents('files/test',"Test data here\n*********************");
			break;
		case 'run':
			$tic = ++$_SESSION['tic'];
			$rtn['tic'] = $tic;

			$payload = $_POST['payload'];
			if($payload)
			{
				foreach($payload as $p)
				{
					$o = json_decode($p,true);
					$t = $o['type'];
					$s = $o['sequence'];
					file_put_contents('files/test',"\n$p\n********",FILE_APPEND);
				}
			}

			$rtn['book'] = 'Book';

			break;
	}

	echo json_encode($rtn);

?>
