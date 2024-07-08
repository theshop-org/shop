<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="account" id="customer_login">
	<div class="account__container">
		<div class="account__login">
			<h2><?php esc_html_e( 'LOG IN TO YOUR ACCOUNT', 'woocommerce' ); ?></h2>
	
			<form class="woocommerce-form woocommerce-form-login login" method="post">
				<?php do_action( 'woocommerce_login_form_start' ); ?>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
					<label for="username"><?php esc_html_e( 'E-MAIL', 'woocommerce' ); ?></label>
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
					<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
					<label for="password"><?php esc_html_e( 'PASSWORD', 'woocommerce' ); ?></label>
				</p>
				<?php do_action( 'woocommerce_login_form' ); ?>
				<p class="form-row">
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
				</p>
				<p class="woocommerce-LostPassword lost_password">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				</p>
				<?php do_action( 'woocommerce_login_form_end' ); ?>
			</form>
		</div>
	
		<div class="account__register">
			<h2><?php esc_html_e( 'SIGN UP', 'woocommerce' ); ?></h2>
	
			<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
				<?php do_action( 'woocommerce_register_form_start' ); ?>
	
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" />
					<label for="reg_email"><?php esc_html_e( 'E-MAIL', 'woocommerce' ); ?></label>
				</p>
	
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
					<label for="reg_password"><?php esc_html_e( 'PASSWORD', 'woocommerce' ); ?></label>
				</p>
	
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password2" id="reg_password2" autocomplete="new-password" />
					<label for="reg_password2"><?php esc_html_e( 'CONFIRM PASSWORD', 'woocommerce' ); ?></label>
				</p>
	
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="first_name" id="reg_first_name" value="<?php echo ( ! empty( $_POST['first_name'] ) ) ? esc_attr( wp_unslash( $_POST['first_name'] ) ) : ''; ?>" />
					<label for="reg_first_name"><?php esc_html_e( 'NAME', 'woocommerce' ); ?></label>
				</p>
	
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="last_name" id="reg_last_name" value="<?php echo ( ! empty( $_POST['last_name'] ) ) ? esc_attr( wp_unslash( $_POST['last_name'] ) ) : ''; ?>" />
					<label for="reg_last_name"><?php esc_html_e( 'SURNAME', 'woocommerce' ); ?></label>
				</p>

				<div class="d-flex phone-container">
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="prefix" id="reg_prefix" value="<?php echo ( ! empty( $_POST['prefix'] ) ) ? esc_attr( wp_unslash( $_POST['prefix'] ) ) : ''; ?>" />
						<label for="reg_prefix"><?php esc_html_e( 'PREFIX', 'woocommerce' ); ?></label>
					</p>
		
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="phone" id="reg_phone" value="<?php echo ( ! empty( $_POST['phone'] ) ) ? esc_attr( wp_unslash( $_POST['phone'] ) ) : ''; ?>" />
						<label for="reg_phone"><?php esc_html_e( 'PHONE NUMBER', 'woocommerce' ); ?></label>
					</p>
				</div>
	
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide position-relative">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="privacy" type="checkbox" id="reg_privacy" value="1" /> <span>I have read and understand the <a href="#">Privacy and Cookies Policy.</a></span>
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-register__privacy">
					</label>
				</p>
	
				<!-- <?php do_action( 'woocommerce_register_form' ); ?> -->
	
				<p class="woocommerce-form-row form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
				</p>
	
				<?php do_action( 'woocommerce_register_form_end' ); ?>
			</form>
		</div>
	</div>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
