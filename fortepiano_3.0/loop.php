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
?>

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
        <?php if (have_posts()) : ?>
			<div class="row">
                <div class="col-md-8">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-10 col-md-offset-1" >
                        <div class="efpthumb">
                        <?php 
                            if(has_post_thumbnail()){
                                echo the_post_thumbnail( 'full',array('class'=>'fh5co-align-left img-responsive'));
                            }
                            else{
                                echo '<img class="fh5co-align-left img-responsive" src="'.get_bloginfo('template_directory').'/images/default.png" />';
                            }
                        ?>
                        </div>
                        
                        <h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s へのリンク', 'fortepiano' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                        <div class="efpattr">
                            <span class="fh5co-post-meta" >
                                <?php echo get_the_date("Y年n月j日"); ?>
                                <?php echo "　カテゴリー:".get_the_category_list( ', ' ); ?>
                                
                            </span>
                        </div>
                        <div class="row"  >
                            <div class="col-md-12 " style="margin-bottom:40px">
                                <?php //the_content('続きを読む'); ?>
                                <?php echo mb_substr(get_the_excerpt(), 0, 400); ?>
                                <p class="efpbluring">
                                    <a class="btn btn-primary"  href="<?php the_permalink(); ?>">続きを読む</a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
		            <div class="col-md-10 text-center">
		                <?php if (function_exists("disp_pagination")) {
		                    disp_pagination($additional_loop->max_num_pages);
		                } ?>
		            </div>
                </div>
				<div class="col-md-4">
                    <div class="col-md-10">
                        <!--
                        <div class="fh5co-sidebox">
                            <h3 class="fh5co-sidebox-lead">最近の投稿</h3>	
                            <ul class="fh5co-post">
                            <?php
                            /*
                                $recent_posts = wp_get_recent_posts(3);
                                foreach($recent_posts as $post){
                                    echo '<li>';
                                    echo '<a href="' . get_permalink($post["ID"]) . '" title="Look '.$post["post_title"].'" >' ;
                                    echo '<div class="fh5co-post-media">';
                                    if(has_post_thumbnail($post["ID"])){
    //                                    echo get_the_post_thumbnail($post["ID"],'thumbnail');
                                        $image_id = get_post_thumbnail_id($post["ID"]);
                                        $image_url = wp_get_attachment_image_src($image_id);
                                        echo '<img src="'.$image_url[0].'" />';
                                    }
                                    else{
                                        echo '<img  src="'.get_bloginfo('template_directory').'/images/default.png" />';
                                    }
                                    echo '</div><div class="fh5co-post-blurb">';

                                    echo $post["post_title"];
                                    echo '<span class="fh5co-post-meta">'.get_the_date("Y年n月j日",$post["ID"]).'</span></div>';
                                    echo '</a> </li> ';
                                }
                             * 
                             */
                            ?>

                            </ul>

                        </div>
                        -->
                		<?php get_template_part( 'recent-post' ); ?>

                        <div class="fh5co-sidebox">
                            <div class="list-group">
                                 <a href="#" class="list-group-item active">カテゴリー</a>
                                 <?php disp_categories(); ?>
                            </div>
                        </div>
                    </div>

				</div>
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


