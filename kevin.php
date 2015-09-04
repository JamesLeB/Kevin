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
		case 'run':
			$tic = ++$_SESSION['tic'];

			$payload = $_POST['payload'];
			if($payload)
			{
				foreach($payload as $p)
				{
					$o = json_decode($p,true);
					$s = $o['sequence'];
					$_SESSION['messages'][$s] = $p;
				}
			}

			$cReceived = 0;
			$cOpen = 0;
			$cDone = 0;
			$cMatch = 0;
			$cError = 0;
			file_put_contents('files/test',"Log File\n*****************");
			$keys = array_keys($_SESSION['messages']);
			sort($keys);
			$cSeq = $keys[0];
			foreach($keys as $key)
			{
				$m = $_SESSION['messages'][$key];
				$o = json_decode($m,true);
				switch($o['type'])
				{
					case 'received': ++$cReceived; break;
					case 'open':     ++$cOpen;     break;
					case 'done':     ++$cDone;     break;
					case 'match':    ++$cMatch;    break;
					default:         ++$cError;
						file_put_contents('files/test',"\n$key : $m",FILE_APPEND);
				}
			}

			$rtn['tic'] = $tic.
				' Msgs: '     .sizeof($_SESSION['messages']).
				' Received: ' .$cReceived.
				' Open: '     .$cOpen.
				' Done: '     .$cDone.
				' Match: '    .$cMatch.
				' Error: '    .$cError.
				' Seq: '      .$cSeq;

			$rtn['book'] = 'Where is the book?';

			break;
	}

	echo json_encode($rtn);

?>
