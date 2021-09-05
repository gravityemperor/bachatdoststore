<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package wpparallax
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wpparallax_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$content_style = get_theme_mod('wp_parallax_content_style','plain');
	$classes[] = 'content-'.$content_style;
  
	$sidebar_layout = '';
	if(is_archive() || is_tag() || is_home() || is_author() || is_search()){
		$sidebar_layout = get_theme_mod('archive_page_sidebars_layout','rightsidebar');
	}
	if(is_page()){

		$psidebar_layout = get_post_meta(get_the_ID(),'ultra_sidebar_layout',true);

		if($psidebar_layout == 'default' || $psidebar_layout == ''){
			$sidebar_layout = get_theme_mod('wp_parallax_single_page_sidebars_layout','nosidebar');
	    }else{
	    	$sidebar_layout = $psidebar_layout;
	    }
	} 
	if(is_single()){

		$psidebar_layout = get_post_meta(get_the_ID(),'ultra_sidebar_layout',true);

		if($psidebar_layout == 'default' || $psidebar_layout == ''){
			$sidebar_layout = get_theme_mod('wp_parallax_single_post_sidebars_layout','rightsidebar');
	    }else{
	    	$sidebar_layout = $psidebar_layout;
	    }
	}
	if(class_exists('woocommerce')){
		$classes[] = 'woocommerce';
		if(is_shop() || is_product() || is_product_category() ){
			$sidebar_layout = get_theme_mod('wpparallax_shop_sidebar_layout','nosidebar');
		}
	}

	$classes[] = $sidebar_layout;
	return $classes;
}
add_filter( 'body_class', 'wpparallax_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function wp_parallax_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'wp_parallax_pingback_header' );

/*
** Theme Custom Functions Goes here...
*================================================================================================*/


/*Social Icons */
if(!function_exists('wp_parallax_social_icons')){
	function wp_parallax_social_icons(){
		$fb = get_theme_mod('wp_parallax_Facebook');
		$twet = get_theme_mod('wp_parallax_Twitter');
		$insta = get_theme_mod('wp_parallax_Instagram');
		$pin = get_theme_mod('wp_parallax_Pinterest');
		?>
		<div class="header-icons">
			<ul>
				<?php if($fb){?>
				<li><a href="<?php echo esc_url($fb)?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<?php }?>
				<?php if($twet){?>
				<li><a href="<?php echo esc_url($twet)?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<?php }?>
				<?php if($insta){?>
				<li><a href="<?php echo esc_url($insta)?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
				<?php }?>
				<?php if($pin){?>
				<li><a href="<?php echo esc_url($pin)?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
				<?php }?>														
			</ul>
		</div>
		<?php
	}
}

/*Header Info */

if(!function_exists('wp_parallax_header_info')){
	function wp_parallax_header_info(){
		$contact_no = get_theme_mod('wp_parallax_header_contact');
		$email = get_theme_mod('wp_parallax_header_email');
	    ?>
	    <div class="header-info">
	    	<ul>
	    		<?php if($contact_no):?>
			    	<li>
			    		<i class="fa fa-phone"></i>
			    		<a href="callto:<?php echo esc_attr($contact_no);?>"><?php echo esc_html($contact_no);?></a>
			    	</li>
			        <?php endif; if($email):?>
			        <li>
			        	<i class="fa fa-envelope"></i>
			        	<a href="mailto:<?php echo esc_attr($email);?>"><?php echo esc_html($email);?></a>
			        </li>
		        <?php endif;?>	
	    	</ul>	    	
	    </div>
	    <?php
	}
}

/* Top Header */

if(!function_exists('wp_parallax_top_header')){
	function wp_parallax_top_header(){ 
        $top_header_show = get_theme_mod('wp_parallax_top_header_show','show');
        if($top_header_show == 'show'):
		?>
		<div class="top-header">
			<div class="wpop-container">
				<div class="top-header-wrap clearfix">
					<?php 
					  wp_parallax_header_info();
					  wp_parallax_social_icons();
					?>
				</div>
			</div>
		</div>
		<?php
		endif;
	}
}

/**
* Display site logo
*
*/
add_action('wp_parallax_site_logo','wp_parallax_site_logo');
if( ! function_exists('wp_parallax_site_logo')){
	function wp_parallax_site_logo(){
		?>
		<div class="site-branding">
			<?php
				if ( function_exists( 'the_custom_logo' ) ) {
					the_custom_logo();
				}
			?>
			<div class="as-logo-wrap">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : 
				?>
				<p class="site-description"><?php echo esc_html($description); ?></p>
				<?php endif; ?>
			</div>
		</div><!-- .site-branding -->
		<?php
	}
}
if ( ! function_exists( 'wp_parallax_button_header' ) ) {
	/**
	 * Display Site Branding
	 * @since  1.0.0
	 * @return void
	 */
	function wp_parallax_button_header() { ?>
		<div class="header-wrap">
			<div class="wpop-container">
			    <div class="nav-wrap clearfix">
					<?php do_action('wp_parallax_site_logo'); ?>
	                <?php 
	                wp_parallax_nav();
	                $header_layout = get_theme_mod('wp_parallax_header_layouts','layout1');
	                if($header_layout!='layout2'){
				        $search_enable = get_theme_mod('wp_parallax_search_enable','show');
				        $cart_enable = get_theme_mod('wp_parallax_cart_enable','show');
				        if($search_enable == 'show' || $cart_enable == 'show'){
						  wp_parallax_search_cart();
				        }
			        }
	                ?>
                </div>
			</div>
		</div>
	
	<?php
	}
}


/*Slider function */
if(!function_exists('wp_parallax_slider')){
	function wp_parallax_slider(){	
		$slider_options = get_theme_mod( 'wp_parallax_slider_show','show' );
		if($slider_options == 'show' ){ 
			wp_enqueue_style( 'light-slider' ); 
			wp_enqueue_script( 'light-slider' ); 
			?>
			<ul class="wpop-slider cS-hidden">
				<?php
				    $slider_cat_id = intval( get_theme_mod( 'wp_parallax_slider_cat', '0' ));
				    if( !empty( $slider_cat_id ) ) {
				    $slider_args = array(
				        'post_type' => 'post',
				        'tax_query' => array(
				            array(
				                'taxonomy'  => 'category',
				                'field'     => 'id', 
				                'terms'     => $slider_cat_id                                                                 
				            )),
				        'posts_per_page' => 8
				    );
				    $slider_query = new WP_Query( $slider_args );
				    if( $slider_query->have_posts() ) { while( $slider_query->have_posts() ) { $slider_query->the_post();

				    $image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'wpparallax-slider-image', true );	                          
				?>
				<li class="main-slider">
					<figure>
						<img src="<?php echo esc_url($image_path[0]); ?>" alt="<?php the_title_attribute(); ?>"/>
					</figure>
					<div class="banner-slider-info">
						<h2 class="caption-title wow fadeInUp" data-wow-duration="0.7s">										
							<?php
                             the_title();
							?>
						</h2>
						<div class="caption-content wow fadeInUp" data-wow-duration="0.7s">
							<?php echo esc_attr(wp_trim_words( get_the_content(), 10)); ?>
						</div>
						<a class="slider-button wow fadeInRight" data-wow-duration="0.7s" href="<?php the_permalink(); ?>">
							<?php echo esc_html__('View More','wpparallax'); ?>
						</a>								
					</div>
				</li>
				<?php  } } wp_reset_postdata();  } ?> 
			</ul>
			<?php
        }
    }
}

/*breadcrumb */

if(!function_exists('wp_parallax_header_banner_x')){
function wp_parallax_header_banner_x() {
    $p_bread_enable = get_post_meta(get_the_ID(),'ultra_page_title_banner',true);
    $breadcrumb_enable = get_theme_mod('wp_parallax_breadcrumb_section_option','show');
    if($breadcrumb_enable=='show' && !is_page_template( 'tmpl-home.php' ) && $p_bread_enable!='off'):
        $title_position = get_post_meta(get_the_ID(),'ultra_page_title_position',true);
        if(empty($title_position)){
            $title_position = get_theme_mod('wp_parallax_bread_title_position','left');
        }
        $overlay = get_theme_mod('wp_parallax_breadcrumb_overlay','show');
        if($overlay == 'show'){
        	$title_position .= ' overlay';
        }
        ?>
            <div class="header-banner-container <?php echo esc_attr($title_position);?>">
                <div class="wpop-container">
                    <div class="page-title-wrap">
                        <?php
                            if( is_home() ){

                                $title =  get_option('page_for_posts');
                                if($title){
                                    echo '<h1 class="page-title">'.  wp_kses_post(get_the_title($title)).'</h1>' ;
                                }else{
                                    echo '<h1 class="page-title">'.esc_html__('Blog','wpparallax').'</h1>';
                                }    
                            }elseif(is_archive()) {
                                the_archive_title( '<h1 class="page-title">', '</h1>' );
                            } elseif(is_single() || is_singular('page')) {
                                wp_reset_postdata();
                                $custom_title = get_post_meta(get_the_ID(),'ultra_page_custom_title',true);
                                $custom_subtitle =  get_post_meta(get_the_ID(),'ultra_page_custom_subtitle',true);
                                if($custom_title){
                                    echo '<h1 class="page-title">'.esc_html($custom_title).'</h1>';
                                }else{
                                    the_title('<h1 class="page-title">', '</h1>');
                                }
                                if($custom_subtitle){
                                    echo '<p>'.wp_kses_post($custom_subtitle).'</p>';
                                }
                            } elseif(is_search()) {
                                ?>
                                <h1 class="page-title"><?php printf(esc_html__( 'Search Results for: %s', 'wpparallax' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                                <?php
                            } elseif(is_404()) {
                                ?>
                                <h1 class="page-title"><?php esc_html_e( '404 Error', 'wpparallax' ); ?></h1>
                                <?php
                            }elseif(is_product()){
                            	the_title( '<h1 class="page-title">', '</h1>' );

                            }else{
                            	the_archive_title( '<h1 class="page-title">', '</h1>' );
                            }
	                        $bread_show = get_post_meta(get_the_ID(),'ultra_page_breadcrumb_show',true);
	                        if($bread_show != 'off'){  
	                        	if(class_exists('woocommerce') && is_woocommerce()){
							        $seperator = get_theme_mod('wp_parallax_breadcrumb_delimiter','>>');
							        $args = array( 'delimiter' => '<span class="delimiter">'.esc_attr($seperator).'</span>' );
							        woocommerce_breadcrumb( $args );
	                        	}else{
	                        		wp_parallax_breadcrumbs();
	                        	}
	                        }	    
                        ?>
                    </div>
                </div>
            </div>
        <?php
    endif;
}
}

/**
 * Footer Section Function Area
**/

if ( ! function_exists( 'wp_parallax_footer_widgets' ) ) {
	/**
	 * Display the theme footer widgets
	 * @since  1.0.0
	 * @return void
	 */
	function wp_parallax_footer_widgets() {

        if ( is_active_sidebar( 'footer-4' ) ) {
			$widget_columns = apply_filters( 'wp_parallax_footer_widget_regions', 4 );		
        } elseif ( is_active_sidebar( 'footer-3' ) ) {
			$widget_columns = apply_filters( 'wp_parallax_footer_widget_regions', 3 );
		} elseif ( is_active_sidebar( 'footer-2' ) ) {
			$widget_columns = apply_filters( 'wp_parallax_footer_widget_regions', 2 );
		} elseif ( is_active_sidebar( 'footer-1' ) ) {
			$widget_columns = apply_filters( 'wp_parallax_footer_widget_regions', 1 );
		} else {
			$widget_columns = apply_filters( 'wp_parallax_footer_widget_regions', 0 );
		}

		if ( $widget_columns > 0 ) : ?>

			<section class="footer-widgetswrap col-<?php echo intval( $widget_columns ); ?> clearfix">				
				<div class="top-footer-wrap">
					<div class="wpop-container clearfix">
						<?php $i = 0; while ( $i < $widget_columns ) : $i++; ?>		
							<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>		
								<div class="block footer-widget wow fadeInRight">
						        	<?php dynamic_sidebar( 'footer-' . intval( $i ) ); ?>
								</div>		
					        <?php endif; ?>		
						<?php endwhile; ?>
					</div>
				</div>
			</section><!-- .footer-widgets  -->
	    <?php endif;
	}
}

if(! function_exists('wp_parallax_footer_info')){
	function wp_parallax_footer_info(){
		$footer_copyright = get_theme_mod('wp_parallax_footer_text');
		$footer_copyright = strtr($footer_copyright, array("[year]"=>date('Y'), "[site_title]"=>get_bloginfo()));
		?>
		<div class="footer-left wow fadeInLeft">
			<?php if( !empty( $footer_copyright ) ) { ?>
				<?php echo wp_kses_post(apply_filters( 'wp_parallax_copyright_text', $footer_copyright )); ?>	
			<?php } ?>

			<?php if ( apply_filters( 'wp_parallax_credit_link', true ) ) { 
				printf( esc_html__( '%1$s By %2$s', 'wpparallax' ), ' ', '<a href=" ' . esc_url('https://wpoperation.com/') . ' " rel="designer" target="_blank">WPoperation</a>' ); ?>
			<?php }?>
		</div><!-- .footer-left -->			
		<?php
	}
}

if ( ! function_exists( 'wp_parallax_credit' ) ) {
	/**
	 * Display the theme credit/button footer
	 * @since  1.0.0
	 * @return void
	 */
	function wp_parallax_credit() {
		$footer_social = get_theme_mod('wp_parallax_footer_icon_show','show');
		
		?>
			<div class="bottom-footer">	
				<div class="wpop-container clearfix">
                      <?php  wp_parallax_footer_info();?>
					<div class="footer-right wow fadeInRight">
						<?php 
						if($footer_social=='show'){
                          wp_parallax_social_icons();
						}
						?>
					</div>
				</div>
			</div>			
		<?php
	}
}


/**
 * Add a Sub Nav Toggle to the Expanded Menu and Mobile Menu.
 *
 * @param stdClass $args An array of arguments.
 * @param string   $item Menu item.
 * @param int      $depth Depth of the current menu item.
 *
 * @return stdClass $args An object of wp_nav_menu() arguments.
 * 
 * @since 1.2.7
 */
function wp_parallax_add_sub_toggles_to_main_menu( $args, $item, $depth ) {


    // Add sub menu toggles to the Expanded Menu with toggles.
    if ( isset( $args->show_toggles ) && $args->show_toggles ) {

        
        $args->after  = '';

        // Add a toggle to items with children.
        if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

            $toggle_target_string = '.menu-modal .menu-item-' . $item->ID . ' > .sub-menu';
            $toggle_duration      = 50;

            // Add the sub menu toggle.
            $args->after .= '<button class="toggle sub-toggle sub-menu-toggle"><span class="screen-reader-text">' . __( 'Show sub menu', 'wpparallax' ) . '</span> <i class="fa fa-angle-down" aria-hidden="true"></i></button>';

        }

    } 

    return $args;

}

add_filter( 'nav_menu_item_args', 'wp_parallax_add_sub_toggles_to_main_menu', 10, 3 );

