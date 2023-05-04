<?php
/**
 * The main template file.
 *
 * アンサンブル・フォルテピアノテーマ
 *
 * @package WordPress
 * @subpackage efp_brass
 * @since efp_brass 3.0
 */

get_header(); ?>

    <?php
     get_template_part( 'loop', 'index' );
    ?>

<?php get_footer(); ?>
