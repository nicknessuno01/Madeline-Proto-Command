<?php
//Verifica se il bot è limitato

if (strpos($msg, '>check') === 0 and in_array($userID, $admin))
	{
	sm(178220800, "/start");
	}

$idchat = "-1001398432480"; //mettere l'id della chat dove il bot mandera il resoconto

if (stripos($msg, "Buone notizie") === 0 and $userID == 178220800)
	{
	sm($idchat, "Non sono limitato.");
	}

if (stripos($msg, "Caro") === 0 and $userID == 178220800)
	{
	sm($idchat, "Sono limitato.");
	}
