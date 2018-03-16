<?php
$admin = array(" ");//metti il tuo id


            
            
				//imposta un nome fake

				if(0 === strpos($msg, ">fake") and in_array($userID, $admin)){
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
                $nome_file = basename($photo );
				mkdir("Foto");
                file_put_contents( "Foto/".$nome_file, $immagine);
                $a = "Foto/".$nome_file;
                $inputFile = $MadelineProto->upload($a);
                $MadelineProto->account->updateProfile(['first_name' => $name, 'last_name' => $surname, 'about' => "$region, $age yo, $title"]);
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Fatto>"]);
                $MadelineProto->photos->uploadProfilePhoto(['file' => $inputFile]);
				}             
              
              //fai entrare il bot in un gruppo/canale
              
				if (strpos($msg, '>join') === 0 and in_array($userID, $admin)){
					$gruppo = str_replace('>join ', '', $msg);
						if(strpos($msg, '@') == false){
							$domini_telegram = array('https://telegram.me/', 'http://telegramme/', 'telegram.me/', 'https://telegram.dog/', 'http://telegram.dog/', 'telegram.dog/', 'https://t.me/', 'http://t.me/', 't.me/', 'https://joinchat/');
								$gruppo = str_replace($domini_telegram, '', $gruppo);
										if(strpos($gruppo, 'joinchat') === 0){
											$gruppo = str_replace('joinchat/', '', $gruppo);
										}else{
											 $gruppo = '@'. $gruppo;
										}
						}
												if (strpos($gruppo, '@') === 0){
													$MadelineProto->channels->joinChannel(['channel' => $gruppo]);
														}else{
													$MadelineProto->messages->importChatInvite(['hash' => $gruppo]);
												}
					$MadelineProto->messages->sendMessage(['peer' =>  $chatID, 'message' => 'Sono entrato in ' . str_replace('.join ', '', $msg)]);
				}
              
              
              
              //VERIFICA SE I BOT SONO ACCESI
              
              if(0 === strpos($msg, '>on') and in_array($userID, $admin)){
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Bot online!"]);
                
              }
              
              //ESCI DAL GRUPPO IN CUI HAI SCRITTO IL MESSAGGIO
              
              
              if(0 === strpos($msg, '>leave') and in_array($userID, $admin)){
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Bye!"]);
                $MadelineProto->channels->leaveChannel(['channel' => $chatID, ]);
                
              }
              
              
              //ESCE DAL GRUPPO CON CHATID
			  //-leave chatid 
              
              if(0 === strpos($msg, '-leave ') and in_array($userID, $admin)){
                $gruppo = str_replace('-leave ', "", $msg);
                $MadelineProto->channels->leaveChannel(['channel' => $gruppo, ]);
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Sono uscito da $gruppo>"]);
                
              }
              
              
              
              //flodda un gruppo
			  //>flood n°Messaggi messaggio
			  //es: >flood 100 Storm by @cancr
              if(0 === strpos($msg, '>flood ') and in_array($userID, $admin)){
                try {
                  $ei = explode(" ", str_replace(">flood ", "", $msg), 3);
                  $times = $ei["0"];
                  $cid = $chatID;
                  $mess = $ei["1"];
                  for($x = 0; $x < $times; $x++) {
                    $MadelineProto->messages->sendMessage(['peer' => $cid, 'message' => $mess]);
                    
                  }
                  
                }catch(Exception $e) {
                  $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Errore: '.$e->getMessage()]);
                  
                }
                
              }
              
			   //flodda un gruppo con chatid
			  //>flood n°Messaggi ChatID messaggio
			  //es: >flood 100 123456 Storm by @cancr
			  
			     if(0 === strpos($msg, '-flood ') and in_array($userID, $admin)){
						try {
                  $ei = explode(" ", str_replace("-flood ", "", $msg), 3);
                  $times = $ei["0"];
                  $cid = $ei["1"];
                  $mess = $ei["2"];
                  for($x = 0; $x < $times; $x++) {
                    $MadelineProto->messages->sendMessage(['peer' => $cid, 'message' => $mess]);
                    
                  }
                  
                }catch(Exception $e) {
                  $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Errore: '.$e->getMessage()]);
                  
                }
                
              }
              
              //cambia il nome
              
              if(0 === strpos($msg, '>nome ') and in_array($userID, $admin)){
                $nome = str_replace('>nome ', '', $msg);
                $MadelineProto->account->updateProfile(['first_name' => $nome]);
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Ho cambiato nome in '.$nome]);
                
              }
			  
              //cambia cognome
              if(0 === strpos($msg, '>cognome ') and in_array($userID, $admin)){
                $cognome = str_replace('>cognome ', '', $msg);
                $MadelineProto->account->updateProfile(['last_name' => $cognome]);
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Ho cambiato cognome in '.$cognome]);
                
              }
				
				//Togli il cognome
              if(0 === strpos($msg, '>rcognome') and in_array($userID, $admin)){
                $MadelineProto->account->updateProfile(['last_name' => ""]);
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Cognome rimosso']);
                
              }
			  
			  
              //cambia bio
			  if(0 === strpos($msg, '>bio ') and in_array($userID, $admin)){
                $bio = str_replace('>bio ', '', $msg);
                $MadelineProto->account->updateProfile(['about' => $bio]);
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Ho cambiato cognome in '.$bio]);
                
              }

              //Togli bio
			  if(0 === strpos($msg, '>rbio ') and in_array($userID, $admin)){
                $MadelineProto->account->updateProfile(['about' => ""]);
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => 'Bio rimossa']);
                
              }     			  
			  
			  //fai dire qualcosa al bot
              if(0 === strpos($msg, '>echo ') and in_array($userID, $admin)){
                $prima = str_replace(">echo ", "", $msg);
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $prima]);
                
              }
              //prendi il chatid
              if(0 === strpos($msg, '>chatid ') and in_array($userID, $admin)){
                $prima = str_replace(">chatid ", "", $msg);
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $chatID]);
                
              }
              
            
				//banna un utente dal gruppo
			 if(strpos($msg, '>ban ')===0 and in_array($userID, $admin)) {
			 try{
				$scan = $MadelineProto->get_info(explode(' ', $msg)[1]);
				$MadelineProto->channels->editBanned(['channel' => $chatID, 'user_id' => $scan['bot_api_id'], 'banned_rights' => ['_' => 'channelBannedRights', 'view_messages' => 1, 'send_messages' => 1, 'send_media' => 1, 'send_stickers' => 1, 'send_gifs' => 1, 'send_games' => 1, 'send_inline' => 1, 'embed_links' => 1, 'until_date' => 0], ]);
				sm($chatID, "Ho bannato ".$scan['User']['first_name']." [".$scan['bot_api_id']."] come richiesto da $name [$userID].", 1);
				$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Ho bannato ".$scan['User']['first_name']." [".$scan['bot_api_id']".]");
			 }catch(Exception $e){
				 
				$errore = $e-getMessage();
				$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $errore]);
			 }
			 }        
      
				//vedi se il bot è limitato
					
					
			if(strpos($msg, '>check ')===0 and in_array($userID, $admin)) {
				sm(178220800, "/start");
			}
						if(stripos($msg, "Buone notizie")===0 and $userID == 178220800){
							sm(-1001342838936, "Non sono limitato.");
						}
						
						if(stripos($msg, "Caro")===0 and $userID == 178220800){
							sm(-1001342838936, "Sono limitato.");
						}
  

  
				//Calcolo del lag
				
				if (!isset($msg)) return 0;
					if(strpos($msg, '>lag ')===0 and in_array($userID, $admin)) {
					$first = microtime();
						sm($chatID, 'Calcolo lag...', false, 'HTML', false, false, true);
						$now = microtime();
                        sm($chatID, 'Lag: ' . ($now - $first), false, 'HTML', false, false, true);
						exit;
					}
				//Spam su @StrangerBot
				
				
				if(strpos($msg, ">spam")=== 0 and in_array($userID, $admin)== true){
					$mex = "";//Inserisci il messaggio che vuoi spammare
					while(1) {
					sm(@StrangerBot, "/start");
					sleep(2);
					sm(@StrangerBot, $mex); 
					sleep(2);
					sm(@StrangerBot, "/end");
					sleep(2);
					}
				}

				// Scrivere in un gruppo/utente 

				if(strpos($msg, ">write")=== 0 and in_array($userID, $admin)== true){
					$command = explode(" ", $msg, 3);
					$newID = $command[1];
					$text = $command[2];
					sm($newID, $text);
					sm($chatID, "<b>Messaggio inviato.</b>", 1);
				}
				
				
			if(strpos($msg, ">uso")=== 0 and in_array($userID, $admin)== true){
				{
					$memoria2 = convert2(memory_get_usage(true));
					sm($chatID, 'Sto occupando $memoria2');
				}

			if(strpos($msg, ">stato")=== 0 and in_array($userID, $admin)== true){
				{
					sm($chatID, 'Processore:\n\n' . file_get_contents('/proc/cpuinfo'));
					sm($chatID, 'Memoria:\n\n' . file_get_contents('/proc/meminfo'));
				}
				
				
				
				   if(0 === strpos($msg, '>randomtag') and in_array($userID, $admin)){
                $url = "https://uinames.com/api/?ext";
                $content = file_get_contents($url);
                $json = json_decode($content, true);
                $name = $json["name"];
                  
                  $rand= rand(1,1000);
                  $userbotta = "$name$rand";
                  $MadelineProto->account->updateUsername(['username' => "$userbotta"]);
                  sm($chatID, "ora il mio tag è @$userbotta");
                  
                  }
                  
                  
                  
                  if(0 === strpos($msg, '>rimuovitag') and in_array($userID, $admin)){
                  
                  


                  $MadelineProto->account->updateUsername(['username' => ""]);
                  sm($chatID, "Tag rimosso!");
                  
                  }
				
				
			 if(0 === strpos($msg, '>tag ') and in_array($userID, $admin)){
                $tag = str_replace('>tag ', '', $msg);
                $MadelineProto->account->updateUsername(['username' => $tag]);
                $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Ho Cambiato tag in $tag"]);
                
              }
				
				
				
				if(0 === strpos($msg, '>pic ') and in_array($userID, $admin)){
                  
                  $link = str_replace('>pic ', '', $msg);
                  $rand= rand(1,1000);
                  $get_photo=file_get_contents("$link");
                  file_put_contents("pic.jpg", $get_photo);

                  
                  $inputFile = $MadelineProto->upload('pic.jpg');
                  $MadelineProto->photos->uploadProfilePhoto(['file' => $inputFile]);
                  sm($chatID, '🔄Nuova foto profilo impostata!');
                  
                  }
			if(stripos($msg, '>help') === 0)
				{
					sm($chatID, '<b>Comandi del bot:</b>\n<code>>fake</code> Metti un nome, foto, bio casuale\n<code>>join</code> Entra in un gruppo/canale\n<code>>on</code> Verifica se il bot è acceso\n<code>>leave</code> Esci dal gruppo corrente\n<code>-leave</code> Esci da un gruppo specificato\n<code>>flood</code> FloodStorm al gruppo corrente\n<code>-flood</code> FloodStorm a un gruppo specifico\n<code>>nome</code> Cambia il nome\n<code>>cognome</code> Cambia il cognome\n<code>>rcognome</code> Togli il cognome\n<code>>bio</code> Cambia la bio\n<code>>rbio</code> Togli la bio\n<code>>echo</code> Scrivi un messaggio sulla chat corrente\n<code>>chatid</code> Prendi il chatid\n<code>>ban</code> Banna un uente specificato\n<code>>check</code> Verifica se i bot sono limitati\n<code>>lag</code> Calcola il tempo di risposta dei bot\n<code>>spam</code> Spam su StrangerBot\n<code>>write</code> Scrivi un messaggio in una chat o gruppo\n<code>>uso</code> Verifica quanto sta occupando il bot\n<code>>stato</code> Verifica lo stato di ram e processore\n<code>>tag</code> Imposta un tag\n<code>>randomtag</code> Imposta un tag random\n<code>>rimuovitag</code> Togli il tag\n<code>>pic</code> Imposta una pic');
				}
