<?php
// flodda un gruppo

// >flood n°Messaggi messaggio
// es: >flood 100 Storm by @cancr

if (0 === strpos($msg, '>flood ') and in_array($userID, $admin))
	{
	try
		{
		$ei = explode(" ", str_replace(">flood ", "", $msg) , 3);
		$times = $ei["0"];
		$cid = $chatID;
		$mess = $ei["1"];
		for ($x = 0; $x < $times; $x++)
			{
			$MadelineProto->messages->sendMessage(['peer' => $cid, 'message' => $mess]);
			}
		}

	catch(Exception $e)
		{
		$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Errore: ' . $e->getMessage() ]);
		}
	}

// flodda un gruppo con chatID

// >flood n°Messaggi ChatID messaggio
// es: >flood 100 123456 Storm by @cancr

if (0 === strpos($msg, '-flood ') and in_array($userID, $admin))
	{
	try
		{
		$ei = explode(" ", str_replace("-flood ", "", $msg) , 3);
		$times = $ei["0"];
		$cid = $ei["1"];
		$mess = $ei["2"];
		for ($x = 0; $x < $times; $x++)
			{
			$MadelineProto->messages->sendMessage(['peer' => $cid, 'message' => $mess]);
			}
		}

	catch(Exception $e)
		{
		$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Errore: ' . $e->getMessage() ]);
		}
	}
