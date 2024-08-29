<?php
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);
function enqueue_child_theme_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( 'storefront-style' )
    );
    wp_enqueue_style( 'child-assets-style', get_stylesheet_directory_uri() . '/assets/style.css',
        array( 'storefront-style' )
    );
}

add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_scripts', PHP_INT_MAX );
function enqueue_child_theme_scripts() {
    // Enqueue the JavaScript file
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'child-scripts', get_stylesheet_directory_uri() . '/assets/scripts.bundle.js', array(), '1.0', true );

    wp_localize_script('child-scripts', 'custom_script_vars', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('add_to_cart_nonce')
    ));
}


add_action('acf/init', 'my_acf_init');
function my_acf_init()
{
    if (function_exists('acf_register_block')) {
        acf_register_block(array(
            'name' => 'products-list',
            'title' => __('Products list'),
            'description' => __('Products list on homepage.'),
            'render_callback' => 'my_acf_block_render_callback',
            'category' => 'formatting',
            'icon' => 'align-full-width',
            'keywords' => array('Products', 'List', 'Homepage'),
        ));
    }
    if (function_exists('acf_register_block')) {
        acf_register_block(array(
            'name' => 'hero-scroll',
            'title' => __('Hero Scroll'),
            'description' => __('Hero scroll'),
            'render_callback' => 'my_acf_block_render_callback',
            'category' => 'formatting',
            'icon' => 'align-full-width',
            'keywords' => array('Hero', 'scroll', 'Homepage'),
        ));
    }
    if (function_exists('acf_register_block')) {
        acf_register_block(array(
            'name' => 'about-us',
            'title' => __('About Us'),
            'description' => __('About us block'),
            'render_callback' => 'my_acf_block_render_callback',
            'category' => 'formatting',
            'icon' => 'align-full-width',
            'keywords' => array('About', 'Us', 'Contact'),
        ));
    }
    if (function_exists('acf_register_block')) {
        acf_register_block(array(
            'name' => 'contact-us',
            'title' => __('Contact Us'),
            'description' => __('Contact us block'),
            'render_callback' => 'my_acf_block_render_callback',
            'category' => 'formatting',
            'icon' => 'align-full-width',
            'keywords' => array('Contact', 'Us', 'block'),
        ));
    }
    if (function_exists('acf_register_block')) {
        acf_register_block(array(
            'name' => 'scroll-animation',
            'title' => __('Scroll Animation'),
            'description' => __('Scroll animation front-page'),
            'render_callback' => 'my_acf_block_render_callback',
            'category' => 'formatting',
            'icon' => 'align-full-width',
            'keywords' => array('Scroll', 'animation', 'front'),
        ));
    }
}

// Generic callback function to include “template parts” for our blocks.
function my_acf_block_render_callback($block)
{
    $slug = str_replace('acf/', '', $block['name']);
    // include a template part from within the "blocks" folder
    if (file_exists(get_theme_file_path("/blocks/block-{$slug}.php"))) {
        include(get_theme_file_path("/blocks/block-{$slug}.php"));
    }
}

if ( ! function_exists( 'storefront_homepage_header' ) ) {
	/**
	 * Display the page header without the featured image
	 *
	 * @since 1.0.0
	 */
	function storefront_homepage_header() {
		edit_post_link( __( 'Edit this section', 'storefront' ), '', '', '', 'button storefront-hero__button-edit' );
		?>
		<header class="entry-header">
			<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			?>
		</header><!-- .entry-header -->
		<?php
	}
}

function is_product_in_cart($product_id) {
    // Get cart contents
    $cart = WC()->cart->get_cart();

    // Iterate through cart items
    foreach ($cart as $cart_item_key => $cart_item) {
        // Check if product ID matches
        if ($cart_item['product_id'] == $product_id) {
            return true; // Product found in cart
        }
    }

    return false; // Product not found in cart
}

add_action('wp_ajax_add_to_cart', 'add_to_cart_callback');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart_callback');

