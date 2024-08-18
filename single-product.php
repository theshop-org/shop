<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */
$safe_txt = get_field('safety_text', 'option');
$safe_list_care = get_field('list_safe', 'option');

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 
?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); 

			

			$product = wc_get_product(get_the_ID());

			if($product->is_type('variable')) {
				$available_variations = $product->get_available_variations();

				

				if ( $product ) {
					$attributes = $product->get_variation_attributes();
				}

				$attribute_keys  = array_keys( $attributes );
				$variations_json = wp_json_encode( $available_variations );
				$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
			}
			$first_img = get_field('first_image');
			$second_img = get_field('second_image');
			$related_products = get_field('related_products');

			?>
				<div id="product-<?php echo get_the_ID(); ?>" class="product-single">
					<div class="product-single__landing">
						<div class="product-single__hero">
							<div class="product-single__hero--images">
								<?php if($product->is_type('variable')): ?>
									<?php if(!empty($available_variations)): ?>
										<?php foreach($available_variations as $key=>$variation): ?>
											<div class="product-single__hero--img" id="variationImg<?php echo $key ?>">
												<?php if(isset($variation['image']['url'])): ?>
													<img src="<?php echo $variation['image']['url'] ?>" alt="<?php echo $variation['image']['alt'] ?>">
												<?php endif; ?>
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
								<?php else: ?>
									<?php if(isset($first_img['url'])): ?>
										<div class="product-single__hero--img">
												<img src="<?php echo $first_img['url'] ?>" alt="<?php echo $first_img['alt'] ?>">
										</div>
									<?php endif; ?>
									<?php if(isset($second_img['url'])): ?>
										<div class="product-single__hero--img">
												<img src="<?php echo $second_img['url'] ?>" alt="<?php echo $second_img['alt'] ?>">
										</div>
									<?php endif; ?>
								<?php endif; ?>
								<div class="swiper mySwiper product-single__slider" id="singleSlider">
									<div class="swiper-wrapper product-single__slide-wrapper">
										<?php if($product->is_type('variable')): ?>
											<?php if(!empty($available_variations)): ?>
												<?php foreach($available_variations as $key=>$variation): ?>
													<div class="swiper-slide product-single__slide" id="variationImg<?php echo $key ?>">
														<?php if(isset($variation['image']['url'])): ?>
															<img src="<?php echo $variation['image']['url'] ?>" alt="<?php echo $variation['image']['alt'] ?>">
														<?php endif; ?>
													</div>
												<?php endforeach; ?>
											<?php endif; ?>
										<?php else: ?>
											<?php if(isset($first_img['url'])): ?>
												<div class="swiper-slide product-single__slide">
														<img src="<?php echo $first_img['url'] ?>" alt="<?php echo $first_img['alt'] ?>">
												</div>
											<?php endif; ?>
											<?php if(isset($second_img['url'])): ?>
												<div class="swiper-slide product-single__slide">
														<img src="<?php echo $second_img['url'] ?>" alt="<?php echo $second_img['alt'] ?>">
												</div>
											<?php endif; ?>
										<?php endif; ?>
									</div>
									<div class="swiper-pagination"></div>
								</div>
							</div>
							<div class="product-single__content">
								<div class="product-single__sticky">
									<div class="product-single__desc">
										<div class="title-and-price">
												<div>
										<?php echo $product->get_title(); ?>
											</div>
												<div class="price-for-mobile-screen">
													<?php echo get_woocommerce_currency_symbol() . $product->get_price(); ?>
												</div>
											</div>
										
									</div>
									<div class="product-single__bot">

										<div class="product-single__attr">
											<div class="product-single__attr--price">
												<div>
													<?php echo __("Product price:"); ?>
												</div>
												<div>
													<?php echo get_woocommerce_currency_symbol() . $product->get_price(); ?>
												</div>
											</div>
											<?php if(isset($available_variations)): ?>
												<form class="product-single__attr--color"  action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
													<?php
		
														do_action( 'woocommerce_before_add_to_cart_form' )
														?>
														<?php do_action( 'woocommerce_before_variations_form' ); ?>
		
														<?php if ( empty( $available_variations ) && false !== $available_variations ) :  ?>
															<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
														<?php else : ?>
															<?php foreach ( $attributes as $attribute_name => $options ) :
																?>
																<div>
																	<?php echo $attribute_name; ?>
																</div>
		
																<div>
																	<?php if(!empty($options)): ?>
																		<?php foreach($options as $key=>$option): ?>
																			<input type="radio" data-product-color="<?php echo $option; ?>" value="<?php echo $available_variations[$key]['variation_id']; ?>" id="input<?php echo $key ?>" name="product-color" class="d-none">
																			<a href="#variationImg<?php echo $key ?>" data-key="<?php echo $key ?>" for="input<?php echo $key ?>" data-product-color="<?php echo $option; ?>" data-product-id="<?php echo $available_variations[$key]['variation_id']; ?>" style="background-color: <?php echo $option; ?>;" class="single-colors">
																				<span class="color-name">
																					<?php echo wc_get_product($available_variations[$key]['variation_id'])->get_description() ?>
																				</span>
																			</a>
																		<?php endforeach; ?>
																	<?php endif; ?>
																</div>
															<?php endforeach; ?>
														<?php endif; ?>																							
												</form>
											<?php endif; ?>
											<div class="product-single__attr--size">
												<div>
													<?php echo __("Product details:"); ?>
												</div>
												<div class="single-text-style">
													<?php
														echo $product->get_description();									
													?>
												</div>
											</div>
											<div class="product-single__attr--weight">
												<div>
													<?php echo __("Safety & Care:"); ?>
												</div>
												<div>
													<h5 class="single-text-style"><?php echo $safe_txt ?></h5>
													<div class="single-text-style list-care">
														<?php if(!empty($safe_list_care)):
															foreach($safe_list_care as $list): ?>
															<div>
																<?php if(isset($list['icon']['url']) && $list['icon']['url']): ?>
																	<img class="icon-width-style" src="<?php echo $list['icon']['url'] ?>" alt="<?php echo $list['icon']['alt'] ?>">
																<?php endif; ?>
																<span><?php echo $list['text'] ?></span>
															</div>
															<?php endforeach; ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
										<div class="product-single__buttons">
											<div class="quantity d-none">
												<input type="button" value="-" class="minus">
												<input type="number" step="1" min="1" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric" id="productQuantity">
												<input type="button" value="+" class="plus">
											</div>
											<button type="button" class="product__single--add add-to-cart-single" data-product-id="<?php echo $product->get_id(); ?>">
												<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php if(!empty($related_products)):
					?>
					<div class="shop-page gridStyleOne">
						<div class="products-grid">
							<?php  foreach($related_products as $key=>$product_id):
									$product = wc_get_product($product_id);
									$main_hover = get_field("hover_image", $product_id);
									$light_hover = get_field("light_hover_image", $product_id);
									$dark_hover = get_field("dark_hover_image", $product_id);
									// Check if product is variable
									if ($product->is_type('variable')) {
										// If it's a variable product, get its variations
										$available_variations = $product->get_available_variations();
										if ( $product ) {
											$attributes = $product->get_variation_attributes();
										}
						
										$attribute_keys  = array_keys( $attributes );
										?>
										
										
										<?php if($key === 1): ?>
											<div class="product grid-text">
												<div class="product__only-text">
													You might also like
												</div>
											</div>
										<?php endif; ?>
										<div class="product" data-product-link="<?php echo get_permalink($product_id) ?>">
											<a href="<?php echo get_permalink($product_id) ?>" class="product__main-img">
												<img src="<?php echo wp_get_attachment_image_url($product->get_image_id(), 'full') ?>" alt="<?php echo get_the_title($product_id); ?>" class="main">
												<?php foreach ($available_variations as $key=>$variation) : ?>
													<img src="<?php echo $variation['image']['url'] ?>"  alt="<?php echo get_the_title($product_id); ?>" class="<?php echo $key ? 'dark' : 'light' ?>">
												<?php endforeach; ?>
												<?php if(isset($main_hover['url']) && $main_hover['url']): ?>
													<img src="<?php echo $main_hover['url'] ?>" alt="<?php echo $main_hover['title'] ?>" class="main-hover">
												<?php endif; ?>
												<?php if(isset($light_hover['url']) && $light_hover['url']): ?>
													<img src="<?php echo $light_hover['url'] ?>" alt="<?php echo $light_hover['title'] ?>" class="light-hover">
												<?php endif; ?>
												<?php if(isset($dark_hover['url']) && $dark_hover['url']): ?>
													<img src="<?php echo $dark_hover['url'] ?>" alt="<?php echo $dark_hover['title'] ?>" class="dark-hover">
												<?php endif; ?>
												<div class="add-to-cart-shop">
													
													<svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="27.5" cy="27.5" r="27.5" fill="white" fill-opacity="0.4"/>
														<path d="M28.8 18.4V26.8H37.2V29.2H28.8V37.6H26.4V29.2H18V26.8H26.4V18.4H28.8Z" fill="#202020"/>
													</svg>
							
												</div>
											</a>
											<div class="product__info">
												<div class="product__info--left">
													<div class="product__info--title"><?php echo get_the_title($product_id) ?></div> 
													<div class="product__info--colors">
														<?php foreach ( $attributes as $attribute_name => $options ) :
															?>
															<?php if(!empty($options)): ?>
																<?php foreach($options as $key=>$option): ?>
																	<a href="#" data-color="<?php echo $key ? 'dark-color' : 'light-color' ?>" data-product-color="<?php echo $option; ?>" data-product-id="<?php echo $available_variations[$key]['variation_id']; ?>" style="background-color: <?php echo $option; ?>;" class="single-colors-shop <?php echo $key ? 'single-color-dark' : 'single-color-light'  ?>"></a>
																<?php endforeach; ?>
															<?php endif; ?>
														<?php endforeach; ?>
													</div>
												</div>
												<div class="product__info--right"><?php echo $product->get_price_html(); ?></div>
											</div>
										</div>
									<?php } else {
										// If it's not a variable product, display basic information
										?>
										
										<?php if($key === 1): ?>
											<div class="product grid-text">
												<div class="product__only-text">
													You might also like
												</div>
											</div>
										<?php endif; ?>
										<div class="product" data-product-cart="<?php echo $product_id ?>">
											<a  href="<?php echo get_permalink($product_id) ?>"class="product__main-img">
												<img src="<?php echo wp_get_attachment_image_url($product->get_image_id(), 'full') ?>" alt="<?php echo get_the_title($product_id); ?>" class="main">
												
												<?php if(isset($main_hover['url']) && $main_hover['url']): ?>
													<img src="<?php echo $main_hover['url'] ?>" alt="<?php echo $main_hover['title'] ?>" class="main-hover">
												<?php endif; ?>
												<?php if(isset($light_hover['url']) && $light_hover['url']): ?>
													<img src="<?php echo $light_hover['url'] ?>" alt="<?php echo $light_hover['title'] ?>" class="light-hover">
												<?php endif; ?>
												<?php if(isset($dark_hover['url']) && $dark_hover['url']): ?>
													<img src="<?php echo $dark_hover['url'] ?>" alt="<?php echo $dark_hover['title'] ?>" class="dark-hover">
												<?php endif; ?>
												<div class="add-to-cart-shop">
													
													<svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="27.5" cy="27.5" r="27.5" fill="white" fill-opacity="0.4"/>
													<path d="M28.8 18.4V26.8H37.2V29.2H28.8V37.6H26.4V29.2H18V26.8H26.4V18.4H28.8Z" fill="#202020"/>
													</svg>
							
												</div>
											</a>
											<div class="product__info">
												<div class="product__info--left">
													<div class="product__info--title"><?php echo get_the_title($product_id) ?></div>
												</div>
												<div class="product__info--right"><?php echo $product->get_price_html(); ?></div>
											</div>
										</div>
										
									<?php
									}
									
							endforeach; ?>
						</div>
					</div>

				<?php endif; ?>
		<?php 
	
	endwhile; // end of the loop. ?>

											
									<?php
get_footer( 'shop' );
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
