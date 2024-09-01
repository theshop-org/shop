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
				<p class="woocommerce-LostPassword lost_password"  data-bs-toggle="modal" data-bs-target="#messagePw">
                    Lost your password?
                </p>
				<?php do_action( 'woocommerce_login_form_end' ); ?>
			</form>
		</div>
	
		<div class="account__register">
    <h2><?php esc_html_e( 'SIGN UP', 'text-domain' ); ?></h2>

    <form method="post" class="custom-form-register">
        <p class="form-row form-row-wide">
            <input type="email" class="input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>"  required />
            <label for="reg_email"><?php esc_html_e( 'E-MAIL', 'text-domain' ); ?></label>
        </p>

        <p class="form-row form-row-wide">
            <input type="password" class="input-text" name="password" id="reg_password" autocomplete="new-password"  required />
            <label for="reg_password"><?php esc_html_e( 'PASSWORD', 'text-domain' ); ?></label>
        </p>

        <p class="form-row form-row-wide">
            <input type="password" class="input-text" name="password2" id="reg_password2" autocomplete="new-password" required  />
            <label for="reg_password2"><?php esc_html_e( 'CONFIRM PASSWORD', 'text-domain' ); ?></label>
        </p>

        <p class="form-row form-row-wide">
            <input type="text" class="input-text" name="first_name" id="reg_first_name" value="<?php echo ( ! empty( $_POST['first_name'] ) ) ? esc_attr( wp_unslash( $_POST['first_name'] ) ) : ''; ?>"  required />
            <label for="reg_first_name"><?php esc_html_e( 'NAME', 'text-domain' ); ?></label>
        </p>

        <p class="form-row form-row-wide">
            <input type="text" class="input-text" name="last_name" id="reg_last_name" value="<?php echo ( ! empty( $_POST['last_name'] ) ) ? esc_attr( wp_unslash( $_POST['last_name'] ) ) : ''; ?>"  required />
            <label for="reg_last_name"><?php esc_html_e( 'SURNAME', 'text-domain' ); ?></label>
        </p>

        <div class="d-flex phone-container">
            <p class="form-row form-row-wide">
                <input type="text" class="input-text" name="prefix" id="reg_prefix" value="<?php echo ( ! empty( $_POST['prefix'] ) ) ? esc_attr( wp_unslash( $_POST['prefix'] ) ) : ''; ?>" required  />
                <label for="reg_prefix"><?php esc_html_e( 'PREFIX', 'text-domain' ); ?></label>
            </p>

            <p class="form-row form-row-wide">
                <input type="text" class="input-text" name="phone" id="reg_phone" value="<?php echo ( ! empty( $_POST['phone'] ) ) ? esc_attr( wp_unslash( $_POST['phone'] ) ) : ''; ?>" required  />
                <label for="reg_phone"><?php esc_html_e( 'PHONE NUMBER', 'text-domain' ); ?></label>
            </p>
        </div>

        <p class="form-row form-row-wide">
            <input class="input-checkbox" name="privacy" type="checkbox" id="reg_privacy" value="1" /> <span><?php esc_html_e( 'I have read and understand the', 'text-domain' ); ?> <a href="#">Privacy and Cookies Policy.</a></span>
        </p>

        <p class="form-row">
            <button type="submit" class="button" name="register" value="<?php esc_attr_e( 'Register', 'text-domain' ); ?>"><?php esc_html_e( 'Register', 'text-domain' ); ?></button>
        </p>
    </form>
</div>

	</div>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>



<div class="modal fade card-modal" id="messagePw" tabindex="-1" aria-labelledby="messagePwLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messagePwLabel"><?php echo __('Lost your password?', 'storefront') ?></h5>
                <p class="modal-text" id="modalText">
                    <?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?>
                </p>
            </div>
            <div class="modal-body">
            <form method="post" id="lostPasswordForm">
                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                    <label for="user_login">Username or email</label>
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" required />
                </p>

                <div class="clear"></div>

                <div class="modal-footer p-0">
                <?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

                    <button type="submit" class="modal-footer-save">Reset password</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>