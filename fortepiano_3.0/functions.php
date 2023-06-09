<?php

include_once dirname( __FILE__ ) . '/line_bot.php';


// カスタムナビゲーション使用登録
register_nav_menus( array( 'member_menu' => __( 'メンバー専用メニュー' )) );
register_nav_menus( array( 'about_menu' => __( 'aboutメニュー' )) );
register_nav_menus( array( 'member_menu_ktai' => __( 'メンバー専用メニュー携帯用' )) );
register_nav_menus( array( 'sub_menu' => __( 'サブメニュー用' )) );
register_nav_menus( array( 'sub_menu_ktai' => __( 'サブメニュー携帯用' )) );
register_nav_menus( array( 'event_menu' => __( 'イベント用メニュー' )) );
register_nav_menus( array( 'eventarchve_menu' => __( 'イベントアーカイブ用メニュー' )) );

//アイキャッチ画像を使う
add_theme_support( 'post-thumbnails' );

?>
<?php
function dispSchedule( $post, $chkpart ){

	//全ユーザー情報の取得
	$users = get_users_of_blog();

	
	foreach ( $users as $users ){
		$part = get_cimyFieldValue($users->user_id, 'PART');

		//休団者は出さない
		$rest = get_cimyFieldValue($users->user_id, 'REST');
		if( strcmp($rest,'YES') == 0 )continue;

		//引数のパートのみ表示
		if( strcmp($chkpart,$part) == 0 ) {
			//パート出力
			echo '<tr><td>';
			echo $part;
			echo '</td>';

			//ニックネーム出力
			echo '<td>';
			echo get_the_author_meta('nickname', $users->user_id);
			echo 'さん</td>';

			//出欠状況の出力
			echo '<td>'; 
			$value = get_post_meta($post->ID, $users->user_login, true);
			if( empty($value) ){
				echo '-----';
			}
			else{
				echo  getStatusStr($value);
			}
			echo '</td>';

			//備考の出力
			echo '<td>'; 
			$value = get_post_meta($post->ID, $users->user_login.'1', true);
			if( empty($value) ){
				echo '';
			}
			else{
				echo  $value;
			}
			echo '</td>';
			
			echo '</tr>';

		}
	}
}

function dispSchedule_ktai( $post, $chkpart ){

	//全ユーザー情報の取得
	$users = get_users_of_blog();
	
	foreach ( $users as $users ){
		//休団者は出さない
		$rest = get_cimyFieldValue($users->user_id, 'REST');
		if( strcmp($rest,'YES') == 0 )continue;
		
		$part = get_cimyFieldValue($users->user_id, 'PART');

		//引数のパートのみ表示
		if( strcmp($chkpart,$part) == 0 ) {
			//パート出力
			echo '<tr>';

			//出欠状況の出力
			echo '<td>'; 
			$value = get_post_meta($post->ID, $users->user_login, true);
			if( empty($value) ){
				echo '----';
			}
			else{
				echo  getStatusStr($value);
			}
			echo '</td>';

			//ニックネーム出力
			echo '<td>';
			echo get_the_author_meta('nickname', $users->user_id);
			echo 'さん</td>';


			echo '</tr>';

		}
	}
}

function selectStatus( $post, $cu ){
	$value = get_post_meta($post->ID, $cu->user_login, true);
	
	if( strcmp($value,"出席") == 0 ){
		echo '<option value="出席" selected >出席</option>';
		echo '<option value="遅刻">遅刻</option>';
		echo '<option value="欠席">欠席</option>';
		echo '<option value="早退">早退</option>';
		echo '<option value="未定">未定</option>';
	}elseif( strcmp($value,"欠席") == 0 ){
		echo '<option value="出席">出席</option>';
		echo '<option value="遅刻">遅刻</option>';
		echo '<option value="欠席" selected >欠席</option>';
		echo '<option value="早退">早退</option>';
		echo '<option value="未定">未定</option>';
	}elseif( strcmp($value,"遅刻") == 0 ){
		echo '<option value="出席">出席</option>';
		echo '<option value="欠席">欠席</option>';
		echo '<option value="遅刻" selected >遅刻</option>';
		echo '<option value="早退">早退</option>';
		echo '<option value="未定">未定</option>';
	}elseif( strcmp($value,"早退") == 0 ){
		echo '<option value="出席">出席</option>';
		echo '<option value="欠席">欠席</option>';
		echo '<option value="遅刻">遅刻</option>';
		echo '<option value="早退" selected >早退</option>';
		echo '<option value="未定">未定</option>';
	}else{
		echo '<option value="出席">出席</option>';
		echo '<option value="欠席">欠席</option>';
		echo '<option value="遅刻">遅刻</option>';
		echo '<option value="早退">早退</option>';
		echo '<option value="未定" selected >未定</option>';
	}

}

