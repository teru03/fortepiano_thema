<?php
/**
 Template Name: Profile
 *
 * アンサンブル・フォルテピアノテーマ プロフィールページテンプレート
 *
 * @package WordPress
 * @subpackage efp_brass
 * @since efp_brass 3.0
 *
 *  Template Name: profile
 */

?>
<?php get_header(); ?>

	<div id="fh5co-main" >
		<div class="fh5co-intro text-center" >
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<h1 class="intro-lead"><?php bloginfo('name'); ?></h1>
<!--						<p class=""><?php bloginfo('description'); ?> </p>-->   
                        <?php printEvent(); ?>
                        <?php echo do_shortcode('[ssba]'); ?>
                    
                    </div>
				</div>
			</div>
		</div>

		<div id="fh5co-portfolio">
			<div class="fh5co-portfolio-item ">
				<div class="fh5co-portfolio-figure animate-box" style="background-image: url(<?php bloginfo('template_directory'); ?>/images/work_1.jpg);"></div>
				<div class="fh5co-portfolio-description">
					<h2>プロフィール</h2>
					<p>アンサンブル・フォルテピアノは、千葉県立津田沼高等学校吹奏楽部のOB・OGを中心に結成された吹奏楽団です。
2018年に結成20年を迎え、今では団員の2世も参加するようになりました。
習志野市の新習志野公民館や秋津コミュニティを拠点として、月に4回のペースで練習しており、主に新習志野公民館主催の行事に参加したり習志野市の地域イベントで演奏したりと、地域に密着した活動を続けています。
20代から40代と幅広い世代の団員が所属しており、子供をつれてくる団員も多い、とても家庭的な雰囲気のバンドで、練習も和気あいあいとしていますが、イベントが近づくと真剣モードになり、音楽と真剣に向き合ってもいます。</p>
					<p><a href="<?php echo home_url( '/' );echo '/about2/#efp_profile'; ?>" class="btn btn-primary">詳細を見る</a></p>
				</div>
			</div>
			<div class="fh5co-portfolio-item fh5co-img-right">
				<div class="fh5co-portfolio-figure animate-box" style="background-image: url(<?php echo recentEyecatchURL();  ?>);"></div>
				<div class="fh5co-portfolio-description">
					<h2>ブログ</h2>
					<p>日々の練習やイベントの詳細、イベント音源や動画などもこちらから見ることができますのでどうぞ見てください。</p>
					<p><a href="<?php echo recentPostURL(); ?>" class="btn btn-primary">詳細を見る</a></p>
				</div>
			</div>
			<div class="fh5co-portfolio-item ">
                <div class="fh5co-portfolio-figure animate-box" >
                    <a  href="http://www.amazon.co.jp/gp/product/B009YYCUAQ/ref=as_li_qf_sp_asin_il?ie=UTF8&camp=247&creative=1211&creativeASIN=B009YYCUAQ&linkCode=as2&tag=teru03-22"><img border="0" style="width:100%" src="http://ws-fe.amazon-adsystem.com/widgets/q?_encoding=UTF8&ASIN=B009YYCUAQ&Format=_SL250_&ID=AsinImage&MarketPlace=JP&ServiceVersion=20070822&WS=1&tag=teru03-22" ></a><img src="http://ir-jp.amazon-adsystem.com/e/ir?t=teru03-22&l=as2&o=9&a=B009YYCUAQ" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important; width:100%" /a>
                </div>
				<div class="fh5co-portfolio-description">
					<h2>音楽監督</h2>
					<p>姫野徹</p>
                    <p>1963年生まれ。千葉県出身。14歳よりオーボエを始める。津田沼高校2期生。同吹奏楽部創立時のメンバー。オーボエを似鳥健彦、丸山盛三、インゴ・ゴリツキの諸氏に師事。室内楽を大橋幸夫、霧生吉秀、丸山盛三の諸氏に師事。
                    ’88国立音楽大学卒業。同年リサイタルを開催。’91渡独し研鑽をつむ。</p>
					<p><a href="<?php echo home_url( '/' );echo '/about2/#efp_producer'; ?>" class="btn btn-primary">詳細を見る</a></p>
				</div>
			</div>
			<div class="fh5co-portfolio-item fh5co-img-right">
				<div class="fh5co-portfolio-figure animate-box" style="background-image: url(<?php bloginfo('template_directory'); ?>/images/work_2.jpg);"></div>
				<div class="fh5co-portfolio-description">
					<h2>団員募集</h2>
					<p>アンサンブル・フォルテピアノで一緒に演奏しませんか？吹奏楽が好きな方、精力的に練習参加してくれる方、大大大募集します！</p>
					<p><a href="<?php echo home_url( '/' );echo '/about2/#efp_recruit'; ?>" class="btn btn-primary">詳細を見る</a></p>
				</div>
			</div>
		</div>
		<?php get_template_part( 'detail-info' ); ?>
	</div>

