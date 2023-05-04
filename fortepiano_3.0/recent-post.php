<div class="fh5co-sidebox">
    <h3 class="fh5co-sidebox-lead">最近の投稿</h3>	
    <ul class="fh5co-post">
    <?php
        $recent_posts = wp_get_recent_posts(5);
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
    ?>

    </ul>

</div>