function getStatus(  $post, $cu ){
	echo '<td>'; 
	$value = get_post_meta($post->ID, $cu->user_login, true);
	if( empty($value) ){
		echo '未選択';
	}
	else{
		echo  $value;
	}
	echo '</td></tr>';
}

function getStatusStr( $value )
{
	if( strcmp($value,"出席") == 0 ){
		return '●';
	}elseif( strcmp($value,"欠席") == 0 ){
		return '×';
	}elseif( strcmp($value,"遅刻") == 0 ){
		return '遅';
	}elseif( strcmp($value,"早退") == 0 ){
		return '早';
	}elseif( strcmp($value,"未定") == 0 ){
		return '？';
	}
	
	return '－';
}

/* 出席者表示
-----------------------------------------------------------*/
function dispAttendUser(){

	$attend = 0;
	$absence = 0;
	$late = 0;
	$early = 0;
	$undecided = 0;
	
	//全ユーザー情報の取得
	$users = get_users_of_blog();
	
	foreach ( $users as $users ){

		//出欠状況の出力
		$value = get_post_meta(get_the_ID(), $users->user_login, true);
		if( strcmp($value,"出席") == 0 ){
			$attend++;	//出席
		}elseif( strcmp($value,"欠席") == 0 ){
			$absence++;	//欠席
		}elseif( strcmp($value,"遅刻") == 0 ){
			$late++;	//遅刻
		}elseif( strcmp($value,"早退") == 0 ){
			$early++;	//早退
		}elseif( strcmp($value,"未定") == 0 ){
			$undecided++;	//未定
		}
	}

	echo "●:".$attend."  ×:".$absence."  △:".$late."  □:".$early."  ？:".$undecided;	
}


function printUpdate(){
    dynamic_sidebar( 'Footer Widget' );
	
}

function printTwitter(){
	echo '<h2><a href="https://twitter.com/#!/efp_brass">Twitter@efp_brass</a></h2>';
	echo '<ul id="twitter_update_list"></ul>';
	echo '<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>';
	echo '<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/efp_brass.json?callback=twitterCallback2&count=2"></script>';
}

/* みんなのスケジュールのヘッダー */
function dispAllSchedule_title(){
	echo '<thead><tr>';
	echo '<th>パート</th>';
	echo '<th>名前</th>';
	echo '<th>資格</th>';
	
	$lessonstr = array();
	
	while ( have_posts() ){
		the_post();
	
		/* lesson_dateをキーとして、練習日を取得 */
	    $lesson_date = get_post_custom_values('lesson_date');
		if( $lesson_date  ){
			/* 日付が未来かどうかをチェック */
			$lesson_date_unix = strtotime( $lesson_date[0] );
			$today_unix = strtotime(  date('Y-m-d') );
			/* 過去のものは表示しない */
			if( $lesson_date_unix < $today_unix )continue;
		}
		
		/* 練習日にリンクをはる */
//		$lessonstr[] = '<th><a href='.get_permalink ().'>'.date("m/d",strtotime($lesson_date[0])).'</th>';
        echo '<th><a href='.get_permalink ().'>'.date("m/d",strtotime($lesson_date[0])).'</th>';

	}
	/*
	//逆順に出すために配列を入れ替え
	$echostr = array_reverse( $lessonstr );
	foreach( $echostr as $echostr ){
		echo $echostr;
	}
	*/
    
	echo '</tr></thead>';

}

