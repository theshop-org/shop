<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open();

$cart_count = WC()->cart->get_cart_contents_count();

$menu_items = ms_getMenuItemes()['menu']['primary'];
$chunks = array_chunk($menu_items, ceil(count($menu_items) / 2));
$pre_text = get_field('text', 'options');

$first_half = $chunks[0];
$second_half = $chunks[1];

?>

<div id="page" class="page-store">
	<div class="main-header__overlay"></div>
	<header id="masthead" class="main-header<?php echo is_admin_bar_showing() ? ' logged-in' : '' ?>">
		<div class="main-header__wrapper">
			<div class="main-header__search">
				<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M14.8428 14.0854L10.8753 10.1179C11.7759 9.04651 12.321 7.66641 12.321 6.16049C12.321 2.76363 9.55751 0 6.16049 0C2.76363 0.000669566 0 2.76415 0 6.161C0 9.55786 2.76346 12.3215 6.16049 12.3215C7.66644 12.3215 9.04651 11.7764 10.1179 10.8758L14.0854 14.8433C14.1899 14.9478 14.3271 15 14.4644 15C14.6017 15 14.7389 14.9478 14.8434 14.8433C15.053 14.6337 15.053 14.2956 14.8434 14.086L14.8428 14.0854ZM1.07161 6.16117C1.07161 3.35554 3.35493 1.07206 6.16073 1.07206C8.96653 1.07206 11.2498 3.35537 11.2498 6.16117C11.2498 8.96697 8.96653 11.2503 6.16073 11.2503C3.35493 11.2503 1.07161 8.96697 1.07161 6.16117Z" fill="black"/>
				</svg>
				SEARCH
			</div>
			<div class="main-header__menu">
				<?php if(isset($first_half) && $first_half): ?>
					<?php foreach($first_half as $item): ?>
						<a class="main-header__menu--item" href="<?php echo $item->url ?>" target="<?php echo $item->target ?>">
							<?php echo $item->title ?>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<div class="main-header__logo">
				<?php echo get_custom_logo(); ?>
			</div>
			<div class="main-header__menu">
				<?php if(isset($second_half) && $second_half): ?>
					<?php foreach($second_half as $item): ?>
						<a class="main-header__menu--item" href="<?php echo $item->url ?>" target="<?php echo $item->target ?>">
							<?php echo $item->title ?>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<div class="main-header__cart">
				<button class="main-header__cart--btn" id="offcanvasCartButton" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">CART (<span id="cartCount"><?php echo $cart_count ?></span>)</button>
			</div>
		</div>
		<div class="preloader<?php echo is_front_page() ? '' : ' d-none' ?>">
			<div class="preloader__title">
				<div class="preloader__title-inside">
					<?php if($pre_text):
						?>
						<div class="overflow-hidden">
							<div class="animate-preloader__title"><?php echo $pre_text; ?></div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
			<div class="offcanvas-header">
				<div class="offcanvas-title" id="offcanvasRightLabel">
					CART (<span id="cartCountOffcanvas"><?php echo $cart_count ?></span>)
				</div>
				<button type="button" class="offcanvas-right-close" data-bs-dismiss="offcanvas" aria-label="Close">
					X CLOSE
				</button>
			</div>
			<div class="offcanvas-body">
				<div id="offcanvasBody"></div>
				
				
				<span id="checkoutEmpty" class="<?php echo WC()->cart->is_empty() ? 'd-block' :  'd-none' ?>">
					Cart is empty.
				</span>
					
				<a href="/checkout" id="checkoutOff" class="<?php echo WC()->cart->is_empty() ? 'd-none' :  'd-block' ?>">
					CHECKOUT
				</a>
			</div>
		</div>
	</header>
	<!-- #masthead -->


