<form action="<?= esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) ?>" class="password-protection-form" method="post">
	<div class="password-protection-form__inner">
		<p><?= __( 'This content is password protected. To view it please enter your password below:' ) ?></p>
		<div class="password-protection-form__field">
			<label class="screen-reader-text" for="password-protection-form__input"><?= __( 'Password:' ) ?></label>
			<input class="password-protection-form__input" name="post_password" id="password-protection-form__input" type="password" size="20" placeholder="<?= __( 'Password' ) ?>"/>
			<input type="submit" name="Submit" value="<?= esc_attr__( 'Ontgrendel', 'wbl-theme' ) ?>" />
		</div>
	</div>
</form>
