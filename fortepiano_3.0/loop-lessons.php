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

<?php
/* 記事のループを開始し、次の投稿がある場合は記事を表示します。*/
?>
    <div id="fh5co-content">
		<div class="container">


<h3>練習日程</h3>
<form action="" method="POST">
<table class="table table-striped">
    <!-- タイトル行の表示 -->
    <thead>
    <?php if(  is_user_logged_in() ) : ?>
        <tr><th>練習日</th><th>時間</th><th>場所</th><th>備考</th><th>出欠</th><th>コメント</th></tr>
    <?php else :?>
        <tr><th>練習日</th><th>時間</th><th>場所</th><th>備考</th></tr>
    <?php endif; ?>
    </thead>

    <?php
        /* 練習分ループ */
        while ( have_posts() ) : the_post(); ?>
        <div>

            <?php
                $cu = wp_get_current_user();

                //送信ボタンが押されたかつ、その時のIDと同一ならば登録
                if ($_POST['syuketu'.get_the_ID()] != '' && strcmp( $_POST['id'.get_the_ID()], get_the_ID()) == 0 ) {
                    delete_post_meta( get_the_ID(),  $cu->user_login ); 
                    update_post_meta(get_the_ID(),  $cu->user_login, $_POST['syuketu'.get_the_ID()]);
                }
            ?>

            <!-- タイトルの表示 -->
            <?php 

                /* lesson_dateをキーとして、練習日を取得 */
                $lesson_date = get_post_custom_values('lesson_date');
                if( $lesson_date  ){
                    /* 日付が未来かどうかをチェック */
                    $lesson_date_unix = strtotime( $lesson_date[0] );
                    $today_unix = strtotime(  date('Y-m-d') );
                    /* 過去のものは表示しない */
//                    if( $lesson_date_unix < $today_unix )continue;

                    echo '<tr';
                    if( is_user_logged_in() ){
                        echo ' title="';
                        dispAttendUser();
                        echo '"';
                    }
                    echo '><td>';
                    echo '<a href=';
                    echo the_permalink();
                    echo '>';
                    echo  date("Y/m/d",strtotime($lesson_date[0]));
                    echo '(';
                    echo strftime( '%a', strtotime( $lesson_date[0] ) );
                    echo ')</a>';
                    echo '</td>';
                }
                /* lesson_timeをキーとして、練習時間を取得 */
                $lesson_time = get_post_custom_values('lesson_time');
                if( $lesson_time  ){
                    echo '<td>';
                    echo( $lesson_time[0] );
                    echo '</td>';
                }
                /* lesson_placeをキーとして、練習場所を取得 */
                $lesson_place = get_post_custom_values('lesson_place');
                if( $lesson_place  ){
                    echo '<td>';
                    echo( $lesson_place[0] );
                    echo '</td>';
                }
                $remarks = get_post_custom_values('remarks');
                if( $remarks  ){
                    echo '<td>';
                    echo( $remarks[0] );
                    echo '</td>';
                }else{
                    echo '<td></td>';
                }
            ?>
            <?php if(  is_user_logged_in() ) : ?>
                <!--出欠状況 -->
                <td>
                    <select  name="syuketu<?php echo get_the_ID() ?>" size="1">
                    <?php echo selectStatus( $post, $cu ); ?>
                    </select>
                    <input type="hidden" readonly="readonly" name="id<?php echo get_the_ID() ?>" value="<?php echo get_the_ID() ?>" />
                </td>
                <!--練習に対するコメント数-->
                <?php
                    $cnum = get_comments_number( get_the_ID() );
                    if( $cnum != 0  ){
                        echo '<td>';
                        echo '(';
                        echo( $cnum );
                        echo ')';
                        echo '</td>';
                    }
                    else{
                        echo '<td>(0)</td>';
                    }
                ?>
            <?php endif; ?>

        </div>
    <?php endwhile; // ループ終了 ?>


</table>

<?php if(  is_user_logged_in() ) : ?>
    <!-- 出欠ボタン -->
    <input class="btn btn-primary" type="submit" name="出欠を登録" value="出欠を登録" />
<?php endif; ?>

</form>

<?php if(  is_user_logged_in()  ) : ?>
	<BR><h3>みんなの出欠一覧</h3>
	<table class="table table-striped">
		<?php 
			dispAllSchedule_title();
			dispAllSchedule('Cond');
			dispAllSchedule('Fl');
			dispAllSchedule('Cl');
			dispAllSchedule('Ob');
			dispAllSchedule('Fg');
			dispAllSchedule('Sax');
			dispAllSchedule('Tp' ); 
			dispAllSchedule('Tb' ); 
			dispAllSchedule('Hr' ); 
			dispAllSchedule('Euph' );
			dispAllSchedule('Tuba' );
			dispAllSchedule('Perc' );
			dispAllSchedule('Others' );
			
		 ?>
	</table>	
<?php endif; ?>

<!-- 前の記事と後の記事へのリンクを表示 -->
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-below" class="navigation">
		<div class="previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> 次の練習', 'fortepiano' ) ); ?></div>
		<div class="next"><?php previous_posts_link( __( '前の練習 <span class="meta-nav">&rarr;</span>', 'fortepiano' ) ); ?></div>
	</div><!-- #nav-below -->
<?php endif; ?>

<?php if(  is_user_logged_in() ) : ?>
<BR><h3>練習への最新コメント</h3>
	<?php
		$comments = get_comments( array( 'number' => 10, 'order' => 'desc') );
		foreach( $comments as $comment ):
			$GLOBALS['commnet'] = $comment;
			$post = get_post($comment->comment_post_ID);
			//ポストタイプが練習の場合のみ表示
			if( $post->post_type != 'lessons' )continue;
	?>
		<li>[<?php comment_date('Y/m/d H:i'); ?>]:<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>へのコメント( by <?php comment_author_link();?> )</li>
		<p><?php echo $comment->comment_content; ?></p>
	<?php endforeach; ?>
	<br>
<?php endif; ?>

        </div>    
		<?php get_template_part( 'detail-info' ); ?>
    </div>


</div>


