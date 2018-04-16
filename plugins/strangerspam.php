<?php
// Spam su @StrangerBot

if (strpos($msg, ">spam") === 0 and in_array($userID, $admin) == true)
	{
	$mex = ""; //Inserisci il messaggio che vuoi spammare
	while (1)
		{
		sm(@StrangerBot, "/start");
		sleep(2);
		sm(@StrangerBot, $mex);
		sleep(2);
		sm(@StrangerBot, "/end");
		sleep(2);
		}
	}
