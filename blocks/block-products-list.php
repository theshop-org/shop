<?php
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
);
$products = new WP_Query( $args );
$show_products = get_field('show_products');
$selected_products = get_field('select_products');
?>

<section class="products-list">
    <?php if($show_products): ?>
        <div class="products-grid">
            <?php foreach($selected_products as $key=>$product): 
                $product_ID = $product->ID;
                $hover_image = get_field('hover_image', $product_ID);
                $product_object = wc_get_product($product->ID);
                ?>
                <div class="product-card <?php echo ($key == 0 || ($key == 10 && $key != 1) || ($key % 14 == 0 && $key != 1) || ($key % 14 == 4 && $key != 4)) ? 'large' : 'small'; ?>">
                    <div class="product-card__wrapper">
                        <a href="<?php the_permalink($product_ID) ?>" class="product-card__image">
                            <div class="product-card__thumbnail">
                                <?php echo $product_object->get_image(); ?>
                                <?php if(isset($hover_image['url']) && $hover_image['url']): ?>
                                    <img src="<?php echo $hover_image['url'] ?>" alt="<?php echo $hover_image['title'] ?>" class="hover-image">
                                <?php endif; ?>
                            </div>
                        </a>    
                        <div class="product-card__info">
                            <h2 class="product-title">
                                <a href="<?php the_permalink($product_ID); ?>"><?php the_title($product_ID); ?></a>
                            </h2>
                            <span class="price"><?php echo $product_object->get_price_html(); ?></span>
                        </div>
                        <button class="product-card__cart<?php echo is_product_in_cart($product_ID) ? ' allready-added' : '' ?> add-to-cart-btn" data-product-id="<?php echo $product_ID; ?>" data-quantity="1">
                            <div class="add-to-cart">
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 5L19 12H7.37671M20 16H8L6 3H3M11.5 7L13.5 9M13.5 9L15.5 7M13.5 9V3M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>                                </div>
                            <div class="added-to-cart">
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 5L19 12H7.37671M20 16H8L6 3H3M11 6L13 8L17 4M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            </div>
                            <div class="remove-from-cart d-none">
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 5L19 12H7.37671M20 16H8L6 3H3M13.5 3V9M13.5 3L11.5 5M13.5 3L15.5 5M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                            </div>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <?php
        if ( $products->have_posts() ):
            ?>
                <div class="products-grid">
                    <?php
                    $count = 0;
                    while ( $products->have_posts() ) : $products->the_post();
                        global $product;
                        $hover_image = get_field('hover_image', get_the_ID());

                    ?>
                        <div class="product-card <?php echo ($count == 0 || ($count == 10 && $count != 1) || ($count % 14 == 0 && $count != 1) || ($count % 14 == 4 && $count != 4)) ? 'large' : 'small'; ?>">
                            <div class="product-card__wrapper">
                                <a href="<?php the_permalink() ?>" class="product-card__image">
                                    <div class="product-card__thumbnail">
                                        <?php echo woocommerce_get_product_thumbnail(); ?>
                                        <?php if(isset($hover_image['url']) && $hover_image['url']): ?>
                                            <img src="<?php echo $hover_image['url'] ?>" alt="<?php echo $hover_image['title'] ?>" class="hover-image">
                                        <?php endif; ?>
                                    </div>
                                </a>    
                                <div class="product-card__info">
                                    <h2 class="product-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <span class="price"><?php echo $product->get_price_html(); ?></span>
                                </div>
                                <button class="product-card__cart<?php echo is_product_in_cart(get_the_ID()) ? ' allready-added' : '' ?> add-to-cart-btn" data-product-id="<?php echo get_the_ID(); ?>" data-quantity="1">
                                    <div class="add-to-cart">
                                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 5L19 12H7.37671M20 16H8L6 3H3M11.5 7L13.5 9M13.5 9L15.5 7M13.5 9V3M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>                                </div>
                                    <div class="added-to-cart">
                                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 5L19 12H7.37671M20 16H8L6 3H3M11 6L13 8L17 4M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    </div>
                                    <div class="remove-from-cart d-none">
                                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 5L19 12H7.37671M20 16H8L6 3H3M13.5 3V9M13.5 3L11.5 5M13.5 3L15.5 5M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                    <?php
                        $count++;
                    endwhile;
                    ?>
                </div>
        <?php
            wp_reset_postdata();
        else:
            echo esc_html__( 'No products found', 'your-text-domain' );
        endif;
        ?>
    <?php endif; ?>
</section>
