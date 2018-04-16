<?php
// Scrivere in un gruppo/utente

if (strpos($msg, ">write") === 0 and in_array($userID, $admin) == true)
	{
	$command = explode(" ", $msg, 3);
	$newID = $command[1];
	$text = $command[2];
	sm($newID, $text);
	sm($chatID, "<b>Messaggio inviato.</b>", 1);
	}
