<?php
/**
 * Kusina Theme Functions and Definitions
 */

function kusina_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' ); // Add WooCommerce support
    
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'kusina-ordering' ),
    ) );
}
add_action( 'after_setup_theme', 'kusina_setup' );

function kusina_scripts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900|Lovers+Quarrel', array(), null );
    wp_enqueue_style( 'open-iconic-bootstrap', get_template_directory_uri() . '/css/open-iconic-bootstrap.min.css' );
    wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/css/animate.css' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css' );
    wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/css/owl.theme.default.min.css' );
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css' );
    wp_enqueue_style( 'aos-css', get_template_directory_uri() . '/css/aos.css' );
    wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/css/ionicons.min.css' );
    wp_enqueue_style( 'bootstrap-datepicker', get_template_directory_uri() . '/css/bootstrap-datepicker.css' );
    wp_enqueue_style( 'jquery-timepicker', get_template_directory_uri() . '/css/jquery.timepicker.css' );
    wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/css/flaticon.css' );
    wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/css/icomoon.css' );
    
    wp_enqueue_style( 'kusina-style', get_template_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'kusina-custom-style', get_stylesheet_uri() );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), null, true );
    wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'jquery-stellar', get_template_directory_uri() . '/js/jquery.stellar.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'aos', get_template_directory_uri() . '/js/aos.js', array('jquery'), null, true );
    wp_enqueue_script( 'jquery-animate-number', get_template_directory_uri() . '/js/jquery.animateNumber.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'bootstrap-datepicker', get_template_directory_uri() . '/js/bootstrap-datepicker.js', array('jquery'), null, true );
    wp_enqueue_script( 'jquery-timepicker', get_template_directory_uri() . '/js/jquery.timepicker.min.js', array('jquery'), null, true );
    wp_enqueue_script( 'scrollax', get_template_directory_uri() . '/js/scrollax.min.js', array('jquery'), null, true );
    
    wp_enqueue_script( 'kusina-main', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true );
    wp_enqueue_script( 'kusina-cart', get_template_directory_uri() . '/js/cart.js', array('jquery'), null, true );

    // Localize cart script
    wp_localize_script( 'kusina-cart', 'kusinaData', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'checkout_url' => wc_get_checkout_url(), // Proper WooCommerce Checkout URL
        'home_url' => home_url()
    ) );
}
add_action( 'wp_enqueue_scripts', 'kusina_scripts' );

/**
 * Remove the coupon prompt from the checkout page.
 */
add_action( 'wp', 'kusina_remove_checkout_coupon_prompt' );
function kusina_remove_checkout_coupon_prompt() {
    if ( function_exists( 'is_checkout' ) && is_checkout() ) {
        remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
    }
}

/** 
 * Custom Checkout Fields for WooCommerce - Strict Table Ordering (Name, Phone, Table only)
 */