function add_to_cart_callback() {
    // Verify nonce
    check_ajax_referer('add_to_cart_nonce', 'nonce');

    // Get product ID and quantity from AJAX request
    $product_id = $_POST['productId'];
    $quantity = $_POST['quantity'];

    // Add product to cart
    WC()->cart->add_to_cart($product_id, $quantity);

    // Return response
    wp_send_json_success('Product added to cart');
}


register_nav_menus(
    apply_filters(
        'storefront_register_nav_menus',
        array(
            'primary'   => __( 'Primary Menu', 'storefront' ),
            'secondary' => __( 'Secondary Menu', 'storefront' ),
            'handheld'  => __( 'Handheld Menu', 'storefront' ),
            'footer'  => __( 'Footer Menu', 'storefront' ),
        )
    )
);
function ms_exists($obj, $key, $result = '')
{
    if (is_array($obj)) {
        $result = array_key_exists($key, $obj) ? $obj[$key] : $result;
    }
    if (is_object($obj)) {
        $result = isset($obj->{$key}) ? $obj->{$key} : $result;
    }
    return $result;
}

function ms_exists_n($obj, $key1, $key2, $key3 = '', $key4 = '')
{
    if ($key4)
        return ms_exists(ms_exists(ms_exists(ms_exists($obj, $key1), $key2), $key3), $key4);
    if ($key3)
        return ms_exists(ms_exists(ms_exists($obj, $key1), $key2), $key3);
    return ms_exists(ms_exists($obj, $key1), $key2);
}

function ms_tree($elements, $paren_id = 0, $args = [])
{
    $result = [];
    global $wp;
    $current_url = $wp->request;
    foreach ($elements as $element) {
        $element = (object)[
            'ID' => $element->ID,
            'parent_id' => $element->menu_item_parent,
            'object_id' => $element->object_id,
            'title' => $element->title,
            'url' => $element->url,
            'target' => $element->target,
            'description' => $element->description,
            'classes' => array_filter($element->classes),
            'is_active' => home_url("/") . $current_url . "/" == $element->url ? "active" : "inactive"
        ];
        if (ms_exists($args, 'fields')) {
            foreach ($args['fields'] as $field)
                $element->{$field} = get_post_meta($element->ID, $field, true);
        }
        $element->args = $args;
        if ($element->parent_id == $paren_id) {
            $children = ms_tree($elements, $element->ID, $args);
            if ($children)
                $element->children = $children;
            foreach ($children as $child) {
                if ($child->is_active == "active") {
                    $element->is_active = "active";
                }
            }
            $result[] = $element;
            unset($element);
        }
    }
    return $result;
}

function ms_getMenuItemes()
{
    $result = ['menu' => [], 'menu_name' => []];
    $locations = get_nav_menu_locations();              // Get menu locations
    // Set menu
    if (is_array($locations) && !empty($locations)) {
        foreach ($locations as $location => $id) {
            $menu_items = wp_get_nav_menu_items($id);
            $menu_object = wp_get_nav_menu_object($id);
            $menu_title = ms_exists($menu_object, 'name');
            $menu_id = ms_exists($menu_object, 'term_id');
            if ($menu_items) {
                $result['menu'][$location] = ms_tree($menu_items, 0);
                $result['menu_name'][$location] = $menu_title;
                $result['menu_id'][$location] = $menu_id;
            }
        }
    }
    return $result;
}

// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

    global $wp_version;
    if ($wp_version !== '4.7.1') {
        return $data;
    }

    $filetype = wp_check_filetype($filename, $mimes);

    return [
        'ext' => $filetype['ext'],
        'type' => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];

}, 10, 4);

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
    echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
}

add_action('admin_head', 'fix_svg');

function allow_svg_upload($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'allow_svg_upload');

// CART OFFCANVAS
add_action('wp_ajax_get_cart_contents', 'get_cart_contents');
add_action('wp_ajax_nopriv_get_cart_contents', 'get_cart_contents');

