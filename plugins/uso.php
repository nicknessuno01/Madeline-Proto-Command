<?php
if (strpos($msg, ">uso") === 0 and in_array($userID, $admin) == true)
	{
	$memoria2 = convert2(memory_get_usage(true));
	sm($chatID, "Sto occupando $memoria2");
	}

if (strpos($msg, ">stato") === 0 and in_array($userID, $admin) == true)
	{
	sm($chatID, "Processore:nn" . file_get_contents('/proc/cpuinfo'));
	sm($chatID, "Memoria:nn" . file_get_contents('/proc/meminfo'));
	}
