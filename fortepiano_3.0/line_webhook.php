<?php
//設定画面処理用ファイル読み込み
include_once dirname( __FILE__ ) . '/line_bot.php';

$fp = fopen("line.log", "a+"); // 新規書き込みモードで開く

try{ 
  
  $httpRequestBody = file_get_contents("php://input"); // リクエスト文字列取得

  //ハッシュ化＋base64エンコード
  $hash = hash_hmac("sha256", $httpRequestBody, $channelSecret, true);
  $signature = base64_encode($hash);

  //署名確認
  if($signature === $_SERVER["HTTP_X_LINE_SIGNATURE"]){
      //debug
      line_log( "events analysis\n" );
      
      //署名が一致したのでイベントタイプをチェック
      $jobj = json_decode($httpRequestBody);
      //debug
      line_log( "events analysis end\n" );

      $events = $jobj->events[0];
      //$dstr = vdump($events);
      //line_log( $dstr);
      
//      line_log( "type = ".$events->type."\n");
//      line_log( "userId = ".$events->source->userId."\n");
//      line_log( "text = ".$events->message->text."\n");

      
      if( $events->type === "message" ){
          line_log(  "message analysis end\n" );
          line_message_event($events);
          line_log(  "message send end\n" );
      }
      else if($events->type === "unfollow"){
          line_log(  "unfollow analysis end\n" );
          line_unfollow_event($events);
          line_log(  "unfollow send end\n" );
      }
      
  }

}
catch(Exception $e){
  line_log(  $e->getMessage() ); 
  fclose($fp);
}

fclose($fp);

?>
