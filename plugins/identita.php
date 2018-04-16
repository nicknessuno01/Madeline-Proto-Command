<?php
// cambia il nome

if (0 === strpos($msg, '>nome ') and in_array($userID, $admin))
	{
	$nome = str_replace('>nome ', '', $msg);
	$MadelineProto->account->updateProfile(['first_name' => $nome]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Ho cambiato nome in ' . $nome]);
	}

// cambia cognome

if (0 === strpos($msg, '>cognome ') and in_array($userID, $admin))
	{
	$cognome = str_replace('>cognome ', '', $msg);
	$MadelineProto->account->updateProfile(['last_name' => $cognome]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Ho cambiato cognome in ' . $cognome]);
	}

// Togli il cognome

if (0 === strpos($msg, '>rcognome') and in_array($userID, $admin))
	{
	$MadelineProto->account->updateProfile(['last_name' => ""]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Cognome rimosso']);
	}

// cambia bio

if (0 === strpos($msg, '>bio ') and in_array($userID, $admin))
	{
	$bio = str_replace('>bio ', '', $msg);
	$MadelineProto->account->updateProfile(['about' => $bio]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Ho cambiato cognome in ' . $bio]);
	}

// Togli bio

if (0 === strpos($msg, '>rbio') and in_array($userID, $admin))
	{
	$MadelineProto->account->updateProfile(['about' => ""]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Bio rimossa']);
	}

//tag random
if (0 === strpos($msg, '>randomtag') and in_array($userID, $admin))
	{
	$url = "https://uinames.com/api/?ext";
	$content = file_get_contents($url);
	$json = json_decode($content, true);
	$name = $json["name"];
	$rand = rand(1, 1000);
	$userbotta = "$name$rand";
	$MadelineProto->account->updateUsername(['username' => "$userbotta"]);
	sm($chatID, "ora il mio tag Ã¨ @$userbotta");
	}

//leva il tag
if (0 === strpos($msg, '>rimuovitag') and in_array($userID, $admin))
	{
	$MadelineProto->account->updateUsername(['username' => ""]);
	sm($chatID, "Tag rimosso!");
	}

//scegli un tag

if (0 === strpos($msg, '>tag ') and in_array($userID, $admin))
	{
	$tag = str_replace('>tag ', '', $msg);
	$MadelineProto->account->updateUsername(['username' => $tag]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Ho Cambiato tag in $tag"]);
	}

//imposta una pic
if (0 === strpos($msg, '>pic ') and in_array($userID, $admin))
	{
	$link = str_replace('>pic ', '', $msg);
	$rand = rand(1, 1000);
	$get_photo = file_get_contents("$link");
	file_put_contents("pic.jpg", $get_photo);
	$inputFile = $MadelineProto->upload('pic.jpg');
	$MadelineProto->photos->uploadProfilePhoto(['file' => $inputFile]);
	sm($chatID, 'ðŸ”„Nuova foto profilo impostata!');
	}
