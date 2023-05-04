<?php
/**
 * The footer file.
 *
 * アンサンブル・フォルテピアノテーマ　フッター
 *
 * @package WordPress
 * @subpackage efp_brass
 * @since efp_brass 3.0
 */
?>

	<footer id="fh5co-footer">
		
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="fh5co-footer-widget">
						<h2 class="fh5co-footer-logo">アンサンブル・フォルテピアノ</h2>
						<ul class="fh5co-social">
							<li><a href="https://twitter.com/efp_brass"><i class="icon-twitter"></i></a></li>
							<li><a href="https://www.youtube.com/channel/UCwrqGFngCe1MOahjx6FC18w"><i class="icon-youtube"></i></a></li>
							<li><a href="https://soundcloud.com/efp-brass"><i class="icon-soundcloud"></i></a></li>
						</ul>
                        <p>習志野、船橋近辺で活動中。アンサンブル・フォルテピアノへの演奏依頼、問い合わせ、曲リクエスト、応援メッセージetc、
                        なんでもかまいませんので連絡を取りたい方は、こちらコンタクトフォームよりお願いします。<BR>
                        返信はなるべく早くしますが２～３日かかる場合もあるのでご了承ください。<BR>
                        また、勧誘や公序良俗に反するものはご遠慮ください。</p>
					</div>
				</div>

				<div class="col-md-6 col-sm-6">
					<div class="fh5co-footer-widget top-level">
						<?php 
						    //echo do_shortcode('[contact-form 1 "コンタクトフォーム 1"]');
						    echo "現在、フォームは整備中です。"; 
						?>
					</div>
				</div>
			</div>

			<div class="row fh5co-row-padded fh5co-copyright">
				<div class="col-md-5">
					<p><small>Copyright &copy; 2010 - <?php echo date('Y'); ?> <?php bloginfo(); ?> All Rights Reserved. <br>Designed by: <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> | Images by: <a href="http://deathtothestockphoto.com/" target="_blank">DeathToTheStockPhoto</a> </small></p>
				</div>
			</div>
            <div>
                <p id="page-top"><a href="#wrap">PAGE TOP</a></p>
            </div>
        </div>

	</footer>

	<!-- jQuery -->
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery.waypoints.min.js"></script>
	<!-- Main JS -->
	<script src="<?php bloginfo('template_directory'); ?>/js/main.js"></script>

</html>


<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
