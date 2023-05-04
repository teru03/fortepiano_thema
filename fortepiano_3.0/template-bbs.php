<?php
/**
 * The main template file.
 *
 * アンサンブル・フォルテピアノテーマ
 *
 * @package WordPress
 * @subpackage efp_brass
 * @since efp_brass 1.0
 *
 Template Name: bbs

 */

get_header(); ?>
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
					<div class="entry-utility">
						<?php edit_post_link( __( '編集', 'fortepiano' ), '<span class="meta-sep"></span> <span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
					<?php
					if(  is_user_logged_in()  ) {
						comments_template( '', true );
					}
                    ?>
				<?php endwhile; ?>
			 
			<?php else : ?>
			 
			    <h2 class="title">記事が見つかりませんでした。</h2>
			    <p>検索で見つかるかもしれません。</p><br />
			    <?php get_search_form(); ?>
			 
			<?php endif; ?>
		</div>
		<?php get_template_part( 'detail-info' ); ?>
	</div>
</div>
<?php get_footer(); ?>