function get_cart_contents() {
    // Get cart items
    $cart_items = WC()->cart->get_cart();

    // Format cart items
    $formatted_items = array();
    foreach ($cart_items as $cart_item_key => $cart_item) {
        $product_id = $cart_item['variation_id'] > 0 ? $cart_item['variation_id'] : $cart_item['product_id'];
        $product = wc_get_product($product_id);

        $image_id = $product->get_image_id();
        $image_url = wp_get_attachment_image_url($image_id, 'full');

        $formatted_items[] = array(
            'product_id' => $product_id,
            'image_url' => $image_url,
            'product_name' => $product->get_name(),
            'quantity' => $cart_item['quantity'],
            'price' => $product->get_price_html(),
            'description' => $product->get_description(),
            'is_variable' => $product->get_type(), 
            // Add more fields as needed
        );
    }

    // Return cart items as JSON
    wp_send_json($formatted_items);
    wp_die();
}

add_action('wp_ajax_update_cart_quantity', 'update_cart_quantity');
add_action('wp_ajax_nopriv_update_cart_quantity', 'update_cart_quantity');

function update_cart_quantity() {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Get cart items
    $cart_items = WC()->cart->get_cart();
    foreach ($cart_items as $cart_item_key => $cart_item) {
        if ($cart_item['product_id'] == $product_id || $cart_item['variation_id'] == $product_id) {
            WC()->cart->set_quantity($cart_item_key, $quantity, true);
            break;
        }
    }

    wp_send_json(array('success' => true));
    wp_die();
}

add_action('wp_ajax_remove_cart_item', 'remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'remove_cart_item');

function remove_cart_item() {
    $product_id = intval($_POST['product_id']);

    // Get cart items
    $cart_items = WC()->cart->get_cart();
    foreach ($cart_items as $cart_item_key => $cart_item) {
        if ($cart_item['product_id'] == $product_id || $cart_item['variation_id'] == $product_id) {
            $removed_quantity = $cart_item['quantity']; // Get the quantity of the removed item
            WC()->cart->remove_cart_item($cart_item_key);
            break;
        }
    }

    wp_send_json(array('success' => true, 'removed_quantity' => $removed_quantity));
    wp_die();
}


// Function to get cart total
add_action('wp_ajax_get_cart_total', 'get_cart_total');
add_action('wp_ajax_nopriv_get_cart_total', 'get_cart_total'); // For non-logged in users

function get_cart_total() {
    // Get cart total
    $cart_total = WC()->cart->get_cart_total();

    // Return cart total
    echo $cart_total;

    // Don't forget to exit
    wp_die();
}

add_action('wp_ajax_live_search', 'live_search');
add_action('wp_ajax_nopriv_live_search', 'live_search');

function live_search() {
    $search_query = $_POST['search_query'];
    $args = array(
        'post_type' => 'product',
        's' => $search_query,
        'posts_per_page' => 6, // Limit to 3 results
    );
    $query = new WP_Query($args);

    // Buffer the output
    ob_start();

    if ($query->have_posts()) {
        echo '<h4>SUGESTIONS</h4>';
        echo '<div class="search-results-js">';
        while ($query->have_posts()) {
            $query->the_post();
            // Simple results
            echo '<a class="suggested-item" href="' . get_permalink() . '">' . get_the_title() . '</a>';
        }
        echo '</div>';

        echo '<div class="search-products">';
        echo '<h4>SUGGESTED PRODUCTS</h4>';
        echo '<div class="search-products__grid">';
        while ($query->have_posts()) {
            $query->the_post();
            $product_id = get_the_ID();
            $product_permalink = get_permalink($product_id);
            $product_image_url = get_the_post_thumbnail_url($product_id, 'thumbnail'); // Get the product image URL

            // Detailed results
            echo '<a href="' . $product_permalink . '">';
            echo '<img src="' . $product_image_url . '" alt="' . get_the_title($product_id) . '">';
            echo '</a>';
        }
        echo '</div>';
        echo '</div>';

        wp_reset_postdata();
    } else {
        echo '<p>No products found</p>';
    }

    // Capture the output and return it
    $output = ob_get_clean();
    echo $output;
    die();
}

/**
 * Get My Account menu items.
 *
 * @since 2.6.0
 * @return array
 */
function wc_get_account_menu_items_child() {
	$endpoints = array(
		'edit-account'    => get_option( 'woocommerce_myaccount_edit_account_endpoint', 'edit-account' ),
		'orders'          => get_option( 'woocommerce_myaccount_orders_endpoint', 'orders' ),
		'edit-address'    => get_option( 'woocommerce_myaccount_edit_address_endpoint', 'edit-address' ),
		'customer-logout' => get_option( 'woocommerce_logout_endpoint', 'customer-logout' ),
	);

	$items = array(
		'edit-account'    => __( 'Account details', 'woocommerce' ),
		'orders'          => __( 'Orders', 'woocommerce' ),
		'edit-address'    => _n( 'Address', 'Addresses', ( 1 + (int) wc_shipping_enabled() ), 'woocommerce' ),
		'customer-logout' => __( 'Log out', 'woocommerce' ),
	);

	// Remove missing endpoints.
	foreach ( $endpoints as $endpoint_id => $endpoint ) {
		if ( empty( $endpoint ) ) {
			unset( $items[ $endpoint_id ] );
		}
	}

	// Check if payment gateways support add new payment methods.
	if ( isset( $items['payment-methods'] ) ) {
		$support_payment_methods = false;
		foreach ( WC()->payment_gateways->get_available_payment_gateways() as $gateway ) {
			if ( $gateway->supports( 'add_payment_method' ) || $gateway->supports( 'tokenization' ) ) {
				$support_payment_methods = true;
				break;
			}
		}

		if ( ! $support_payment_methods ) {
			unset( $items['payment-methods'] );
		}
	}

	return apply_filters( 'woocommerce_account_menu_items', $items, $endpoints );
}

add_action('init', 'custom_handle_registration');

function custom_handle_registration() {
    if ( isset($_POST['register']) ) {
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $prefix = sanitize_text_field($_POST['prefix']);
        $phone = sanitize_text_field($_POST['phone']);
        $privacy = isset($_POST['privacy']) ? intval($_POST['privacy']) : 0;

        // Basic validation
        if ( ! is_email($email) || empty($password) || $password !== $password2 || !$privacy ) {
            // Handle error
            return;
        }

        // Check if user already exists
        if ( email_exists($email) ) {
            // Handle error
            return;
        }

        // Create user
        $user_id = wp_create_user($email, $password, $email);
        if ( is_wp_error($user_id) ) {
            // Handle error
            return;
        }

        // Set user meta
        wp_update_user(array(
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
        ));

        // Set WooCommerce customer meta
        update_user_meta($user_id, 'billing_prefix', $prefix);
        update_user_meta($user_id, 'billing_phone', $phone);

        // Log user in
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);

        // Redirect or show success message
        wp_redirect(home_url() . "/my-account"); // Redirect to the home page
        exit;
    }
}



