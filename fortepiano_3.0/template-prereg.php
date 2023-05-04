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
 Template Name: prereg

 */
//次へボタンが押されたかつ、コードが正しければ移動
if ($_POST['scode'] != '' && ( strcmp( $_POST['scode'], "EfpEband") == 0 || strcmp( $_POST['scode'], "7777")== 0)  ) {
	if( check_admin_referer( 'efp_prereg', 'efp_prereg_nonce' ) ){
		$urlset=home_url( '/' )."login/?action=register"; 
		header("Location: $urlset");
	}
}

get_header(); ?>
<div id="fh5co-main">
    <div class="fh5co-intro text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1 class="intro-lead"><?php the_title(); ?></h1>
                    <form action="" method="POST">
                        <?php
                            if( $_POST['scode'] != '' ){
                                echo '<span style="color:red">シークレットコードが間違っています。</span>';
                            }
                        ?>

                        <p>アンサンブル・フォルテピアノのユーザー登録をされるかたは、</p>
                        <p>まずは、以下より登録用シークレットコードを入力してください。</p>
                        <p>わからない場合は、団員に確認してください。</p><BR>
                        <div><input name="scode" id=""scode" cols="10"  type="password" ></input></div>
                        <div><input type="submit" name="登録" value="次へ" /></div>
                        <?php wp_nonce_field( 'efp_prereg','efp_prereg_nonce' ); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
