<?php
// ESCI DAL GRUPPO IN CUI HAI SCRITTO IL MESSAGGIO

if (0 === strpos($msg, '>leave') and in_array($userID, $admin))
	{
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Bye!"]);
	$MadelineProto->channels->leaveChannel(['channel' => $chatID, ]);
	}

// ESCE DAL GRUPPO CON CHATID
// -leave chatid

if (0 === strpos($msg, '-leave ') and in_array($userID, $admin))
	{
	$gruppo = str_replace('-leave ', "", $msg);
	$MadelineProto->channels->leaveChannel(['channel' => $gruppo, ]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Sono uscito da $gruppo>"]);
	}
