<?php
// banna un utente dal gruppo

if (strpos($msg, '>ban ') === 0 and in_array($userID, $admin))
	{
	try
		{
		$scan = $MadelineProto->get_info(explode(' ', $msg) [1]);
		$MadelineProto->channels->editBanned(['channel' => $chatID, 'user_id' => $scan['bot_api_id'], 'banned_rights' => ['_' => 'channelBannedRights', 'view_messages' => 1, 'send_messages' => 1, 'send_media' => 1, 'send_stickers' => 1, 'send_gifs' => 1, 'send_games' => 1, 'send_inline' => 1, 'embed_links' => 1, 'until_date' => 0], ]);
		sm($chatID, "Ho bannato " . $scan['User']['first_name'] . " [" . $scan['bot_api_id'] . "] come richiesto da $name [$userID].", 1);
		$nome = $scan['User']['first_name'];
		$id = $scan['bot_api_id'];
		sm($chatID, "Ho bannato $nome [$id]");
		}

	catch(Exception $e)
		{
		$errore = $e - getMessage();
		$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $errore]);
		}
	}
