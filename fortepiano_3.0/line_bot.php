<?php

include_once dirname( __FILE__ ) . '/line_database.php';

//長時間用アクセストークン
$accessToken = 'UMM/djQoto5Tm2X1ouPRUcYejub729LbSDyH7amHzUp0ixKCK0ryW+c1E5QEJRyD6PqhO78jnCV/f8qS64/ORGl3wZWQVoKuTY3UwsE7JmJYr8mrMZN8WaPHOiS+3FJT6ypY8IdUJCYI/h6C66iPJQdB04t89/1O/w1cDnyilFU=';
// 秘密キー
$channelSecret = "7107932a4a1398bdc5f800b3fd545bea"; 



//ユーザーへのメッセージ送信
function send_line_message($post_data, $url){
    global $accessToken;
    
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charser=UTF-8',
        'Authorization: Bearer ' . $accessToken
    ));
    $result = curl_exec($ch);
    line_log("message result = ".$result."\n");
    curl_close($ch);
    
}


function line_unfollow_event($events){

    $userid = $events->source->userId;
    line_log("unfollow userid = ".$userid."\n" );
    $ret = line_user_update( $userid, "unfollow" );
    return $ret;
    
}

function line_message_event($events){

    $userid = $events->source->userId;
    $message = "シークレットコードが違います！！";
    $chktext = "";
    
    if( $events->message->type === "text" ){
        $chktext = $events->message->text;
    }
    
    if( $chktext === "7777" ){
        //ユーザー情報更新
        line_log( "userid = " . $userid . "\n" );
        $ret = line_user_update( $userid, "follow" );
        if( $ret ){
            $message = "ユーザー登録が完了しました！！";
        }
        else{
            $message = "登録に失敗しました。";
        }
   }
    
    line_log( "send message = " . $message . "\n" );
    line_log( "replyToken = ".$events->replyToken."\n");
    
    //応答メッセージ送信
    $jsonstr = '{
        "replyToken": "' . $events->replyToken . '",
        "messages":[
    		{
    		  "type": "text",
    		  "text": "' . $message . '"
    		}
        ]
    }';
    
    line_log( "replymessage = ".$jsonstr."\n");
    
    send_line_message( json_decode($jsonstr), "https://api.line.me/v2/bot/message/reply" );
}


function line_message_scheduler_do(){
    global $fp;
    
    $fp = fopen("line.log", "a+"); // 新規書き込みモードで開く

    $today = date("Y/m/d");

//    line_log("start line bot = ".$today."\n");
    
    //練習日かどうかのチェック
    $pid = get_line_post_id($today);
    
//    line_log("pid = " . $pid ."\n");
    
    //練習日ならメッセージ送信    
    if( $pid != 0 ){
        $message = get_line_schedule_message($today);
        $title = get_line_schedule_title($today);
               
        $tostr = implode(",",get_line_userids());
        line_log("tostr = " . $tostr ."\n");
        $jsonstr ='
        {
          "to": ['. $tostr. '],
          "messages":[{
              "type": "template",
              "altText": "' .$message. '",
              "template": {
                  "type": "buttons",
                  "title": "'.$today. ' '.$title.'",
                  "text": "' .$message. '" ,
                  "actions": [
                     {
                        "type": "uri",
                        "label": "出席",
                        "uri": "http://fortepiano.s377.xrea.com/wordpress/?post_type=lessons&p='.$pid.'&setsyuketu=syusseki"
                      },
                      {
                        "type": "uri",
                        "label": "欠席",
                        "uri": "http://fortepiano.s377.xrea.com/wordpress/?post_type=lessons&p='.$pid.'&setsyuketu=kesseki"
                      },
                      {
                        "type": "uri",
                        "label": "遅刻",
                        "uri": "http://fortepiano.s377.xrea.com/wordpress/?post_type=lessons&p='.$pid.'&setsyuketu=chikoku"
                      },
                      {
                        "type": "uri",
                        "label": "早退",
                        "uri": "http://fortepiano.s377.xrea.com/wordpress/?post_type=lessons&p='.$pid.'&setsyuketu=soutai"
                      }
                  ]
              }
           }]
        }';
        
        line_log( "message = " . $jsonstr ."\n" );
             
        //複数ユーザーへのメッセージ
        send_line_message( json_decode($jsonstr), "https://api.line.me/v2/bot/message/multicast" );  
        
      
    }
    else{
        line_log("today is not lesson day\n" );
    }
    
    fclose( $fp );      

}

?>
