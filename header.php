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

$suggested_prod = get_field('products', 'option');


$args = array(
    'status' => 'publish', // Only count published products
    'limit' => -1, // No limit, get all products
    'return' => 'ids', // Only return IDs, we just need the count
);

$products = wc_get_products($args);

// Get the total count of products
$total_product_count = count($products);

?>

<div id="page" class="page-store">
	<div class="main-header__overlay"></div>
	<header id="masthead" class="main-header<?php echo is_admin_bar_showing() ? ' logged-in' : '' ?><?php echo is_archive() ? " archive-page" : "" ?>">
		<div class="main-header__wrapper">
			<div class="main-header__search-container">
				<a class="main-header__search" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
					<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M14.8428 14.0854L10.8753 10.1179C11.7759 9.04651 12.321 7.66641 12.321 6.16049C12.321 2.76363 9.55751 0 6.16049 0C2.76363 0.000669566 0 2.76415 0 6.161C0 9.55786 2.76346 12.3215 6.16049 12.3215C7.66644 12.3215 9.04651 11.7764 10.1179 10.8758L14.0854 14.8433C14.1899 14.9478 14.3271 15 14.4644 15C14.6017 15 14.7389 14.9478 14.8434 14.8433C15.053 14.6337 15.053 14.2956 14.8434 14.086L14.8428 14.0854ZM1.07161 6.16117C1.07161 3.35554 3.35493 1.07206 6.16073 1.07206C8.96653 1.07206 11.2498 3.35537 11.2498 6.16117C11.2498 8.96697 8.96653 11.2503 6.16073 11.2503C3.35493 11.2503 1.07161 8.96697 1.07161 6.16117Z" fill="black"/>
					</svg>
					SEARCH
				</a>

				<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
					<div class="offcanvas-header">
						<h5 class="offcanvas-title" id="offcanvasExampleLabel">SEARCH</h5>
						<button type="button" class="offcanvas-right-close" data-bs-dismiss="offcanvas" aria-label="Close">
						X CLOSE
						</button>
					</div>
					<div class="offcanvas-body">
						<div class="woocommerce-product-search">
							<?php get_search_form(); ?>
						</div>
						<div class="search-results-wrapper">
							<h4>SUGESTIONS</h4>
							<div class="search-results-js">
								<?php if($suggested_prod): ?>
									<?php foreach($suggested_prod as $key=>$product): ?>
										<?php
											
											$product_id = $product->ID;
											
											$product_permalink = get_permalink($product_id);
											$product_title = get_the_title($product_id);
											if($key < 3):	
										?>
										
											<a class="suggested-item" href="<?php echo $product_permalink ?>"><?php echo $product_title ?></a>

									<?php 
										endif;
									endforeach; ?>
								<?php endif; ?>
							</div>
							<div class="search-products">
								<h4>SUGGESTED PRODUCTS</h4>
								<div class="search-products__grid">
									<?php
									// Check if there are any products
									if ($suggested_prod) {
										// Loop through each product
										foreach ($suggested_prod as $product) {
											// Get the product ID
											$product_id = $product->ID;
											
											// Get the product image URL
											$product_image_url = get_the_post_thumbnail_url($product_id, 'thumbnail'); // You can change 'thumbnail' to any other image size you prefer
											
											// Get the product permalink
											$product_permalink = get_permalink($product_id);
											
											// Output the product image in a link
											echo '<a href="' . $product_permalink . '">';
											echo '<img src="' . $product_image_url . '" alt="' . get_the_title($product_id) . '">';
											echo '</a>';
										}
									} else {
										echo 'No suggested products found.';
									}
									
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if(isset($first_half) && $first_half): ?>
				<?php foreach($first_half as $item): ?>
					<a class="main-header__menu--item" href="<?php echo $item->url ?>" target="<?php echo $item->target ?>">
						<?php echo $item->title ?>
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
			<div class="main-header__logo" id="headerLogo">
				<?php echo get_custom_logo(); ?>
			</div>
				<?php if(isset($second_half) && $second_half): ?>
					<?php foreach($second_half as $item): ?>
						<a class="main-header__menu--item" href="<?php echo $item->url ?>" target="<?php echo $item->target ?>">
							<?php echo $item->title ?>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
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
				
				<div class="checkout-box">
					<div class="checkout-info">
						<div class="checkout-info__top">
							<span>Tax</span>
							<span>To be calculated in checkout</span>
						</div>
						<div class="checkout-info__top">
							<span>Subtotal</span>
							<span id="checkoutPrice"></span>
						</div>
					</div>
					<span id="checkoutEmpty" class="<?php echo WC()->cart->is_empty() ? 'd-block' :  'd-none' ?>">
						Cart is empty.
					</span>
						
					<a href="/checkout" id="checkoutOff" class="<?php echo WC()->cart->is_empty() ? 'd-none' :  'd-block' ?>">
						CHECKOUT
					</a>
				</div>
			</div>
		</div>
		<?php if(is_archive()): ?>
			<div class="products-header">
				<div class="products-count">
					<?php  echo $total_product_count  . ' ITEMS'; ?>
				</div>
				<div class="products-grid-change">
					<div class="grid-style active" id="gridStyleOne">                
						<svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.5" y="0.5" width="17" height="18" stroke="black"/>
						</svg>
					</div>
					<div class="grid-style" id="gridStyleTwo">  
						<svg width="9" height="19" viewBox="0 0 9 19" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.5" y="0.5" width="8" height="18" stroke="black"/>
						</svg>
						<svg width="9" height="19" viewBox="0 0 9 19" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="0.5" y="0.5" width="8" height="18" stroke="black"/>
						</svg>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</header>
	<!-- #masthead -->


