<?php
include_once dirname( __FILE__ ) . "/line_dao.php";

/** WordPress のためのデータベース名 */
define('DB_NAME', 'fortepiano');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'fortepiano');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'oQMmiPbZXsC9');

/** MySQL のホスト名 */
define('DB_HOST', '127.0.0.1');

define('OPTION_NAME', 'lesson_scheduler_line_userids');

//送信先ユーザーID列の取得
function get_line_userids(){

    $to = array();

    try{
       //コネクト
        $rdb = new line_dao(DB_USER, DB_PASSWORD,  DB_NAME, DB_HOST);
        $rdb->connect();
        
        //オプション取得
        $sql = "select * from wp_options where option_name='".OPTION_NAME."'";
        $stmt = $rdb->select($sql);
               
        //レコードの存在確認
        if( $stmt->rowCount() != 0 ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               $useridsstr = $row["option_value"];
            }
           $userids = json_decode($useridsstr);
            line_log("option_value = " .$useridsstr."\n" );
                        
            foreach($userids as $key => $value){
                line_log( "key= ".$key."\n");
                line_log( "value= ".$value."\n");
                if( $value == "follow"){
                    $to[] = '"'.$key.'"';
                }
            }
            
        }

    }
    catch(Exception $ex){
        echo $ex->getMessage();
        throw new Exception('DB OPEN error: ' . $ex->getMessage());
    }
    
    //カンマ文字列で返却
    return $to;
        
}

//follow,unfollow時のユーザー情報更新
function line_user_update( $userid,  $status ){

    try{
        //コネクト
        $rdb = new line_dao(DB_USER, DB_PASSWORD,  DB_NAME, DB_HOST);
        $rdb->connect();
        
        //オプション取得
        $sql = "select * from wp_options where option_name='".OPTION_NAME."' limit 1";
        $stmt = $rdb->select($sql);
        
        $p1 = "";
        $useridsstr = "";
        
       //レコードの存在確認
        if( $stmt->rowCount() == 0 ){
            line_log("データがありません\n");
            //ユーザーIDのステータスレコード追加
            $userids = array($userid=>$status);
            $sql = "insert into wp_options ( option_name,option_value,autoload) values ( :col1,:col2,'yes' )";
       }
        else{
            line_log("データを更新します\n");
            //ユーザーIDのステータスレコード更新
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               $useridsstr = $row["option_value"];
               break;
            }
            line_log("option_value = " .$useridsstr."\n" );
            $userids = json_decode($useridsstr);
//            line_log( "dump =".vdump($userids)."\n"); 
/*            
            foreach( $userids as $key=>$value){
                line_log("key = ".$key."\n");
                line_log("status = ".$value."\n");
            }
*/            
            if( !array_key_exists($userid, $userids) ){
                line_log($userid."を追加します\n" );
                $userids->$userid = $status;
                line_log($userid."を追加しました\n" );
            }
            else{
                line_log($userid."のステータスを".$status."に変更します\n" );
                $userids->$userid = $status;
                line_log($userid."のステータスを".$status."に変更しました\n" );
            }
            
//            $userids[$userid] = $status;
            $sql = "update wp_options set option_value = :col2 where  option_name= :col1";
       }
       $useridsstr = json_encode($userids);
       line_log("sql data = " . $useridsstr."\n");

       $stmt = $rdb->prepare($sql);
       line_log("prepare ok\n");
       //$values = array();
       $values[':col1'] = OPTION_NAME;
       $values[':col2'] = $useridsstr;
       $ret = $rdb->execute($stmt,$values);

       line_log("execute = ".$ret." \n");
       return $ret;
       
    }
    catch(Exception $ex){
        echo $ex->getMessage();
        throw new Exception('DB OPEN error: ' . $ex->getMessage());
    }

}

//当日の練習のpost_idを取得
function get_line_post_id($day){

   $pid = 0;
   
    $sql = "select post_id from wp_postmeta where meta_value='".$day."'";
    try{
       //コネクト
        $rdb = new line_dao(DB_USER, DB_PASSWORD,  DB_NAME, DB_HOST);
        $rdb->connect();
        
        //オプション取得
        $stmt = $rdb->select($sql);
        
        //レコードの存在確認
        if( $stmt->rowCount() == 0 ){
            //練習がなければ0を返却
        }
        else{
            //ユーザーIDのステータスレコード更新
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $pid = $row["post_id"];
            }
       }
    }
    catch(Exception $ex){
        echo $ex->getMessage();
        throw new Exception('DB OPEN error: ' . $ex->getMessage());
    }

    //カンマ文字列で返却
    return $pid;

}
//当日の練習状況メッセージを取得
function get_line_schedule_message($day){

    $message = "";

    $sql = "SELECT meta_value,count(*) as cnt FROM wp_postmeta where ";
    $sql = $sql . "post_id=(select post_id from wp_postmeta where meta_value='".$day."' limit 1)";
    $sql = $sql . " and meta_value in ('出席','欠席','遅刻','早退') group by meta_value order by meta_value";
       
    try{
       //コネクト
        $rdb = new line_dao(DB_USER, DB_PASSWORD,  DB_NAME, DB_HOST);
        $rdb->connect();
        
        //オプション取得
        $stmt = $rdb->select($sql);
        
        //レコードの存在確認
        if( $stmt->rowCount() == 0 ){
            //練習がなければ空を返却
            return $message;
        }
        else{
            $syusseki=0;
            $chikoku=0;
            $soutai=0;
            $kesseki=0;
            
            //ユーザーIDのステータスレコード更新
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $status = $row["meta_value"];
                if( $status == "出席" ){
                    $syusseki = $row["cnt"];
                }
                if( $status == "遅刻" ){
                    $chikoku = $row["cnt"];
                }
                if( $status == "早退" ){
                    $soutai = $row["cnt"];
                }
                if( $status == "欠席" ){
                    $kesseki = $row["cnt"];
                }
           }
           $message = "現在の状況（ 出席：". $syusseki." 遅刻：".$chikoku ." 早退：".$soutai ." 欠席：".$kesseki." ）";
       }
      
    }
    catch(Exception $ex){
        echo $ex->getMessage();
        throw new Exception('DB OPEN error: ' . $ex->getMessage());
    }
    
    //カンマ文字列で返却
    return $message;

}

//当日の練習状況メッセージを取得
function get_line_schedule_title($day){

    $title = "";

    $sql = "SELECT meta_value,meta_key FROM wp_postmeta where post_id=(select post_id from wp_postmeta where meta_value='".$day."')" ;
    $sql = $sql." and meta_key in ('lesson_place','lesson_time')";
    
    try{
       //コネクト
        $rdb = new line_dao(DB_USER, DB_PASSWORD,  DB_NAME, DB_HOST);
        $rdb->connect();
        
        //オプション取得
        $stmt = $rdb->select($sql);
              
        $place = "";
        $time = "";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            if( $row["meta_key"] == "lesson_place" ){
                $place = $row["meta_value"];
            }
            elseif( $row["meta_key"] == "lesson_time" ){
                $time = $row["meta_value"];
            }
        }
        $title = "-" . $place . " -". $time ;
      
    }
    catch(Exception $ex){
        echo $ex->getMessage();
        throw new Exception('DB OPEN error: ' . $ex->getMessage());
    }
    
    //カンマ文字列で返却
    return $title;

}


?>
