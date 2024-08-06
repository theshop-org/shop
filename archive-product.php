<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header('shop');


$grid_texts = get_field('grid_texts', wc_get_page_id('shop'));
$main_image = get_field('main_image', wc_get_page_id('shop'));
$horizontal_image = get_field('horizontal_image', wc_get_page_id('shop'));
$vertical_image = get_field('vertical_image', wc_get_page_id('shop'));
$last_image = get_field('last_image', wc_get_page_id('shop'));
$count = 0;
if (have_posts()) : ?>
    <div class="shop-page gridStyleOne">
        
        <?php if(isset($main_image['url']) && $main_image['url']): ?>
            <div class="products-main-img">
                <img src="<?php echo $main_image['url'] ?>" alt="<?php echo $main_image['alt'] ?>">
            </div>
        <?php endif; ?>
        <div class="products-grid">
          <?php  while (have_posts()) : the_post();
                global $product;
                $main_hover = get_field("hover_image");
                $light_hover = get_field("light_hover_image");
                $dark_hover = get_field("dark_hover_image");
                // Check if product is variable
                if ($product->is_type('variable')) {
                    // If it's a variable product, get its variations
                    $available_variations = $product->get_available_variations();
                    if ( $product ) {
                        $attributes = $product->get_variation_attributes();
                    }
    
                    $attribute_keys  = array_keys( $attributes );
                    ?>
                    <div class="product" data-product-link="<?php echo get_permalink() ?>">
                        <a href="<?php echo get_permalink() ?>" class="product__main-img">
                            <img src="<?php echo wp_get_attachment_image_url($product->get_image_id(), 'full') ?>" alt="<?php echo get_the_title(); ?>" class="main">
                            <?php foreach ($available_variations as $key=>$variation) : ?>
                                <img src="<?php echo $variation['image']['url'] ?>"  alt="<?php echo get_the_title(); ?>" class="<?php echo $key ? 'dark' : 'light' ?>">
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
                                <div class="product__info--title"><?php echo get_the_title() ?></div> 
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
                    <?php if(!empty($grid_texts)): ?>
                        <?php foreach($grid_texts as $text): ?>
                            <?php if($text['show_after_which_product'] === get_the_ID()): ?>
                                <div class="product grid-text">
                                    <?php if(isset($text['url']) && $text['url']): ?>
                                        <a href="<?php echo $text['url'] ?>" class="product__only-text">
                                            <?php echo $text['text'] ?>
                                        </a>
                                    <?php else: ?>
                                        <div class="product__only-text">
                                            <?php echo $text['text'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php } else {
                    // If it's not a variable product, display basic information
                    ?>
                    <div class="product" data-product-cart="<?php echo get_the_ID() ?>">
                        <a  href="<?php echo get_permalink() ?>"class="product__main-img">
                            <img src="<?php echo wp_get_attachment_image_url($product->get_image_id(), 'full') ?>" alt="<?php echo get_the_title(); ?>" class="main">
                            
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
                                <div class="product__info--title"><?php echo get_the_title() ?></div>
                            </div>
                            <div class="product__info--right"><?php echo $product->get_price_html(); ?></div>
                        </div>
                    </div>
                    <?php if(!empty($grid_texts)): ?>
                        <?php foreach($grid_texts as $text): ?>
                            <?php if($text['show_after_which_product'] === get_the_ID()): ?>
                                <div class="product grid-text">
                                    <?php if(isset($text['url']) && $text['url']): ?>
                                        <a href="<?php echo $text['url'] ?>" class="product__only-text">
                                            <?php echo $text['text'] ?>
                                        </a>
                                    <?php else: ?>
                                        <div class="product__only-text">
                                            <?php echo $text['text'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    
                <?php
                }
                
                $count++;

                if ($count == 3) :
                    ?>
                            <div class="two-images">
                                <?php if(isset($horizontal_image['url']) && $horizontal_image['url']): ?>
                                    <div class="products-horizontal-img">
                                        <img src="<?php echo $horizontal_image['url'] ?>" alt="<?php echo $horizontal_image['alt'] ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if(isset($vertical_image['url']) && $vertical_image['url']): ?>
                                    <div class="products-vertical-img">
                                        <img src="<?php echo $vertical_image['url'] ?>" alt="<?php echo $vertical_image['alt'] ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                    <?php
                      $count++;
                endif;

               

                if ($count == 11) :
                    ?>
                              <?php if(isset($last_image['url']) && $last_image['url']): ?>
                                    <div class="products-last-image" >
                                        <img src="<?php echo $last_image['url'] ?>" alt="<?php echo $last_image['alt'] ?>">
                                    </div>
                                <?php endif; ?>
                    <?php
                endif;
                
            endwhile; ?>
        </div>
    </div>
    <?php
endif;

get_footer('shop');
?>

