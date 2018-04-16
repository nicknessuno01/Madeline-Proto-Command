<?php
// fai dire qualcosa al bot

if (0 === strpos($msg, '>echo ') and in_array($userID, $admin))
	{
	$prima = str_replace(">echo ", "", $msg);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $prima]);
	}
