		<div id="fh5co-services">
			<div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <h2 class="section-lead text-center">もっと知りたい</h2>
                        <div class="col-md-6 col-sm-6">
                            <div class="fh5co-feature">
                                <div class="fh5co-feature-icon to-animate">
                                    <i class="icon-clock2"></i>
                                </div>
                                <div class="fh5co-feature-text">
                                    <a href="<?php bloginfo('url'); ?>?post_type=lessons"><h3>スケジュール</h3></a>
                                    <p>練習日、場所などはこちらから確認してください。</p>
                                    <p><a href="<?php bloginfo('url'); ?>?post_type=lessons">もっと見る</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 fh5co-feature-border">
                            <div class="fh5co-feature">
                                <div class="fh5co-feature-icon to-animate">
                                    <i class="icon-mail"></i>
                                </div>
                                <div class="fh5co-feature-text">
                                    <h3>コンタクト</h3>
                                    <p>演奏依頼などはコンタクトフォームからどうぞ。</p>
                                    <p><a href="<?php echo home_url( '/' );echo '#fh5co-footer'; ?>">もっと見る</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="fh5co-feature">
                                <div class="fh5co-feature-icon to-animate">
                                    <i class="icon-youtube"></i>
                                </div>
                                <div class="fh5co-feature-text">
                                    <a href="https://www.youtube.com/channel/UCwrqGFngCe1MOahjx6FC18w" target="_blank"><h3>youtube</h3></a>
                                    <p>演奏動画です。よければみてください。</p>
                                    <p><a href="https://www.youtube.com/channel/UCwrqGFngCe1MOahjx6FC18w" target="_blank">もっと見る</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 fh5co-feature-border">
                            <div class="fh5co-feature">
                                <div class="fh5co-feature-icon to-animate">
                                    <i class="icon-soundcloud"></i>
                                </div>
                                <div class="fh5co-feature-text">
                                    <a href="https://soundcloud.com/efp-brass" target="_blank"><h3>soundcloud</h3></a>
                                    <p>演奏音源です。よければ聞いてください。</p>
                                    <p><a href="https://soundcloud.com/efp-brass" target="_blank">もっと見る</a></p>
                                </div>
                            </div>
                        </div>
                        <?php if( is_user_logged_in() ) : ?>

                            <h2 class="section-lead text-center">団員専用メニュー</h2>
                            <div class="col-md-6 col-sm-6">
                                <div class="fh5co-feature">
                                    <div class="fh5co-feature-icon to-animate">
                                        <i class="icon-pencil"></i>
                                    </div>
                                    <div class="fh5co-feature-text">
                                        <a href="http://fortepiano.s377.xrea.com/fpboard/fpboard.cgi?usrid=guest&inpwd=guest" target="_blank"><h3>掲示板</h3></a>
                                        <p>団員専用掲示板はこちらからどうぞ。ログインなしでみることができます。</p>
                                        <p><a href="http://fortepiano.s377.xrea.com/fpboard/fpboard.cgi?usrid=guest&inpwd=guest" target="_blank">もっと見る</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 fh5co-feature-border">
                                <div class="fh5co-feature">
                                    <div class="fh5co-feature-icon to-animate">
                                        <i class="icon-music-tone"></i>
                                    </div>
                                    <div class="fh5co-feature-text">
                                        <h3>イベント</h3>
                                        <p>団員専用各種イベントページはこちらからどうぞ。</p>
                                        <?php wp_nav_menu( array( 'container'=>'',   'theme_location' => 'event_menu' )); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="fh5co-feature">
                                    <div class="fh5co-feature-icon to-animate">
                                        <i class="icon-open-book"></i>
                                    </div>
                                    <div class="fh5co-feature-text">
                                        <h3>マニュアル</h3>
                                        <p>各種マニュアルはこちらからどうぞ。</p>
                                        <ul>
                                            <li><a href="http://fortepiano.s377.xrea.com/wordpress/%E7%B7%B4%E7%BF%92%E6%97%A5%E3%81%AE%E8%BF%BD%E5%8A%A0%E6%96%B9%E6%B3%95/" target="_link">練習日の追加方法</a></li>
                                            <li><a href="https://drive.google.com/file/d/0B_Xm6yEfT8enU2lEb3AzX0ExbzA/view" target="_link">ユーザー登録方法</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 fh5co-feature-border">
                                <div class="fh5co-feature">
                                    <div class="fh5co-feature-icon to-animate">
                                        <i class="icon-archive "></i>
                                    </div>
                                    <div class="fh5co-feature-text">
                                        <a href="http://fortepiano.s377.xrea.com/wordpress/%E3%82%A4%E3%83%99%E3%83%B3%E3%83%88%E3%82%A2%E3%83%BC%E3%82%AB%E3%82%A4%E3%83%96/"><h3>アーカイブ</h3></a>
                                        <p>過去のイベントはこちらからどうぞ。</p>
                                        <ul>
                                            <li><a href="http://fortepiano.s377.xrea.com/wordpress/%E3%82%A4%E3%83%99%E3%83%B3%E3%83%88%E3%82%A2%E3%83%BC%E3%82%AB%E3%82%A4%E3%83%96/">過去のイベントページ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="fh5co-feature">
                                    <div class="fh5co-feature-icon to-animate">
                                        <img src="<?php bloginfo('template_directory'); ?>/images/line-share-c.png"/>
                                    </div>
                                    <div class="fh5co-feature-text">
                                        <h3>EFPスケジューラーボット</h3>
                                        <p>友達登録すると当日の朝10時にLINEでスケジュールと出欠状況をお知らせします</p>
                                        <p>そこから自分の出欠状況を変更することもできるよ！是非登録してくださいね！</p>
                                        <p>シークレットコードはおなじみ<img width="120" src="<?php bloginfo('template_directory'); ?>/images/image.jpg"/>ですので</p>
                                        <div class="line-it-button" data-lang="ja" data-type="friend" data-lineid="@ycy3086z" data-count="true" data-home="true" style="display: none;"></div>
                                             <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-md-6 col-sm-6 fh5co-feature-border">
                                <div class="fh5co-feature">
                                    <div class="fh5co-feature-icon to-animate">
                                        <i class="icon-login "></i>
                                    </div>
                                    <div class="fh5co-feature-text">
                                        <a href="http://fortepiano.s377.xrea.com/wordpress/login/"><h3>ログイン</h3></a>
                                        <p>団員専用ページへはこちらからログインしてください。</p>
                                        <p><a href="http://fortepiano.s377.xrea.com/wordpress/login/">ログイン</a></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>    
		</div>
