<?php
/**
 * The Blog file.
 *
 * アンサンブル・フォルテピアノテーマ 固定ページ
 *
 * @package WordPress
 * @subpackage efp_brass
 * @since efp_brass 3.0
 */
?>
<?php get_header(); ?>
<div id="fh5co-main">
    <div class="fh5co-intro text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1 class="intro-lead"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div id="fh5co-content">
		<div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
			 
        <?php else : ?>
			 
            <h2 class="title">記事が見つかりませんでした。</h2>
            <p>検索で見つかるかもしれません。</p><br />
            <?php get_search_form(); ?>

        <?php endif; ?>
        </div>
		<?php get_template_part( 'detail-info' ); ?>
    </div>
<?php get_footer(); ?>
