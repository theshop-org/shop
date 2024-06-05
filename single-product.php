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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); 

			$product = wc_get_product(get_the_ID());
			$available_variations = $product->get_available_variations();
			$first_img = get_field('first_image');
			$second_img = get_field('second_image');


			if ( $product ) {
				$attributes = $product->get_variation_attributes();
			}

			$attribute_keys  = array_keys( $attributes );
			$variations_json = wp_json_encode( $available_variations );
			$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

			?>
				<div id="product-<?php echo get_the_ID(); ?>" class="product-single">
					<div class="product-single__landing">
						<div class="product-single__hero">
							<div class="product-single__hero--images">
								<?php if(!empty($available_variations)): ?>
									<?php foreach($available_variations as $key=>$variation): ?>
										<div class="product-single__hero--img" id="variationImg<?php echo $key ?>">
											<?php if(isset($variation['image']['url'])): ?>
												<img src="<?php echo $variation['image']['url'] ?>" alt="<?php echo $variation['image']['alt'] ?>">
											<?php endif; ?>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
								<div class="swiper mySwiper product-single__slider" id="singleSlider">
									<div class="swiper-wrapper product-single__slide-wrapper">
										<?php if(!empty($available_variations)): ?>
											<?php foreach($available_variations as $key=>$variation): ?>
												<div class="swiper-slide product-single__slide" id="variationImg<?php echo $key ?>">
													<?php if(isset($variation['image']['url'])): ?>
														<img src="<?php echo $variation['image']['url'] ?>" alt="<?php echo $variation['image']['alt'] ?>">
													<?php endif; ?>
												</div>
											<?php endforeach; ?>
										<?php endif; ?>
									</div>
									<div class="swiper-pagination"></div>
								</div>
							</div>
							<div class="product-single__content">
								<div class="product-single__sticky">
									<div class="product-single__desc">
										<?php echo $product->get_description(); ?>
									</div>
									<div class="product-single__attr">
										<div class="product-single__attr--price">
											<div>
												<?php echo __("Price"); ?>
											</div>
											<div>
												<?php echo get_woocommerce_currency_symbol() . $product->get_price(); ?>
											</div>
										</div>
										<div class="product-single__attr--size">
											<div>
												<?php echo __("Size:"); ?>
											</div>
											<div>
												<?php
													$width = $product->get_width();
													$height = $product->get_height();
													$length = $product->get_length();
												?>
												<?php echo $length . 'x' . $width . 'x' . $height . ' ' . get_option('woocommerce_dimension_unit')  ?>
											</div>
										</div>
										<div class="product-single__attr--weight">
											<div>
												<?php echo __("Weight:"); ?>
											</div>
											<div>
												<?php
													$weight = $product->get_weight();
												?>
												<?php echo $weight . ' ' . get_option('woocommerce_weight_unit')  ?>
											</div>
										</div>
										<div class="product-single__attr--short">
											<div>
												<?php
													$short_desc = $product->get_short_description();
												?>
												<?php echo $short_desc  ?>
											</div>
										</div>
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
																	<a href="#variationImg<?php echo $key ?>" data-key="<?php echo $key ?>" for="input<?php echo $key ?>" data-product-color="<?php echo $option; ?>" data-product-id="<?php echo $available_variations[$key]['variation_id']; ?>" style="background-color: <?php echo $option; ?>;" class="single-colors"></a>
																<?php endforeach; ?>
															<?php endif; ?>
														</div>
													<?php endforeach; ?>
												<?php endif; ?>																							
										</form>
										
									</div>
									<div class="product-single__buttons">
										<div class="quantity">
											<input type="button" value="-" class="minus">
											<input type="number" step="1" min="1" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric" id="productQuantity">
											<input type="button" value="+" class="plus">
										</div>
										<button type="button" class="product__single--add add-to-cart-single" disabled>
											<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		<?php 
	
	endwhile; // end of the loop. ?>

											
									<?php
get_footer( 'shop' );
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
