<?php

if (0 === strpos($msg, '>on') and in_array($userID, $admin))
	{
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Bot online!"]);
	}