function dispAllSchedule( $chkpart ){

	//全ユーザー情報の取得
	$users = get_users_of_blog();
	
	foreach ( $users as $users ){
		//休団者は出さない
		$rest = get_cimyFieldValue($users->user_id, 'REST');
		if( strcmp($rest,'YES') != 0 ){

			$part = get_cimyFieldValue($users->user_id, 'PART');

			if( strcmp($chkpart,$part) == 0 ) {

				/* 出欠出力 */
				//パート
				echo '<tr><td>';
				echo $chkpart;
				echo '</td>';
				

				//ニックネーム出力
				echo '<td>';
				the_author_meta('nickname', $users->user_id);
				echo 'さん</td>';

				//資格
				$status = get_cimyFieldValue($users->user_id, 'STATUS');
				echo '<td>';
				if( strcmp($status,"正団員") == 0 ){
					echo '正';
				}elseif( strcmp($status,"準団員") == 0 ){
					echo '準';
				}elseif( strcmp($status,"正団員（学生）") == 0 ){
					echo '正学';
				}elseif( strcmp($status,"準団員（学生）") == 0 ){
					echo '準学';
				}elseif( strcmp($status,"OB") == 0 ){
					echo 'OB';
				}elseif( strcmp($status,"賛助") == 0 ){
					echo '賛';
				}else{
					echo '';
				}
				echo '</td>';

				$lessonstr = array();
			
				while ( have_posts() ){
					the_post();
				
					/* lesson_dateをキーとして、練習日を取得 */
				    $lesson_date = get_post_custom_values('lesson_date');
					if( $lesson_date  ){
						/* 日付が未来かどうかをチェック */
						$lesson_date_unix = strtotime( $lesson_date[0] );
						$today_unix = strtotime(  date('Y-m-d') );
						/* 過去のものは表示しない */
						if( $lesson_date_unix < $today_unix )continue;
					}

					//出欠状況の出力
					$value = get_post_meta(get_the_ID(), $users->user_login, true);
                    echo '<td>'.getStatusStr($value).'</td>';
					
				}

				echo '</tr>';
			}
		}
	}
	
	
}

add_filter( 'show_admin_bar', '__return_false' );

function my_auto_title($post_ID, $post){

 	global $wpdb;

 	/* ポストタイプがカスタムかどうかチェック */
	if( $post->post_type == 'lessons'  ){

		/* カスタムフィールドの取得 */
		$lesson_date = get_post_custom_values('lesson_date', $post_ID);
		if( $lesson_date ){
			$title_message = date('m/d',strtotime($lesson_date[0]));
			$date = date('m/d',strtotime($lesson_date[0]));
		}
		else{
			$title_message = "NULL";
		}

		if( strcmp( $title_message , "NULL" ) != 0 ){
			/* lesson_timeをキーとして、練習時間を取得 */
		    $lesson_time = get_post_custom_values('lesson_time', $post_ID);
		    if( $lesson_time  ){
		    	$title_message = $title_message . '(';
				$title_message = $title_message . $lesson_time[0];
		    	$title_message = $title_message . ')';
		    }
			/* lesson_placeをキーとして、練習場所を取得 */
		    $lesson_place = get_post_custom_values('lesson_place', $post_ID);
		    if( $lesson_place  ){
				$title_message = $title_message . ' at ';
				$title_message = $title_message . $lesson_place[0];
		    }

			$where = array( 'ID' => $post_ID );
			$wpdb->update( $wpdb->posts, array( 'post_title' => $title_message ), $where );
			if ( $wp_error )
				return new WP_Error('db_update_error', __('Could not update post in the database'), $wpdb->last_error);


			/* メール用に備考を取得 */
		    $remarks = get_post_custom_values('remarks', $post_ID);
		    if( $remarks  ){
				$remark = $remarks[0];
		    }
		    
		    /* メール送付 */
		    SendSyuketuMail( $post,  $title_message, $date, $lesson_time, $lesson_place, $remark );
			
		}

		return 0;
			
	}

}
/* メール希望メンバーのメールアドレスを取得 */
function SendSyuketuMail($post, $title_message, $date, $lesson_time, $lesson_place, $remark){

	//全ユーザー情報の取得
	$users = get_users_of_blog();
	
	foreach ( $users as $users ){
		$mail = get_cimyFieldValue($users->user_id, 'MAIL');
		if( strcmp($mail,'YES') == 0 ){
		
			/* アドレスを'で囲む */
			$To = $users->user_email;
		
			/* メール送信 */
			$Subject = $title_message;
			$Message = "アンサンブル・フォルテピアノの練習・イベント日程を";
			$Message .= "お知らせメールです。\n";
			$Message .= "\n";
			$Message .= "練習日：".$date."\n";
			$Message .= "練習時間：".$lesson_time[0]."\n";
			$Message .= "練習場所：".$lesson_place[0]."\n";
			$Message .= "備考：".$remark."\n\n";
			$Message .= "以下のいずれかのURLをクリックして出欠を更新できます。\n";
			$Message .= "尚、HPにログインした状態でクリックしてください\n\n";
			$Message .= "■出席の方\n";
			$Message .= get_permalink( $post ).'?setsyuketu=syusseki';
			$Message .= "\n\n";
			$Message .= "■欠席の方\n";
			$Message .= get_permalink( $post ).'?setsyuketu=kesseki';
			$Message .= "\n\n";
			$Message .= "■遅刻の方\n";
			$Message .= get_permalink( $post ).'?setsyuketu=chikoku';
			$Message .= "\n\n";
			$Message .= "■早退の方\n";
			$Message .= get_permalink( $post ).'?setsyuketu=soutai';
			$Message .= "\n\n";
			$Message .= "本メールアドレスは送信専用です。返信はしないでください。";
			
			$headers[] = 'From: アンサンブル・フォルテピアノ <wordpress@s377.fortepiano.xrea.com>';

			wp_mail($To, $Subject, $Message, $headers);

		}
	}

}


