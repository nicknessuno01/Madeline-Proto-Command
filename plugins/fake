<?php

// imposta un nome fake

if (0 === strpos($msg, ">fake") and in_array($userID, $admin))
	{
	$url = "https://uinames.com/api/?ext";
	$content = file_get_contents($url);
	$json = json_decode($content, true);
	$name = $json["name"];
	$surname = $json["surname"];
	$photo = $json["photo"];
	$region = $json["region"];
	$age = $json["age"];
	$title = $json["title"];
	$immagine = file_get_contents($photo);
	$nome_file = basename($photo);
	file_put_contents("Foto/" . $nome_file, $immagine);
	$a = "Foto/" . $nome_file;
	$inputFile = $MadelineProto->upload($a);
	$MadelineProto->account->updateProfile(['first_name' => $name, 'last_name' => $surname, 'about' => "$region, $age yo, $title"]);
	$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Fatto>"]);
	$MadelineProto->photos->uploadProfilePhoto(['file' => $inputFile]);
	}
