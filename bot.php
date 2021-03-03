<?php
// BROK - @x_BRK - @i_BRK //
error_reporting(0);
if (!file_exists("ID")) {
  $brokid = readline("- Enter Your ID => ");
  file_put_contents("ID", $brokid);
}
if (!file_exists("users")) {
  file_put_contents("users", "");
}
if (!file_exists("name")) {
  file_put_contents("name", "- BROK .");
}
if (!file_exists("type.")) {
  file_put_contents("type", "a");
}
if (!file_exists("token")) {
  $g = readline("- Enter Your Token => ");
  file_put_contents("token", $g);
}
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
  echo json_encode($res, true);
}
function getupdates($up_id) {
  $get = bot('getupdates', ['offset' => $up_id]);
  return end($get['result']);
}
$botuser = "@" . bot('getme', ['bot']) ["result"]["username"];
function ph($ph, $cc) {
  bot('sendMessage', ['chat_id' => $cc, 'text' => "- Login ..."]);
  if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
  }
  define('MADELINE_BRANCH', 'deprecated');
  include 'madeline.php';
  unlink("BROK.madeline");
  unlink("BROK.madeline.lock");
  $settings['app_info']['api_id'] = 579315;
  $settings['app_info']['api_hash'] = '4ace69ed2f78cec268dc7483fd3d3424';
  $MadelineProto = new \danog\MadelineProto\API('BROK.madeline', $settings);
  try {
    $vv = $MadelineProto->phone_login($ph);
    echo json_encode($vv);
    bot('sendMessage', ['chat_id' => $cc, 'text' => "- Send Me The Code Now Like This /co 12345\n- Ex => /co 33827"]);
  }
  catch(Exception $e) {
    bot('sendMessage', ['chat_id' => $cc, 'text' => "- Some Error Happend ."]);
    return false;
  }
  while (1) {
    echo "hi";
    $last_up = $last_up;
    $get_up = getupdates($last_up + 1);
    $last_up = $get_up['update_id'];
    $message = $get_up['message'];
    $userID = $message['from']['id'];
    $chat_id = $message['chat']['id'];
    $text = $message['text'];
    if ($text) {
      if (preg_match("/\/co (.*)/", $text)) {
        $code = explode(" ", $text) [1];
        try {
          if ($code != "") {
            $value = $MadelineProto->complete_phone_login(intval($code));
            echo json_encode($value);
            bot('sendMessage', ['chat_id' => $cc, 'text' => "- Done Login Send /start Now ."]);
            break;
          }
        }
        catch(Exception $e) {
          echo $e->getMessage();
          bot('sendMessage', ['chat_id' => $cc, 'text' => "- Error => " . $e->getMessage() ]);
        }
      }
    }
    sleep(1);
  }
}
function countUsers($u = "2", $t = "2") {
  $users = explode("\n", file_get_contents("users"));
  $list = "";
  $i = 1;
  foreach ($users as $user) {
    if ($user != "") {
      $list = $list . "\n- $i => @$user";
      $i++;
    }
  }
  if ($list == "") {
    return "- No Users in The List .";
  }
  else {
    return $list;
  }
  if ($t = "1") {
    $users = explode("\n", $u);
    $list = "";
    $i = 1;
    foreach ($users as $user) {
      if ($user != "") {
        $list = $list . "\n- $i => @$user";
        $i++;
      }
    }
    if ($list == "") {
      return "- No Users in The List .";
    }
    else {
      return $list;
    }
  }
}
function stats($nn){
	$st = "";
	$x = shell_exec("pm2 show $nn");
	if (preg_match("/online/", $x)) {
		$st = "run";
	}else{
		$st = "stop";
	}
	return $st;
}
function run($update) {
  $nn = bot('getme', ['bot']) ["result"]["username"];
  $message = $update['message'];
  $userID = $message['from']['id'];
  $chat_id = $message['chat']['id'];
  $text = $message['text'];
  $date = $update['callback_query']['data'];
  $group = file_get_contents("ID");
  if ($chat_id == $group) {
    $users = explode("\n", file_get_contents("users"));
    if (preg_match("/\/Pin @(.*)/", $text)) {
      $user = explode("@", $text) [1];
      if (!in_array($user, $users)) {
        file_put_contents("users",$user);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Done Pin ON => @$user ."]);
      }
      else {
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- The User Exits @$user ."]);
      }
    }
    if ($text == "- Move To Channel .") {
      file_put_contents("type","c");
      bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Done Set Move To Channel ."]);
    }
    if ($text == "- Move To Account .") {
        file_put_contents("type","a");
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Done Set Move To Account ."]);
      }
    if (preg_match("/\/add(.*)/", $text)) {
      $ex = str_replace(["/add\n", "/add \n"], "", $text);
      $ex = explode("\n", $ex);
      $userT = "";
      $userN = "";
      foreach ($ex as $u) {
        $users = explode("\n", file_get_contents("users"));
        $user = explode("@", $u) [1];
        if (!in_array($user, $users)) {
          $userT = $userT . "\n" . $user;
        }
        else {
          $userN = $userN . "\n" . $user;
        }
      }
      file_put_contents("users", $userT, FILE_APPEND);
      bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Done Add  => \n" . countUsers($userT, "1") ]);
    }
    if (preg_match("/\/UnPin @(.*)/", $text)) {
      $user = explode("@", $text) [1];
      if (in_array($user, $users)) {
        $data = str_replace("\n" . $user, "", file_get_contents("users"));
        file_put_contents("users", $data);
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Done UnPin => @$user ."]);
      }
    }
    if ($text == "- Remove All Users .") {
      file_put_contents("users", "");
      bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Done Remove All Users ."]);
    }
    if ($text == "- Show List of Users .") {
      bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Users in The List . \n " . countUsers() ]);
    }
     $t = file_get_contents("type");
     if($t == "c"){
         $broktype = "Channel";
     }
     elseif($t == "a"){
         $broktype = "Account";
     }
    if ($text == "- Checker info .") {
      $st = stats($nn);
      bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Checker info .\n- Status => $st .\n- Move To => $broktype .\n- BY => @i_BRK ."]);
    }
    if ($text == "/start") {
      bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Hello Bro .\n- Your Can Use This Commands .\n- BY => @i_BRK .",
      'inline_keyboard'=>true,
      'reply_markup'=>json_encode([
           'keyboard'=>[
             [['text'=>'- Pin User .'],['text'=>'- UnPin User .']],
             [['text'=>'- Checker info .']],
             [['text'=>'- Show List of Users .']],
             [['text'=>'- Move To Channel .'],['text'=>'- Move To Account .']],
             [['text'=>'- Add Users List .'],['text'=>'- Remove All Users .']],
             [['text'=>'- Run Checker .'],['text'=>'- Stop Checker .']],
             [['text'=>'- Login .']]
           ]	
             ]),'resize_keyboard'=>true
             ]);
    }
    if ($text == "- Login .") {
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Send Me The Number Now Like /ph +964***\n- Ex => /ph +9647803667816"]);
      }
      if ($text == "- Pin User .") {
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Send Me The User Now Like /Pin @user\n- Ex => /Pin @i_BRK"]);
      }
      if ($text == "- UnPin User .") {
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Send Me The User Now Like /UnPin @user\n- Ex => /UnPin @i_BRK"]);
      }
      if ($text == "- Add Users List .") {
        bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Send Me The List Now Like /add user\nuser\n- Ex => /Pin @i_BRK\n@x_BRK"]);
      }
    if (preg_match("/\/ph /", $text)) {
      exec("pm2 stop $nn");
      $ph = explode(" ", $text) [1];
      ph($ph, $chat_id);
    }
    if ($text == "- Run Checker .") {
      exec("pm2 stop $nn");
      exec("pm2 start checker.php --name $nn");
      bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Done Run The Checker ."]);
    }
    if ($text == "- Stop Checker .") {
      exec("pm2 stop $nn");
      bot('sendMessage', ['chat_id' => $chat_id, 'text' => "- Done Stop The Checker ."]);
    }
  }
}
while (true) {
  $last_up = $last_up;
  $get_up = getupdates($last_up + 1);
  $last_up = $get_up['update_id'];
  run($get_up);
  sleep(1);
}

