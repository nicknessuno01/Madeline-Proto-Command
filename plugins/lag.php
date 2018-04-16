<?php
// Calcolo del lag

if (strpos($msg, '>calclag') === 0 and in_array($userID, $admin))
	{
	$first = microtime();
	sm($chatID, 'Calcolo lag...', false, 'HTML', false, false, true);
	$now = microtime();
	sm($chatID, 'Lag: ' . ($now - $first) , false, 'HTML', false, false, true);
	exit;
	}
