<?php 

/**
 * Functions for product listing page
 *
 * @package Store Hub
 */

/**
 * ===========================================
 * Product Image and hover icons modifications
 * ===========================================
 */


add_action( 'wpparallax_product_icons', 'store_hub_extra_icon', 15 );
function store_hub_extra_icon() {
    echo '<span class="icons">';
    global $product, $post;
    $current_product = $product;
    $product_id = $current_product->get_id();
    $product_type = $current_product->get_type();
    if( function_exists('yith_wishlist_constructor') ) {

        echo '<a href="'.esc_url( add_query_arg( 'add_to_wishlist', $product_id ) ) .'" class="add_to_wishlist single_add_to_wishlist"  rel="nofollow" data-product-id="'.esc_attr($product_id) .'" data-original-product-id="'.esc_attr($product_id) .'" data-product-type="'.esc_attr($product_type).'">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 412.735 412.735" style="enable-background:new 0 0 412.735 412.735;" xml:space="preserve">
            <path d="M295.706,35.522C295.706,35.522,295.706,35.522,295.706,35.522c-34.43-0.184-67.161,14.937-89.339,41.273
                c-22.039-26.516-54.861-41.68-89.339-41.273C52.395,35.522,0,87.917,0,152.55C0,263.31,193.306,371.456,201.143,375.636
                c3.162,2.113,7.286,2.113,10.449,0c7.837-4.18,201.143-110.759,201.143-223.086C412.735,87.917,360.339,35.522,295.706,35.522z
                 M206.367,354.738C176.065,336.975,20.898,242.412,20.898,152.55c0-53.091,43.039-96.131,96.131-96.131
                c32.512-0.427,62.938,15.972,80.457,43.363c3.557,4.905,10.418,5.998,15.323,2.44c0.937-0.68,1.761-1.503,2.44-2.44
                c29.055-44.435,88.631-56.903,133.066-27.848c27.202,17.787,43.575,48.114,43.521,80.615
                C391.837,243.456,236.669,337.497,206.367,354.738z"/>

            </svg>
        </a>';
    }

    if( function_exists('yith_woocompare_constructor') ) {
        $args = array(
            'action' => 'yith-woocompare-add-product',
            'id' => $product_id
        );

        $lang = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : false;
        if( $lang ) {
            $args['lang'] = $lang;
        }
        $url = esc_url_raw( add_query_arg( $args, home_url() ) );
        echo '<a href="'.esc_url($url).'" data-product_id="'.esc_attr($product_id).'" class="compare"><i class="pe-7s-shuffle">oo</i></a>';
    }

    if( function_exists('yith_wcqv_init') ) {
        echo '<a href="#" class="yith-wcqv-button" data-product_id="'.esc_attr($product_id).'">
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
        <path d="M447.615,64.386C406.095,22.866,350.892,0,292.175,0s-113.92,22.866-155.439,64.386
            C95.217,105.905,72.35,161.108,72.35,219.824c0,53.683,19.124,104.421,54.132,144.458L4.399,486.366
            c-5.864,5.864-5.864,15.371,0,21.236C7.331,510.533,11.174,512,15.016,512s7.686-1.466,10.617-4.399l122.084-122.083
            c40.037,35.007,90.775,54.132,144.458,54.132c58.718,0,113.919-22.866,155.439-64.386c41.519-41.519,64.385-96.722,64.385-155.439
            S489.134,105.905,447.615,64.386z M426.379,354.029c-74.001,74-194.406,74-268.407,0c-74-74-74-194.407,0-268.407
            c37.004-37.004,85.596-55.5,134.204-55.5c48.596,0,97.208,18.505,134.204,55.5C500.378,159.621,500.378,280.028,426.379,354.029z"
            />
        </svg>

        </a>';
    }
    echo '</span>';

}


/**=====================================
* For Image Flip 
*=======================================*/
function store_hub_remove_default_image(){
    remove_action( 'woocommerce_before_shop_loop_item_title','wpparallax_product_wrap', 10 );
}
add_action('init','store_hub_remove_default_image');
add_action ( 'woocommerce_before_shop_loop_item_title', 'store_hub_product_thumb_wrapp',10);

if( ! function_exists('store_hub_product_thumb_wrapp') ){
    function store_hub_product_thumb_wrapp(){
        $is_flip = get_theme_mod('shop_image_flip','true');
        $gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);
        if($gallery == '' || $is_flip == false){
            $class = 'no-flip';
        }else{
            $class = 'flip';
        }
        $size = 'shop_catalog';
        echo '<div class="store-thumb-wrapp '.esc_attr($class).'">';
        echo '<div class="store-img-before">';
        echo woocommerce_template_loop_product_thumbnail($size);
        echo '</div>';
        if($is_flip == true){
            store_hub_product_thumbnail_hover();
        }
        echo '</div>';
    }
    
}
function store_hub_product_thumbnail_hover() {

    $change_hover_image = true;
    if( ! $change_hover_image )
        return;
    
    $id = get_the_ID();
    $size = 'shop_catalog';
    $gallery = get_post_meta($id, '_product_image_gallery', true);
    $attachment_image = '';
    if (!empty($gallery) && $change_hover_image ) {
        $gallery = explode(',', $gallery);

        if ( $change_hover_image ) {
            $first_image_id = $gallery[0];
                $attachment_image = wp_get_attachment_image($first_image_id , $size, false, array('class' => 'hover-image'));
        }

        echo '<div class="store-img-after'.(($attachment_image)?' img-effect':'').'">';
        // show images
        echo wp_kses_post($attachment_image);
        echo '</div>';
    }
}

//Off Canvas Cart
add_action('wp_parallax_before_footer','store_hub_offcanvas_cart',0);
function store_hub_offcanvas_cart(){
     $cart_enable = get_theme_mod('wp_parallax_show_mini_cart','show');
     $mini_layout = get_theme_mod('wp_parallax_minicart_layout','offcanvas');
     $minicart_heading = get_theme_mod('wpparallax_minicart_label',__('Shopping Cart Items','store-hub'));
    if($cart_enable == 'show' && $mini_layout=='offcanvas'){
        ?>
        <div class="off-canvas-cart">
            <a href="javascript:void(0)" class="off-canvas-close"></a>
            <div class="shopping-list-wrap">
                <?php if($minicart_heading){?>
                <h3><?php echo esc_html($minicart_heading);?></h3>
                <?php }?>
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        </div>
        <?php
    }
}