add_action('wp_insert_post', 'my_auto_title', 10, 2);

/* モバイルかどうかをチェックする */
function chk_mobile(){
	$mobile = false;
	if (strpos($_SERVER['HTTP_USER_AGENT'],"iPhone") || strpos($_SERVER['HTTP_USER_AGENT'],"Android") ){
		$mobile = true;
	}
	return $mobile;
}

/* パンくずリスト作成 */
function breadcrumb($divOption = array("id" => "breadcrumb", "class" => "clearfix")){
    global $post;
    $str ='';
    if(!is_home()&&!is_admin()){
        /* !is_admin は管理ページ以外という条件分岐 */
        $tagAttribute = '';
        foreach($divOption as $attrName => $attrValue){
            $tagAttribute .= sprintf(' %s="%s"', $attrName, $attrValue);
        }
        $str.= '<div'. $tagAttribute .'>';
        $str.= '<ul class="breadcrumb">';
        $str.= '<li><a href="'. home_url() .'/">HOME</a></li>';

        if(is_category()) {
            //カテゴリーのアーカイブページ 
            $cat = get_queried_object();
            if($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                foreach($ancestors as $ancestor){
                    $str.='<li><a href="'. get_category_link($ancestor) .'">'. get_cat_name($ancestor) .'</a></li>';
                }
            }
            $str.='<li>'. $cat -> name . '</li>';
        } elseif(is_single()){
            //ブログの個別記事ページ
            
            $categories = get_the_category($post->ID);
            $cat = $categories[0];
            if($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                foreach($ancestors as $ancestor){
                    $str.='<li><a href="'. get_category_link($ancestor).'">'. get_cat_name($ancestor). '</a></li>';
                }
            }
            $str.='<li><a href="'. get_category_link($cat -> term_id). '">'. $cat-> cat_name . '</a></li>';
            //BLOG
            /*
            $str.='<li><a href="'. home_url() .'/BLOG/">BLOG</a></li>';
             * 
             */
            $str.= '<li>'. $post -> post_title .'</li>';
        } elseif(is_page()){
            //固定ページ
            if($post -> post_parent != 0 ){
                $ancestors = array_reverse(get_post_ancestors( $post->ID ));
                foreach($ancestors as $ancestor){
                    $str.='<li><a href="'. get_permalink($ancestor).'">'. get_the_title($ancestor) .'</a></li>';
                }
            }
            $str.= '<li>'. $post -> post_title .'</li>';
        } elseif(is_date()){
            //日付ベースのアーカイブページ
            if(get_query_var('day') != 0){
                //年別アーカイブ
                $str.='<li><a href="'. get_year_link(get_query_var('year')). '">' . get_query_var('year'). '年</a></li>';
                $str.='<li><a href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '">'. get_query_var('monthnum') .'月</a></li>';
                $str.='<li>'. get_query_var('day'). '日</li>';
            } elseif(get_query_var('monthnum') != 0){
                //月別アーカイブ
                $str.='<li><a href="'. get_year_link(get_query_var('year')) .'">'. get_query_var('year') .'年</a></li>';
                $str.='<li>'. get_query_var('monthnum'). '月</li>';
            } else {
                //年別アーカイブ
                $str.='<li>'. get_query_var('year') .'年</li>';
            }
        } elseif(is_search()) {
            //検索結果表示ページ
            $str.='<li>[ '. get_search_query() .' ] で検索した結果</li>';
        } elseif(is_author()){
            //投稿者のアーカイブページ
            $str .='<li>投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</li>';
        } elseif(is_tag()){
            //タグのアーカイブページ
            $str.='<li>タグ : '. single_tag_title( '' , false ). '</li>';
        } elseif(is_attachment()){
            //添付ファイルページ
            $str.= '<li>'. $post -> post_title .'</li>';
        } elseif(is_404()){
            //404 Not Found ページ
            $str.='<li>404 Not found</li>';
        } else{
            //その他
            $str.='<li>'. wp_title('', true) .'</li>';
        }
        $str.='</ul>';
        $str.='</div>';
    }
    wp_reset_query();
    
    echo $str;
}

