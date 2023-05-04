
<?php get_header(); /* ヘッダー表示 */ ?>

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

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


		<!-- タイトル表示(日付（時間）at 場所) -->
        <div class="caption"><h3 class="efp_post_title">
		<?php 
			/* lesson_dateをキーとして、練習日を取得 */
	    	$lesson_date = get_post_custom_values('lesson_date');
			echo  date("m/d",strtotime($lesson_date[0]));
			/* lesson_timeをキーとして、練習時間を取得 */
		    $lesson_time = get_post_custom_values('lesson_time');
		    if( $lesson_time  ){
	    		echo '（';
	            echo( $lesson_time[0] );
	            echo '）';
		    }
			/* lesson_placeをキーとして、練習場所を取得 */
		    $lesson_place = get_post_custom_values('lesson_place');
		    if( $lesson_place  ){
	    		echo ' at ';
	            echo( $lesson_place[0] );
		    }
		 ?>
        </h3></div>

		<!-- スケジュール状況の表示 -->
		<?php if(  is_user_logged_in() ) : ?>

			<?php
				$cu = wp_get_current_user();
				
				//送信ボタンが押されたかつ、その時のIDと同一ならば登録
				if ( $_POST['syuketu'] != '' && strcmp( $_POST['id'], get_the_ID()) == 0  ) {
					
					
					delete_post_meta( get_the_ID(),  $cu->user_login ); 
					update_post_meta(get_the_ID(),  $cu->user_login, $_POST['syuketu']);
					delete_post_meta( get_the_ID(),  $cu->user_login.'1' ); 
					update_post_meta(get_the_ID(),  $cu->user_login.'1', $_POST['reason']);

				}
				
				else if( isset($_GET['setsyuketu']) ){
					$chkstr = $_GET['setsyuketu'];
					switch($chkstr) {
					case "syusseki":
						$setstr="出席";
						break;
					case "kesseki": 
						$setstr="欠席";
						break;
					case "chikoku": 
						$setstr="遅刻";
						break;
					case "soutai": 
						$setstr="早退";
						break;
					default:
						$setstr='';
					}

					if( $setstr != '' ){
						delete_post_meta( get_the_ID(),  $cu->user_login ); 
						update_post_meta(get_the_ID(),  $cu->user_login, $setstr);
						echo '<span style="color:red">';
						echo $cu->display_name;
						echo 'さんの出欠が';
						echo  $setstr;
						echo 'に設定されました。</span>';
					}
					else{
						echo '無効な文字列が設定されました。';
					}
				}
			?>
			
			<h3>スケジュール状況</h3>
			<table class="table table-striped">
				<thead>
					<tr>
					<th>パート</th>
					<th>名前</th>
					<th>出欠</th>
					<th>備考</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					echo dispSchedule( $post, "Cond" );
					echo dispSchedule( $post, "Fl" ); 
					echo dispSchedule( $post, "Cl" ); 
					echo dispSchedule( $post, "Ob" ); 
					echo dispSchedule( $post, "Fg" ); 
					echo dispSchedule( $post, "Sax" ); 
					echo dispSchedule( $post, "Tp" ); 
					echo dispSchedule( $post, "Tb" ); 
					echo dispSchedule( $post, "Hr" ); 
					echo dispSchedule( $post, "Euph" );
					echo dispSchedule( $post, "Tuba" );
					echo dispSchedule( $post, "Perc" );
					echo dispSchedule( $post, "Others" );
				?>
				</tbody>
			</table>
			<br>
			<h3>スケジュール入力</h3>
			<?php echo( $cu->display_name ) ?>さん　出欠を登録してください 
			<form action="" method="POST">
				<select name="syuketu" size="1" tabindex="1">
				<?php echo selectStatus( $post, $cu ); ?>
				</select>
				<br>
				備考
				<br>
				<?php if(chk_mobile()) : ?>
					<textarea name="reason" id="reason" cols="25" rows="4" tabindex="2" ></textarea></p>
				<?php else: ?>
					<textarea name="reason" id="reason" cols="50" rows="2" tabindex="2" ></textarea></p>
				<?php endif; ?>
				<input type="hidden" readonly="readonly" name="id" value="<?php echo get_the_ID() ?>" />
				<input type="submit" class="btn btn-primary" name="出欠を登録" tabindex="3" value="出欠を登録"/>
			</form>
		<?php endif; ?>

		<?php 
			if(  is_user_logged_in() ){
				comments_template( '', true );
			}
		?>

        <br><a href="<?php echo home_url('/');echo '?post_type=lessons';?>">練習スケジュールに戻る</a><br>
        
	</div><!-- #post-## -->



<?php endwhile; // end of the loop. ?>

                </div>    
            </div>
        </div>
    </div>
    <div>
		<div id="fh5co-services">
			<div class="container">

				<div class="row">
					<h2 class="section-lead text-center">もっと知りたい</h2>
					<div class="col-md-6 col-sm-6">
						<div class="fh5co-feature">
							<div class="fh5co-feature-icon to-animate">
								<i class="icon-clock2"></i>
							</div>
							<div class="fh5co-feature-text">
								<h3>スケジュール</h3>
								<p>練習日、場所などはこちらから確認してください。</p>
								<p><a href="#">Read more</a></p>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 fh5co-feature-border">
						<div class="fh5co-feature">
							<div class="fh5co-feature-icon to-animate">
								<i class="icon-mail"></i>
							</div>
							<div class="fh5co-feature-text">
								<h3>コンタクト</h3>
								<p>演奏依頼などはコンタクトフォームからどうぞ。</p>
								<p><a href="#">Read more</a></p>
							</div>
						</div>
					</div>
					<?php if( is_user_logged_in() ) : ?>

						<h2 class="section-lead text-center">for Members</h2>
						<div class="col-md-6 col-sm-6">
							<div class="fh5co-feature">
								<div class="fh5co-feature-icon to-animate">
									<i class="icon-pencil"></i>
								</div>
								<div class="fh5co-feature-text">
									<h3>掲示板</h3>
									<p>団員専用掲示板はこちらからどうぞ。ログインなしでみることができます。</p>
									<p><a href="#">Read more</a></p>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="fh5co-feature">
								<div class="fh5co-feature-icon to-animate">
									<i class="icon-music-tone"></i>
								</div>
								<div class="fh5co-feature-text">
									<h3>イベント</h3>
									<p>団員専用各種イベントページはこちらからどうぞ。</p>
									<p><a href="#">Read more</a></p>
								</div>
							</div>
						</div>
					<?php endif; ?>

				</div>
			</div>
		</div>
    </div>


</div>

<?php get_footer(); /* フッター表示 */ ?>
