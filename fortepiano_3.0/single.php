<?php
/**
 * The Blog file.
 *
 * アンサンブル・フォルテピアノテーマ BLOGページ
 *
 * @package WordPress
 * @subpackage efp_brass
 * @since efp_brass 3.0
 */
get_header(); ?>

<div id="fh5co-main">
    <div class="fh5co-intro text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1 class="intro-lead">ブログ</h1>
                    <p class="">日々の練習やイベント告知、音源や動画などもアップしてます。</p>
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-content">
		<div class="container">
            <div data-ab-css-background="1" class="row">
                <?php echo create_eyechatch();  ?>
            </div>    
        <?php if (have_posts()) : ?>
			<div class="row">
                <div class="col-md-8">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-10 col-md-offset-1" >
                        
                        <h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s へのリンク', 'fortepiano' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                        <div class="efpattr">
                            <span class="fh5co-post-meta" >
                                <?php echo get_the_date("Y年n月j日"); ?>
                                <?php echo "　カテゴリー:".get_the_category_list( ', ' ); ?>
                                
                            </span>
                        </div>
                        <div class="row"  >
                            <div class="col-md-12 " style="margin-bottom:40px">
                                <?php the_content(); ?>
                            </div>
                            <div class="entry-utility">
                                <?php edit_post_link( __( '編集', 'fortepiano' ), '<span class="meta-sep"></span> <span class="edit-link">', '</span>' ); ?>
                            </div><!-- .entry-utility -->
                            <?php comments_template( '', true ); ?>
                        </div>
                    </div>
                <?php
                    $previous_post = get_previous_post();
                    $previous_str = create_pager("efpprevious", $previous_post, "<< 前の記事");
                    $next_post = get_next_post();
                    $next_str = create_pager("efpnext", $next_post, "次の記事 >>");
                ?>
                <?php endwhile; ?>
                </div>
				<div class="col-md-4">
                    <?php get_template_part( 'recent-post' ); ?>

					<div class="fh5co-sidebox">
                        <div class="list-group">
                             <a href="#" class="list-group-item active">カテゴリー</a>
                             <?php disp_categories(); ?>
                        </div>
                        <a class="twitter-timeline" href="https://twitter.com/efp_brass" data-widget-id="422734186546360320">@efp_brass からのツイート</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                    

				</div>
            </div>
            <div class="row">

                <?php echo $previous_str; ?>
                <?php echo $next_str; ?>
            </div>
        <?php else : ?>

            <h2 class="title">記事が見つかりませんでした。!!!</h2>
            <p>検索で見つかるかもしれません。</p><br />
            <?php get_search_form(); ?>

        <?php endif; ?>
        </div>    

		<?php get_template_part( 'detail-info' ); ?>
    </div>


</div>

<?php get_footer(); ?>