add_shortcode('set-parallax', 'disp_parallax');
function disp_parallax($atts,$content='') {

    
	extract(shortcode_atts(array(
        'id'=>'efp_profile',
        'title'=>'Message'
	), $atts));

    if( chk_mobile() == false ){
	    $str = '<div name ="'.$id.'" id="'.$id.'" class="row clearfix">';
	    $str .= '<div class="col-md-12 column">';
	    $str .= '<div id="efp_jumbtitle" class="jumbotron"　>';
	    $str .= '<h1  class="text-center">'.$title.'</h1></div></div></div>';
	}
	$str .= '<div class="row clearfix"><div class="col-md-12 column"><div id="efp_post" class="row">';
    $str .= $content;
    $str .= '</div></div></div>';
    
    echo $str;
    
}

function disp_pagination( $pages = '', $range = 2) {
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
     
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<ul class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>最初へ</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>前へ</a></li>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class='active'><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>次へ</a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>最後へ</a></li>";
         echo "</ul>\n";
     }
}

function disp_categories(){
    $args=array(
      'orderby' => 'name'
    );
    $categories=get_categories($args);
    foreach($categories as $category) { 
        echo '<div class="list-group-item"><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> ';
        echo '<span class="badge">'.$category->count.'</span></a></div>';
    } 
 
}

function is_extra(){

    $cu = wp_get_current_user();

	//資格
	$status = get_cimyFieldValue($cu->id, 'STATUS');
	
	if( strcmp($status,'賛助') == 0 ) return true;

	return false;
}

//概要（抜粋）の文字数調整
function my_excerpt_length($length) {
	return 200;
}
add_filter('excerpt_length', 'my_excerpt_length');

//概要（抜粋）の省略文字
function my_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'my_excerpt_more');

function create_eyechatch( ){
    $pager_str =  '<div data-ab-css-background="1" class="efpthumb" ';
    if(has_post_thumbnail($post->ID)){
        $image_id = get_post_thumbnail_id($post->ID);
        $image_url = wp_get_attachment_image_src($image_id,'large');

        $pager_str = $pager_str. 'style="background-image:url('.$image_url[0].')" data-adaptive-background data-ab-css-background >';
    }
    else{
        $pager_str = $pager_str. 'style="background-image:url('.get_bloginfo('template_directory').'/images/default.png)" data-adaptive-background data-ab-css-background >';
    }
    $pager_str = $pager_str. '</div>';
    
    return $pager_str;
}
function create_pager($idname, $post, $message ){
    $pager_str = "";
    if( !empty($post)){
        $pager_str =  '<div id="'.$idname.'" class="col-md-6 text-center" ';
        if(has_post_thumbnail($post->ID)){
            $image_id = get_post_thumbnail_id($post->ID);
            $image_url = wp_get_attachment_image_src($image_id,'large');

            $pager_str = $pager_str. 'style="background-image:url('.$image_url[0].')" >';
        }
        else{
            $pager_str = $pager_str. 'style="background-image:url('.get_bloginfo('template_directory').'/images/default.png)" >';
        }
        $pager_str = $pager_str. '<p>'. $message. ' </p>';
        $pager_str = $pager_str. '<a href="'.get_permalink( $post->ID ).'" >'. $post->post_title. '</a>';
        $pager_str = $pager_str. '</div>';
    }
    
    return $pager_str;
}

function get_eyechatch_url($sizename){
    $image_url="";
    
    if (have_posts()){
        the_post();
    }
    
    if( has_post_thumbnail( get_the_ID() )){
        $image_id = get_post_thumbnail_id(get_the_ID());
        $image_obj = wp_get_attachment_image_src($image_id,$sizename);
        $image_url = $image_obj[0];
    }
    else{
        $image_url = get_bloginfo('template_directory').'/images/default.png';
    }
    
    rewind_posts();
    
    return $image_url;
}

?>
