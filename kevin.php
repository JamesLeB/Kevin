<?php
	session_start();

	$func = $_POST['func'];
	$rtn = array();

	switch($func)
	{
		case 'start':
			$_SESSION['tic'] = 0;
			$_SESSION['messages'] = array();
			break;
		case 'book':
			$rtn['book'] = 'the book will go here';
			break;
		case 'run':
			$tic = ++$_SESSION['tic'];
			$rtn['tic'] = $tic; 
			$rtn['stop'] = 0;
			$rtn['book'] = 0;

			$cReceived = 0;
			$cOpen = 0;
			$cDone = 0;
			$cMatch = 0;
			$cError = 0;
			$cSeq = 0;

			if(isset($_POST['payload'])){
				$payload = $_POST['payload'];
				foreach($payload as $p)
				{
					$o = json_decode($p,true);
					$s = $o['sequence'];
					$_SESSION['messages'][$s] = $p;
				}
				if(sizeof($_SESSION['messages']) > 499){
					$rtn['stop'] = 1;
				}
	
				$keys = array_keys($_SESSION['messages']);
				sort($keys);
				$cSeq = $keys[0];

				file_put_contents('files/test.txt',"Log File\n*****************");
				file_put_contents('files/mess.txt',"Clear\n*****************");

				foreach($keys as $key)
				{
					$m = $_SESSION['messages'][$key];
					file_put_contents('files/mess.txt',"\n$key : $m",FILE_APPEND);
					$o = json_decode($m,true);
					switch($o['type'])
					{
						case 'received': ++$cReceived; break;
						case 'open':     ++$cOpen;     break;
						case 'done':     ++$cDone;     break;
						case 'match':    ++$cMatch;    break;
						default:         ++$cError;
							file_put_contents('files/test.txt',"\n$key : $m",FILE_APPEND);
					}
				}

				$rtn['book'] = $tic.
					' Msgs: '     .sizeof($_SESSION['messages']).
					' Received: ' .$cReceived.
					' Open: '     .$cOpen.
					' Done: '     .$cDone.
					' Match: '    .$cMatch.
					' Error: '    .$cError.
					' Seq: '      .$cSeq;
			}

			break;
	} # End master switch

	echo json_encode($rtn);

?>
