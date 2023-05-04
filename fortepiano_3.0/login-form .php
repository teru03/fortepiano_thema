<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="row clearfix">
    <div class="col-md-12 column text-center">
        <div id="efp_post" class="row">
			<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
				<span style="color:red;"><p>本ページは、団員および関係者専用です。</p>
				<p>それ以外の方は申し訳ありませんが、他のページをお楽しみください。</p></span>
				<BR>
				<?php $template->the_action_template_message( 'login' ); ?>
				<?php $template->the_errors(); ?>
				<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
					<p>
						<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username' ); ?></label>
						<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
					</p>
					<p>
						<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password' ); ?></label>
						<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" />
					</p>

					<?php do_action( 'login_form' ); ?>

					<p class="forgetmenot">
						<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
						<label for="rememberme<?php $template->the_instance(); ?>"><?php esc_attr_e( 'Remember Me' ); ?></label>
					</p>
					<p class="submit">
						<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In' ); ?>" />
						<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
						<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
						<input type="hidden" name="action" value="login" />
					</p>
				</form>
				<p>新規登録の方は<a href="http://fortepiano.s377.xrea.com/wordpress/%E3%82%B7%E3%83%BC%E3%82%AF%E3%83%AC%E3%83%83%E3%83%88%E3%82%B3%E3%83%BC%E3%83%89/">こちら</a>からどうぞ</p>
				<p>パスワードを忘れた方は<a href="http://fortepiano.s377.xrea.com/wordpress/login/?action=lostpassword">こちら</a>からどうぞ</p>
			</div>
		</div>
	</div>
</div>