<?php get_footer(); ?>
<?php 
/* イベント告知 */
    function printEvent(){
            /* event_dateをキーとして、イベント日を取得 */
            $event_date = get_post_custom_values('event_date');
            if( $event_date  ){

                /* 日付が未来かどうかをチェック */
                $event_date_str = strtotime( $event_date[0] );
                $today_str = strtotime(  date('y-m-d') );

                /* 未来のイベント内容を表示 */
                if( $event_date_str > $today_str ){
                    echo '<div class="event">';
                    /* イベント名称の表示 */
                    echo '<p>【次回イベント予定】</p>';
                    echo '<h1 class="efp_event_name">';
                    $event_name = get_post_custom_values('event_name');
                    if( $event_name  ){
                        echo( $event_name[0] );
                    }
                    echo '</h1>';
                    /* イベント日程の表示 */
                    echo '<div><p>';
                    echo date("Y",strtotime($event_date[0]));
                    echo '年';
                    echo '<span style="font-size:200%;">';
                    echo date("n",strtotime($event_date[0]));
                    echo '</span>';
                    echo '月';
                    echo '<span style="font-size:200%;">';
                    echo date("d",strtotime($event_date[0]));
                    echo '</span>';
                    echo '日';
                    echo '(';
                    echo strftime( '%a', strtotime( $event_date[0] ) );
                    echo ')</>';
                    echo '</p></div>';
                    /* イベント詳細 */
                    echo '<div>';
                    $event_open = get_post_custom_values('event_open');
                    if( $event_open  ){
                        echo '<p>開場時間：';
                        echo( $event_open[0] );
                        echo '</p>';
                    }
                    $event_start = get_post_custom_values('event_start');
                    if( $event_start  ){
                        echo '<p>開演時間：';
                        echo( $event_start[0] );
                        echo '</p>';
                    }
                    $event_place = get_post_custom_values('event_place');
                    if( $event_place  ){
                        echo '<p>会場：';
                        echo( $event_place[0] );
                        echo '</p>';
                    }
                    $event_program = get_post_custom_values('event_program');
                    if( $event_program  ){
                        echo '<p>演奏曲目：';
                        echo( $event_program[0] );
                        echo '</p>';
                    }
                    echo '</div>';
                    echo '</div>';
                    $event_url = get_post_custom_values('event_url');
                    if( $event_url  ){
                        echo '<p class="text-center"><a class="btn btn-primary" href="';
                        echo $event_url[0];
                        echo '">詳細はこちら</a></p>';
                    }
                }
                else{
                    printWelcome();
                    
                }
        }
        else{
            printWelcome();
        }
    }
/* デフォルトのトップページ表示メッセージ */
    function printWelcome(){

    }
    
    function recentEyecatchURL(){
        $posts = get_posts('numberposts=1&orderby=post_date&order=DESC');
        foreach($posts as $post){
            if(has_post_thumbnail($post->ID)){
                $thum_id = get_post_thumbnail_id($post->ID );
                $eye_img = wp_get_attachment_image_src($thum_id,'medium');
                return $eye_img[0];
            }
        }
        return get_bloginfo('template_directory')."/images/work_4.jpg";
    }

    function recentPostURL(){
        $posts = get_posts('numberposts=1&orderby=post_date&order=DESC');
        foreach($posts as $post){
            return get_permalink($post->ID);
        }
        return get_bloginfo('url')."?p=522";
    }
    
    
?>
<script type="text/javascript">
$(function(){
    $("#efp_jumbotron").click(function(){
        window.location=$(this).find("a").attr("href");
        return false;
    });
});    
</script>

