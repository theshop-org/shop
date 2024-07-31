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

$my_account_page_id = get_option('woocommerce_myaccount_page_id');
$my_account_page_url = get_permalink($my_account_page_id);


// Get the total count of products
$total_product_count = count($products);

$contact_us_phone = get_field("contact_us_phone", "option");
$contact_us_email = get_field("contact_us_email", "option");
?>

<div id="page" class="page-store">
	<div class="main-header__overlay"></div>
	<header id="masthead" class="main-header<?php echo is_admin_bar_showing() ? ' logged-in' : '' ?><?php echo is_archive() ? " archive-page" : "" ?>">
		<div class="main-header__wrapper-mobile">
			
		</div>
		<div class="main-header__wrapper">
			<div class="main-header__mobile-part">
				<div class="main-header__menu-wrapper">
					<a class="main-header__mobile" data-bs-toggle="offcanvas" href="#offcanvasMobile" role="button" aria-controls="offcanvasMobile">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15.3199 8.5H0.613281C0.339948 8.5 0.113281 8.27333 0.113281 8C0.113281 7.72667 0.339948 7.5 0.613281 7.5H15.3199C15.5933 7.5 15.8199 7.72667 15.8199 8C15.8199 8.27333 15.5933 8.5 15.3199 8.5Z" fill="black"/>
							<path d="M15.3199 13.5938H0.613281C0.339948 13.5938 0.113281 13.3738 0.113281 13.0938C0.113281 12.8138 0.339948 12.5938 0.613281 12.5938H15.3199C15.5933 12.5938 15.8199 12.8204 15.8199 13.0938C15.8199 13.3671 15.5933 13.5938 15.3199 13.5938Z" fill="black"/>
							<path d="M15.3199 3.40625H0.613281C0.339948 3.40625 0.113281 3.17958 0.113281 2.90625C0.113281 2.63292 0.339948 2.40625 0.613281 2.40625H15.3199C15.5933 2.40625 15.8199 2.63292 15.8199 2.90625C15.8199 3.17958 15.5933 3.40625 15.3199 3.40625Z" fill="black"/>
						</svg>
					</a>
	
					<div class="offcanvas offcanvas-start offcanvas-mobile" tabindex="-1" id="offcanvasMobile" aria-labelledby="offcanvasMobileLabel">
						<div class="offcanvas-header">
							<h5 class="offcanvas-title" id="offcanvasMobileLabel">THESHOP.COM</h5>
							<button type="button" class="offcanvas-right-close" data-bs-dismiss="offcanvas" aria-label="Close">
							X CLOSE
							</button>
						</div>
						<div class="offcanvas-body">
							<div class="mobile-offcanvas">
								<div class="mobile-offcanvas__body">
									<a href="/about">ABOUT</a>
									<a href="/blog">BLOG</a>
								</div>
								<div class="mobile-offcanvas__footer">
									<h4 class="mobile-offcanvas__footer--title">
										CONTACT US
									</h4>
									<div class="mobile-offcanvas__footer--content">
										<a href="mailto:<?php echo $contact_us_email; ?>" class="mobile-offcanvas__footer--email">
											<?php echo $contact_us_email; ?>
										</a>
										<a href="tel:<?php echo $contact_us_phone; ?>" class="mobile-offcanvas__footer--phone">
											<?php echo $contact_us_phone; ?>
										</a>
										<span>Monday to Friday, 9am to 6pm GMT+4</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="main-header__search-container">
					<a class="main-header__search" data-bs-toggle="offcanvas" href="#offcanvasExampleMobile" role="button" aria-controls="offcanvasExampleMobile">
						<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M14.8428 14.0854L10.8753 10.1179C11.7759 9.04651 12.321 7.66641 12.321 6.16049C12.321 2.76363 9.55751 0 6.16049 0C2.76363 0.000669566 0 2.76415 0 6.161C0 9.55786 2.76346 12.3215 6.16049 12.3215C7.66644 12.3215 9.04651 11.7764 10.1179 10.8758L14.0854 14.8433C14.1899 14.9478 14.3271 15 14.4644 15C14.6017 15 14.7389 14.9478 14.8434 14.8433C15.053 14.6337 15.053 14.2956 14.8434 14.086L14.8428 14.0854ZM1.07161 6.16117C1.07161 3.35554 3.35493 1.07206 6.16073 1.07206C8.96653 1.07206 11.2498 3.35537 11.2498 6.16117C11.2498 8.96697 8.96653 11.2503 6.16073 11.2503C3.35493 11.2503 1.07161 8.96697 1.07161 6.16117Z" fill="black"/>
						</svg>
					</a>
					<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExampleMobile" aria-labelledby="offcanvasExampleMobileLabel">
						<div class="offcanvas-header">
							<h5 class="offcanvas-title" id="offcanvasExampleMobileLabel">SEARCH</h5>
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
			</div>
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
			<div class="main-header__cart main-header__mobile-part">
				<a href="<?php echo $my_account_page_url ?>" class="account-mobile">
					
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M8 7.01448C6.06667 7.01448 4.5 5.44115 4.5 3.51448C4.5 1.58781 6.06667 0.0078125 8 0.0078125C9.93333 0.0078125 11.5 1.58115 11.5 3.50781C11.5 5.43448 9.92667 7.00781 8 7.00781V7.01448ZM8 1.00781C6.62 1.00781 5.5 2.12781 5.5 3.50781C5.5 4.88781 6.62 6.00781 8 6.00781C9.38 6.00781 10.5 4.88781 10.5 3.50781C10.5 2.12781 9.38 1.00781 8 1.00781Z" fill="black"/>
						<path d="M14.7734 15.7411H1.22669L1.16669 15.3078C1.12669 15.0078 1.10669 14.7011 1.10669 14.3945C1.10669 10.5945 4.20002 7.50781 7.99336 7.50781C11.7867 7.50781 14.88 10.6011 14.88 14.3945C14.88 14.7011 14.86 15.0078 14.82 15.3078L14.7667 15.7411H14.7734ZM2.12002 14.7411H13.88C13.88 14.6278 13.8867 14.5078 13.8867 14.3945C13.8867 11.1478 11.2467 8.50781 8.00002 8.50781C4.75336 8.50781 2.11336 11.1478 2.11336 14.3945C2.11336 14.5078 2.11336 14.6278 2.12669 14.7411H2.12002Z" fill="black"/>
					</svg>

				</a>
				<button class="main-header__cart--btn" id="offcanvasCartButton" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
					<span>
						CART (<span id="cartCount"><?php echo $cart_count ?></span>)
					</span>	
					
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g clip-path="url(#clip0_1194_720)">
							<path d="M3.69318 15.8942C2.67318 15.8942 1.83984 15.0608 1.83984 14.0408C1.83984 13.0208 2.67318 12.1875 3.69318 12.1875C4.71318 12.1875 5.54651 13.0208 5.54651 14.0408C5.54651 15.0608 4.71318 15.8942 3.69318 15.8942ZM3.69318 13.1942C3.22651 13.1942 2.83984 13.5742 2.83984 14.0475C2.83984 14.5208 3.21984 14.9008 3.69318 14.9008C4.16651 14.9008 4.54651 14.5208 4.54651 14.0475C4.54651 13.5742 4.16651 13.1942 3.69318 13.1942Z" fill="black"/>
							<path d="M9.51984 15.8864C8.49984 15.8864 7.6665 15.053 7.6665 14.033C7.6665 13.013 8.49984 12.1797 9.51984 12.1797C10.5398 12.1797 11.3732 13.013 11.3732 14.033C11.3732 15.053 10.5398 15.8864 9.51984 15.8864ZM9.51984 13.1864C9.05317 13.1864 8.6665 13.5664 8.6665 14.0397C8.6665 14.513 9.0465 14.893 9.51984 14.893C9.99317 14.893 10.3732 14.513 10.3732 14.0397C10.3732 13.5664 9.99317 13.1864 9.51984 13.1864Z" fill="black"/>
							<path d="M11.3399 11.6052H2.1332L0.0332031 4.03853H11.7999L12.4265 0.825195H15.9932C16.2665 0.825195 16.4932 1.05186 16.4932 1.3252C16.4932 1.59853 16.2665 1.8252 15.9932 1.8252H13.2465L11.3332 11.5985L11.3399 11.6052ZM2.8932 10.6052H10.5199L11.6065 5.0452H1.34654L2.8932 10.6052Z" fill="black"/>
						</g>
					<defs>
						<clipPath id="clip0_1194_720">
							<rect width="16" height="16" fill="white"/>
						</clipPath>
						</defs>
					</svg>
				</button>
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
				<div class="post-card">
					<div class="post-card__left">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="addPostCardCheck">
							<label class="form-check-label" for="addPostCardCheck">
								Add Post Card
							</label>
						</div>
						<!-- Button to open the modal -->
						<button type="button" class="post-card__btn" id="addMessageButton" data-bs-toggle="modal" data-bs-target="#messageModal">
							+ Add message to the card
						</button>
	
					</div>
					<div class="post-card__right">
						10 GEL
					</div>
				</div>
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

				<!-- Bootstrap Modal -->
				<div class="modal fade card-modal" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="messageModalLabel">Post Card Message</h5>
								<p class="modal-text">
									A personal message written by you will be printed onto The Shop card and placed inside your package. Please note that all documents will still be included. 
								</p>
							</div>
							<div class="modal-body">
								<textarea class="form-control" id="postCardMessage" rows="4" placeholder="Write your message here..." maxlength="435"></textarea>
								<div id="characterCount">0/435 characters</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="modal-footer-save" id="saveMessageButton"  data-bs-dismiss="modal" disabled>SEND</button>
							</div>
						</div>
					</div>
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



