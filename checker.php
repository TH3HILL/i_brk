<?php
// BROK - @x_BRK - @i_BRK //
date_default_timezone_set("Asia/Baghdad");
  if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
  }
  define('MADELINE_BRANCH', 'deprecated');
  include 'madeline.php';
  $settings['app_info']['api_id'] = 579315;
  $settings['app_info']['api_hash'] = '4ace69ed2f78cec268dc7483fd3d3424';
  $MadelineProto = new \danog\MadelineProto\API('BROK.madeline', $settings);
  $MadelineProto->start();
function bot($method, $datas = []) {
	$token = file_get_contents("token");
	$url = "https://api.telegram.org/bot$token/" . $method;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$res = curl_exec($ch);
	curl_close($ch);
	return json_decode($res, true);
}
$type = file_get_contents("type");
if($type == "c"){
$x = 0;
$updates = $MadelineProto->channels->createChannel(['broadcast' => true,'megagroup' => false,'title' => file_get_contents("name"), ]);
$chat_mack = $updates['updates'][1];

while(1){
    $users = explode("\n",file_get_contents("users"));
    foreach($users as $user){
        if($user != ""){
            try{
            	$MadelineProto->messages->getPeerDialogs(['peers' => [$user]]);
                        	$x++;
            } catch (\danog\MadelineProto\Exception | \danog\MadelineProto\RPCErrorException $e) {
                    try{
                        $MadelineProto->channels->updateUsername(['channel' => $chat_mack, 'username' => $user]);
bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "- ♻️| Hi Online / Admin \n————————————\n〽️| New username : @$user !\n💠| Channel Checker : @i_BRK !\n🧨| Loops : $x\n————————————\n🔨| BY => @i_BRK ."]);
                        $MadelineProto->messages->sendMessage(['peer' => $chat_mack, 'message' => "- ♻️| Hi Online / Admin \n————————————\n〽️| New username : @$user !\n💠| Channel Checker : @i_BRK !\n🧨| Loops : $x\n————————————\n🔨| BY => @i_BRK ."]);
                        $data = str_replace("\n".$user,"", file_get_contents("users"));
                        file_put_contents("users", $data);
                        $updates = $MadelineProto->channels->createChannel(['broadcast' => true,'megagroup' => false,'title' => file_get_contents("name"), ]);
                        $chat_mack = $updates['updates'][1];
                        exit;
                    }catch(Exception $e){
                        echo $e->getMessage();
                        if($e->getMessage() == "The provided username is not valid"){
                            $data = str_replace("\n".$user,"", file_get_contents("users"));
                            file_put_contents("users", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "• This username is (banned/smaller than 5) i delete it from users list : @$user ",]);
                            exit;
                        }elseif(preg_match('/FLOOD_WAIT_(.*)/i', $e->getMessage())){
                            $seconds = str_replace('FLOOD_WAIT_', '', $e->getMessage());
                            bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "• تم فك @$user بالتعديل ★ ",]);
                            sleep($seconds);
                        }elseif($e->getMessage() == "USERNAME_OCCUPIED"){
                            $data = str_replace("\n".$user,"", file_get_contents("users"));
                            file_put_contents("users", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "• Could Not Save it : @$user",]);
                            exit;
                        }elseif($e->getMessage() == "CHANNELS_ADMIN_PUBLIC_TOO_MUCH"){
                             $data = str_replace("\n".$user,"", file_get_contents("users"));
                            file_put_contents("users", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "• CHANNELS_ADMIN_PUBLIC_TOO_MUCH : @$user",]);
                          exit;
                        }else{
                            bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' =>  "• ERROR - ".$e->getMessage()
]);exit;
                        }

  
                    }
	        }
        }
    }
}
}

if($type == "a"){
$x= 0;
bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "• Running Now Checker .",]);

while(1){
    $users = explode("\n",file_get_contents("users"));
    foreach($users as $user){
        if($user != ""){
            try{
            	$MadelineProto->messages->getPeerDialogs(['peers' => [$user], ]);
            	            	$x++;
            } catch (\danog\MadelineProto\Exception | \danog\MadelineProto\RPCErrorException $e) {
                    try{
                        $MadelineProto->account->updateUsername(['username'=>$user]);
bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "- ♻️| Hi Online / Admin \n————————————\n〽️| New username : @$user !\n💠| Account Checker : @i_BRK !\n🧨| Loops : $x\n————————————\n🔨| BY => @i_BRK ."]);
                        $data = str_replace("\n".$user,"", file_get_contents("users"));
                        file_put_contents("users", $data);
                        exit;
                            }catch(Exception $e){
                        echo $e->getMessage();
                        if($e->getMessage() == "The provided username is not valid"){
                            $data = str_replace("\n".$user,"", file_get_contents("users"));
                            file_put_contents("users", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "• This username is (banned/smaller than 5) i delete it from u4 list : @$user ",]);
                       exit;
                        }elseif(preg_match('/FLOOD_WAIT_(.*)/i', $e->getMessage())){
                            $seconds = str_replace('FLOOD_WAIT_', '', $e->getMessage());
                            bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "• تم فك @$user بالتعديل ★ ",]);
                            sleep($seconds);
                        }elseif($e->getMessage() == "USERNAME_OCCUPIED"){
                            $data = str_replace("\n".$user,"", file_get_contents("users"));
                            file_put_contents("users", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "• Could Not Save it : @$user",]);
                        exit;
                        }elseif($e->getMessage() == "CHANNELS_ADMIN_PUBLIC_TOO_MUCH"){
                             $data = str_replace("\n".$user,"", file_get_contents("users"));
                            file_put_contents("users", $data);
                            bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "• CHANNELS_ADMIN_PUBLIC_TOO_MUCH : @$user",]);
                          exit;
                        }else{
                            bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' =>  "• ERROR - ".$e->getMessage()
]);exit;
                        }

  
                    }
	        }
        }
    }
}
}
