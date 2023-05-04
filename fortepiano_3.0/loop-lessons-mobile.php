<div id="fh5co-main">
    <div class="fh5co-intro text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1 class="intro-lead">スケジュール</h1>
                    <p class="">練習やイベントのスケジュールです。</p>
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-content">
		<div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form action="" method="POST">

<?php
?>
<dl>
	<hr>
	<!-- 練習ループ -->
	<?php while ( have_posts() ){
	 	the_post();

        $cu = wp_get_current_user();

        //送信ボタンが押されたかつ、その時のIDと同一ならば登録
        if ($_POST['syuketu'.get_the_ID()] != '' && strcmp( $_POST['id'.get_the_ID()], get_the_ID()) == 0 ) {
            delete_post_meta( get_the_ID(),  $cu->user_login ); 
            update_post_meta(get_the_ID(),  $cu->user_login, $_POST['syuketu'.get_the_ID()]);
        }
        
		$post = get_post($post_id);
		/* lesson_dateをキーとして、練習日を取得 */
	    $lesson_date = get_post_custom_values('lesson_date',$post->ID);
	    if( $lesson_date  ){
            /* 日付が未来かどうかをチェック */
            $lesson_date_unix = strtotime( $lesson_date[0] );
            $today_unix = strtotime(  date('Y-m-d') );
            /* 過去のものは表示しない */
//            if( $lesson_date_unix < $today_unix )continue;

	    	/* 練習日にリンクをはる */
			echo '<a href="';
// 携帯は一時ストップ			
//			if( is_ktai() == 'SoftBank'){
//				echo get_permalink();
//			}
//			elseif( is_ktai() == 'DoCoMo' && !ks_cookie_available() ){
//				echo get_permalink().'?ksid='.KtaiStyle_Admin::get_sid();
//			}
//			else{
//				echo the_permalink();
//			}

			echo get_permalink();
			echo '">';
			echo  date("y/m/d",strtotime($lesson_date[0]));
			echo '(';
			echo strftime( '%a', strtotime( $lesson_date[0] ) );
			echo ')</a>';
	    	echo( '<br>');
	    }

		/* lesson_timeをキーとして、練習時間を取得 */
	    $lesson_time = get_post_custom_values('lesson_time',$post->ID);
	    if( $lesson_time  ){
            echo( $lesson_time[0] );
	    	echo( '<br>');
	    }
	    
		/* lesson_placeをキーとして、練習場所を取得 */
	    $lesson_place = get_post_custom_values('lesson_place',$post->ID);
	    if( $lesson_place  ){
            echo( $lesson_place[0] );
	    	echo( '<br>');
	    }
	    /* remarksをキーとして、備考を取得 */
	    $remarks = get_post_custom_values('remarks',$post->ID);
	    if( $remarks  ){
            echo( $remarks[0] );
	    	echo( '<br>');
		}
        if(  is_user_logged_in() ){ 
                echo ( '<td>' );
                echo ( '<select name="syuketu'.get_the_ID().'" size="1">' );
                echo selectStatus( $post, $cu ); 
                echo ( '</select>' );
                echo ( '<input type="hidden" readonly="readonly" name="id'.get_the_ID().'" value="'.get_the_ID().'" />');
                echo ( '</td>' );
        }
        
        //出欠状況
        echo "<span style='float:right'>";
        dispAttendUser();
	    echo('</span><hr>');
        

	} ?>

<?php if(  is_user_logged_in() ) : ?>
    <!-- 出欠ボタン -->
    <input class="btn btn-primary" type="submit" name="出欠を登録" value="出欠を登録" />
<?php endif; ?>
</form>

<!-- 前の記事と後の記事へのリンクを表示 -->
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-below" class="navigation">
		<div class="previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> 次の練習', 'fortepiano' ) ); ?></div>
		<div class="next"><?php previous_posts_link( __( '前の練習 <span class="meta-nav">&rarr;</span>', 'fortepiano' ) ); ?></div>
	</div><!-- #nav-below -->
<?php endif; ?>

</dl>
                </div>    
            </div>
        </div>
    </div>
    <div>
		<?php get_template_part( 'detail-info' ); ?>
    </div>


</div>
    
