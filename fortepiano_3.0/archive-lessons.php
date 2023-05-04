<?php /* ヘッダー表示 */ 
	get_header();
 ?>

<div id="efp_post">
<?php
    //今日以降を出力
    $today = date('Y/m/d');
    $where = 'meta_key=lesson_date&meta_compare=>=&meta_value='.$today;
    $where = "posts_per_page=10&paged=$paged&post_type=lessons&orderby=meta_value&meta_key=lesson_date&order=ASC&$where";

    /* 日付の順でソートする */
    /* 10件ごとにページング */
    /* 現在のページ番号を取得して、pagedに渡しておくこと */
    $paged = get_query_var('paged');
//    query_posts( "posts_per_page=10&paged=$paged&post_type=lessons&orderby=meta_value&meta_key=lesson_date" );
    query_posts( $where );

    ?>


    <!-- タイトル表示 -->
    <dic class="row">
    <?php 
        /* 投稿を巻き戻し */
        rewind_posts();
        /* loop-mybooks.phpか、なければloop.phpを使用する */
        if( chk_mobile() ){
            get_template_part( 'loop', 'lessons-mobile' );
        }
        else{
            get_template_part( 'loop', 'lessons' );
        }
        wp_reset_query();
     ?>

    <?php if (function_exists("disp_pagination")) {
        disp_pagination($additional_loop->max_num_pages);
    } ?>
</div>

<?php get_footer();  /* フッターバーの表示 */ ?>