add_filter( 'woocommerce_checkout_fields' , 'kusina_override_checkout_fields' );
function kusina_override_checkout_fields( $fields ) {
    // 1. Remove ALL billing fields except first_name and phone
    $keep_fields = array('billing_first_name', 'billing_phone');
    foreach( $fields['billing'] as $key => $field ) {
        if ( !in_array($key, $keep_fields) ) {
            unset($fields['billing'][$key]);
        }
    }

    // 2. Remove Order Notes (Additional Info)
    unset($fields['order']['order_comments']);

    // 3. Configure Customer Name (reusing first_name)
    $fields['billing']['billing_first_name']['label'] = __('Customer Name', 'woocommerce');
    $fields['billing']['billing_first_name']['placeholder'] = __('Enter your name', 'woocommerce');
    $fields['billing']['billing_first_name']['priority'] = 10;
    $fields['billing']['billing_first_name']['class'] = array('form-row-wide');

    // 4. Configure Phone Number
    $fields['billing']['billing_phone']['label'] = __('Phone Number', 'woocommerce');
    $fields['billing']['billing_phone']['placeholder'] = __('Enter mobile number', 'woocommerce');
    $fields['billing']['billing_phone']['required'] = true;
    $fields['billing']['billing_phone']['priority'] = 20;
    $fields['billing']['billing_phone']['class'] = array('form-row-wide');

    // 5. Add Table Number
    $fields['billing']['billing_table_number'] = array(
        'label'     => __('Table Number', 'woocommerce'),
        'placeholder'   => __('Enter Table Number', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'clear'     => true,
        'type'      => 'number',
        'priority'  => 5 // Move to the top
    );

    return $fields;
}

/**
 * Handle missing email field (WooCommerce requirement)
 */
add_filter( 'woocommerce_billing_fields', 'kusina_remove_billing_email_validation', 10, 1 );
function kusina_remove_billing_email_validation( $fields ) {
    if(isset($fields['billing_email'])) {
        $fields['billing_email']['required'] = false;
    }
    return $fields;
}

// Ensure email is not checked during checkout process
add_action('woocommerce_checkout_process', 'kusina_dummy_email_if_missing');
function kusina_dummy_email_if_missing() {
    if ( empty( $_POST['billing_email'] ) ) {
        $_POST['billing_email'] = 'table-order@' . parse_url(get_site_url(), PHP_URL_HOST);
    }
}

/**
 * Save Table Number into Order Meta
 */
add_action( 'woocommerce_checkout_update_order_meta', 'kusina_save_table_number' );
function kusina_save_table_number( $order_id ) {
    if ( ! empty( $_POST['billing_table_number'] ) ) {
        update_post_meta( $order_id, '_billing_table_number', sanitize_text_field( $_POST['billing_table_number'] ) );
    }
}

/**
 * Display Custom Fields in Admin Order
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'kusina_display_admin_order_meta', 10, 1 );
function kusina_display_admin_order_meta($order){
    echo '<p><strong>'.__('Table Number').':</strong> ' . get_post_meta( $order->get_id(), '_billing_table_number', true ) . '</p>';
}

/**
 * AJAX Handler for Custom Add to Cart
 */
add_action( 'wp_ajax_kusina_add_to_cart', 'kusina_ajax_add_to_cart_handler' );
add_action( 'wp_ajax_nopriv_kusina_add_to_cart', 'kusina_ajax_add_to_cart_handler' );
function kusina_ajax_add_to_cart_handler() {
    $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
    $quantity = 1;
    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

    if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) ) {
        do_action( 'woocommerce_ajax_added_to_cart', $product_id );
        if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
            wc_add_to_cart_message( array( $product_id => $quantity ), true );
        }
        WC_AJAX::get_refreshed_fragments();
    } else {
        wp_send_json_error();
    }
    wp_die();
}

/**
 * Get Cart Contents via AJAX
 */
add_action( 'wp_ajax_get_cart_contents', 'kusina_get_cart_contents' );
add_action( 'wp_ajax_nopriv_get_cart_contents', 'kusina_get_cart_contents' );
function kusina_get_cart_contents() {
    $cart = WC()->cart->get_cart();
    $items = array();
    foreach ( $cart as $cart_item_key => $cart_item ) {
        $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
        $items[] = array(
            'key'      => $cart_item_key,
            'name'     => $_product->get_name(),
            'price'    => $_product->get_price(),
            'quantity' => $cart_item['quantity'],
            'image'    => get_the_post_thumbnail_url( $product_id, 'thumbnail' )
        );
    }
    wp_send_json_success( array(
        'items' => $items,
        'total' => WC()->cart->get_total('edit'),
        'count' => WC()->cart->get_cart_contents_count()
    ) );
}

/**
 * Remove Item from Cart via AJAX
 */
add_action( 'wp_ajax_remove_item_from_cart', 'kusina_remove_item_from_cart' );
add_action( 'wp_ajax_nopriv_remove_item_from_cart', 'kusina_remove_item_from_cart' );
function kusina_remove_item_from_cart() {
    $cart_item_key = $_POST['cart_item_key'];
    if ( WC()->cart->remove_cart_item( $cart_item_key ) ) {
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}
