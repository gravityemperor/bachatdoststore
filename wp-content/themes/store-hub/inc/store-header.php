<?php
add_action( 'store_hub_header', 'wp_parallax_top_header', 10 );
add_action('store_hub_header','store_hub_header',20);

if( ! function_exists('store_hub_header')){
	function store_hub_header(){

		echo '<div class="store-bottom-header"><div class="wpop-container">';
		do_action('wp_parallax_site_logo');
		?>
		<div class="header-main-left-wrapp">
			<div class="header-main-top">
				<div class="search-wrapp">
					<?php store_hub_search(); ?>
				</div>
				<?php 
				$info_title1 = get_theme_mod('store_hub_header_info_title1');
				$info_value1 = get_theme_mod('store_hub_header_info_value1');
				$info_title2 = get_theme_mod('store_hub_header_info_title2');
				$info_value2 = get_theme_mod('store_hub_header_info_value2');
				if($info_title1 || $info_title2){
				?>
				<div class="contact-info-wrapp">
					<?php if($info_title1){ ?>
					<div class="info info1">
						<div class="info-inner">
							<h4><?php echo esc_html($info_title1);?></h4>
							<span><?php echo esc_html($info_value1);?></span>
						</div>
					</div>
					<?php } if($info_title2){ ?>
					<div class="info info2">
						<div class="info-inner">
							<h4><?php echo esc_html($info_title2);?></h4>
							<span><?php echo esc_html($info_value2);?></span>
						</div>
					</div>
					<?php }?>
				</div>
				<?php }?>
				<?php if( function_exists( 'WC' ) ): ?>
				<div class="header-shop-icons">
					<div class="login-signup">
						<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
						<i class="fa fa-user-o" aria-hidden="true"></i>
						</a>
					</div>
					<?php if(function_exists('yith_wishlist_constructor')){ 
                        $wishlist_page = get_option('yith_wcwl_wishlist_page_id');
                        $link = '#';
                        if( $wishlist_page ) {
                            $link = get_permalink( $wishlist_page );
                        }
						?>
						<div class="wishlist">
							<a href="<?php echo esc_url($link); ?>">
							<i class="fa fa-heart-o" aria-hidden="true"></i>
							</a>
						</div>
					<?php }  
			         $cart_enable = get_theme_mod('wp_parallax_cart_enable','show');
			         $mini_layout = get_theme_mod('wp_parallax_minicart_layout','offcanvas');
			         if ( $cart_enable == 'show' ) { ?>
			         <div class="wpop-shopping-cart <?php echo esc_attr($mini_layout);?>" tabindex="0">
			            <?php 
			            if( function_exists('wp_parallax_shopping_cart')){
			            	wp_parallax_shopping_cart();	
			            }
			            $show_minicart = get_theme_mod('wp_parallax_show_mini_cart','show');
			            $minicart_heading = get_theme_mod('wpparallax_minicart_label',__('Shopping Cart Items','store-hub'));
			            if($show_minicart == 'show' && $mini_layout=='dropdown'){
			            ?>
			            <div class="widget woocommerce widget_shopping_cart">
			                <?php if($minicart_heading){?>
			                <h3><?php echo esc_html($minicart_heading);?></h3>
			                <?php }?>
			                <div class="widget_shopping_cart_content">
			                    <?php woocommerce_mini_cart(); ?>
			                </div>
			            </div>
			            <?php }?>
			        </div>
			        <?php } ?>
				</div>
				<?php endif;?>
			</div>
			<?php wp_parallax_nav(); ?>
		</div>
		</div>
		</div>
		<?php 
	}
}


/**
* Mobile header
*
*/
add_action('store_hub_mob_nav','store_hub_mob_nav');
function store_hub_mob_nav(){

  ?>
  <div class="mob-outer-wrapp">
  <div class="wpop-container clearfix">
    <div class="toggle-wrapp-outer">
    <button class="toggle toggle-wrapp">
	    <span class="toggle-wrapp-inner">
	      <span class="toggle-box">
	      <span class="menu-toggle"></span>
	      </span>
	    </span>
    </button>
    </div>
    <?php do_action('wp_parallax_site_logo'); ?>
	<?php if( function_exists( 'WC' ) ): ?>
	<div class="mob-icons-wrapp">
		
		<div class="login-signup">
			<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
			<i class="fa fa-user-o" aria-hidden="true"></i>
			</a>
		</div>
		<?php if(function_exists('yith_wishlist_constructor')){ 
            $wishlist_page = get_option('yith_wcwl_wishlist_page_id');
            $link = '#';
            if( $wishlist_page ) {
                $link = get_permalink( $wishlist_page );
            }
			?>
			<div class="wishlist">
				<a href="<?php echo esc_url($link); ?>">
				<i class="fa fa-heart-o" aria-hidden="true"></i>
				</a>
			</div>
		<?php } 
        $cart_enable = get_theme_mod('wp_parallax_cart_enable','show');
        $mini_layout = get_theme_mod('wp_parallax_minicart_layout','offcanvas');
        if ( $cart_enable == 'show' ) { ?>
        <div class="wpop-shopping-cart <?php echo esc_attr($mini_layout);?>" tabindex="0">
            <?php 
            if( function_exists('wp_parallax_shopping_cart')){
            	wp_parallax_shopping_cart();	
            }
            
            $show_minicart = get_theme_mod('wp_parallax_show_mini_cart','show');
            $minicart_heading = get_theme_mod('wpparallax_minicart_label',__('Shopping Cart Items','store-hub'));
            if($show_minicart == 'show' && $mini_layout=='dropdown'){
            ?>
            <div class="widget woocommerce widget_shopping_cart">
                <?php if($minicart_heading){?>
                <h3><?php echo esc_html($minicart_heading);?></h3>
                <?php }?>
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
            <?php }?>
        </div>
        <?php } ?>
	</div>
   <?php endif; ?>
  </div>
    <div class="mob-nav-wrapp">
      <button class="toggle close-wrapp toggle-wrapp">
        <span class="text"><?php esc_html_e('Close Menu','store-hub'); ?></span>
        <span class="icon-wrapp"><i class="fa fa-times" aria-hidden="true"></i></span>
      </button>
      <nav  class="avl-mobile-wrapp clear clearfix" arial-label="Mobile" role="navigation" tabindex="1">
        <?php 
        wp_nav_menu( array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'primary-menu',
            'container_class' => 'wpparallax-mob-menu mob-primary-menu',
            'show_toggles'   => true,
        ) ); ?>
      </nav>
    <div class="menu-last"></div>
    </div>
  </div>
<?php
  }