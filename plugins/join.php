<?php

if (strpos($msg, '>join') === 0 and in_array($userID, $admin))
	{
	$gruppo = str_replace('>join ', '', $msg);
	if (strpos($msg, '@') == false)
		{
		$domini_telegram = array(
			'https://telegram.me/',
			'http://telegramme/',
			'telegram.me/',
			'https://telegram.dog/',
			'http://telegram.dog/',
			'telegram.dog/',
			'https://t.me/',
			'http://t.me/',
			't.me/',
			'https://joinchat/'
		);
		$gruppo = str_replace($domini_telegram, '', $gruppo);
		if (strpos($gruppo, 'joinchat') === 0)
			{
			$gruppo = str_replace('joinchat/', '', $gruppo);
			}
		  else
			{
			$gruppo = '@' . $gruppo;
			}
		}

	if (strpos($gruppo, '@') === 0)
		{
		$MadelineProto->channels->joinChannel(['channel' => $gruppo]);
		}
	  else
		{
		$MadelineProto->messages->importChatInvite(['hash' => $gruppo]);
		}

	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Sono entrato in ' . str_replace('.join ', '', $msg) ]);
	}