// Hook to handle AJAX request to save message and price to order
add_action('wp_ajax_save_message_to_order', 'save_message_to_order_callback');
add_action('wp_ajax_nopriv_save_message_to_order', 'save_message_to_order_callback'); // Allow non-logged in users to use this AJAX action

function save_message_to_order_callback() {
    if (isset($_POST['message']) && isset($_POST['price'])) {
        $message = sanitize_text_field($_POST['message']);
        $price = floatval($_POST['price']);

        // Get current user's shopping cart and update the item
        global $woocommerce;
        $order_id = $woocommerce->cart->get_cart_id();

        // Add message and price as order meta
        update_post_meta($order_id, '_custom_message', $message);
        update_post_meta($order_id, '_custom_price', $price);

        echo 'Message saved successfully.';
    } else {
        echo 'Error: Message or price missing.';
    }

    wp_die(); // Always include this at the end of Ajax functions to terminate script
}


// Display it 
// $order = wc_get_order($order_id);
// $message = get_post_meta($order_id, '_custom_message', true);
// $price = get_post_meta($order_id, '_custom_price', true);

// if ($message && $price) {
//     echo '<h2>Custom Message:</h2>';
//     echo '<p>' . esc_html($message) . '</p>';
//     echo '<h2>Custom Price:</h2>';
//     echo '<p>' . wc_price($price) . '</p>';
// }




?>


