<?php

/**
 * Query WooCommerce activation
 * @since  1.0.0
 */
if ( ! function_exists( 'wp_parallax_is_woocommerce_activated' ) ) {
    function wp_parallax_is_woocommerce_activated() {
        return class_exists( 'woocommerce' ) ? true : false;
    }
}

/**
* Parallax sections Layouts
*
*/
if(!function_exists('wp_parallax_section_layouts')){
	function wp_parallax_section_layouts(){
		$layouts = array(
            'about'=> esc_html__('About Layout','wpparallax'),
            'service'=> esc_html__('Service Layout','wpparallax'),
            'portfolio'=> esc_html__('Portfolio Layout','wpparallax'),
            'testimonial'=> esc_html__('Testimonial Layout','wpparallax'),
            'team'=> esc_html__('Team Layout','wpparallax'),
            'blog'=> esc_html__('Blog Layout','wpparallax'),
            'callto'=> esc_html__('Call to Action','wpparallax'),
            'map'=> esc_html__('Google Map','wpparallax')
        );
		return $layouts;
	}
}
/**
* Parallax Menu
*
*/
function wp_parallax_get_parallax_sections() {
	$wpparallax_homepage = get_theme_mod('wp_parallax_homepage');
	$values = json_decode($wpparallax_homepage);
    if($values!=''){
       foreach( $values as $value):
           $page_id = $value->wp_parallax_page;
           $menu_name = $value->wp_parallax_menu_text;
           $enabled_section[] = array(
            'id' => 'section-' . $page_id,
            'menu_text' => $menu_name,
        );
       endforeach;
       return $enabled_section;
   }
}

/**
* Mobile navigation
*
*/
add_action('wp_parallax_mob_nav','wp_parallax_mob_nav',10);
if(! function_exists('wp_parallax_mob_nav')){
  function wp_parallax_mob_nav(){

  ?>
  <div class="mob-outer-wrapp">
  <div class="container clearfix">
    
    <button class="toggle toggle-wrapp">
    <span class="toggle-wrapp-inner">
      <span class="toggle-box">
      <span class="menu-toggle"></span>
      </span>
    </span>
    </button>
    
  </div>
    <div class="mob-nav-wrapp">
      <button class="toggle close-wrapp toggle-wrapp">
        <span class="text"><?php esc_html_e('Close Menu','wpparallax'); ?></span>
        <span class="icon-wrapp"><i class="fa fa-times" aria-hidden="true"></i></span>
      </button>
      <nav  class="avl-mobile-wrapp clear clearfix" arial-label="Mobile" role="navigation" tabindex="1">
        <?php 
          $wpparallax_plx_menu_enable = get_theme_mod('wp_parallax_menu_type');
          if( $wpparallax_plx_menu_enable == 'hide' ){ ?>
          <div class="wpparallax-mob-menu mob-primary-menu">
          <ul id="primary-menu" class="nav plx-nav menu">
           <li class="current">
               <a href="<?php echo esc_url(home_url()); ?>/#plx-slider-section" >
                   <?php esc_html_e('Home', 'wpparallax'); ?>
               </a>
           </li>
           <?php
           $wpparallax_enabled_sections = wp_parallax_get_parallax_sections('menu');
            if($wpparallax_enabled_sections!=''){
               foreach ($wpparallax_enabled_sections as $wpparallax_enabled_section) : ?>
               <?php if($wpparallax_enabled_section['menu_text'] != '') : ?>
                   <li>
                       <a href="<?php echo esc_url(home_url()); ?>/#<?php echo esc_attr($wpparallax_enabled_section['id']) ?>" >
                           <?php  echo esc_attr($wpparallax_enabled_section['menu_text']); ?>
                       </a>
                   </li>
               <?php endif; ?>
               <?php
               endforeach; }?>
           </ul>
            </div>
           <?php        
       }else{ 
        wp_nav_menu( array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'primary-menu',
            'container_class' => 'wpparallax-mob-menu mob-primary-menu',
            'show_toggles'   => true,
        ) );
        } ?>
      </nav>
    <div class="menu-last"></div>
    </div>
  </div>
<?php
  }
}

/*Get nav menu */

if(!function_exists('wp_parallax_nav')){
	function wp_parallax_nav(){
		?>
       <nav id="site-navigation" class="main-navigation">
          <!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i></button> -->
          <?php do_action('wp_parallax_mob_nav'); ?>
          <?php
          $wpparallax_plx_menu_enable = get_theme_mod('wp_parallax_menu_type');
          if( $wpparallax_plx_menu_enable == 'hide' ){ ?>
          <ul class="nav plx-nav">
           <li class="current">
               <a href="<?php echo esc_url(home_url()); ?>/#plx-slider-section" >
                   <?php esc_html_e('Home', 'wpparallax'); ?>
               </a>
           </li>
           <?php
           $wpparallax_enabled_sections = wp_parallax_get_parallax_sections('menu');
           if($wpparallax_enabled_sections!=''){
               foreach ($wpparallax_enabled_sections as $wpparallax_enabled_section) : ?>
               <?php if($wpparallax_enabled_section['menu_text'] != '') : ?>
                   <li>
                       <a href="<?php echo esc_url(home_url()); ?>/#<?php echo esc_attr($wpparallax_enabled_section['id']) ?>" >
                           <?php  echo esc_attr($wpparallax_enabled_section['menu_text']); ?>
                       </a>
                   </li>
               <?php endif; ?>
               <?php
               endforeach; }?>
           </ul>
           <?php        
       }else{			
         wp_nav_menu( array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'primary-menu',
            'container_class' => 'wpparallax-main-menu'
        ) );
     }
     $header_layout = get_theme_mod('wp_parallax_header_layouts','layout1');
     if($header_layout=='layout2'){
        $search_enable = get_theme_mod('wp_parallax_search_enable','show');
        $cart_enable = get_theme_mod('wp_parallax_cart_enable','show');
        if($search_enable == 'show' || $cart_enable == 'show'){
          wp_parallax_search_cart();
      }
  }
  ?>
</nav><!-- #site-navigation -->
<?php
}
}

if(!function_exists('wp_parallax_search_cart')){
	function wp_parallax_search_cart(){
		?>
        <div class="search-cart-wrap clearfix">

         <?php 
         $cart_enable = get_theme_mod('wp_parallax_cart_enable','show');
         if ( wp_parallax_is_woocommerce_activated() && $cart_enable == 'show' ) { ?>
         <div class="wpop-shopping-cart" tabindex="0">
            <?php 
            wp_parallax_shopping_cart();
            $show_minicart = get_theme_mod('wp_parallax_show_mini_cart','show');
            $minicart_heading = get_theme_mod('wpparallax_minicart_label',__('Shopping Cart Items','wpparallax'));
            if($show_minicart == 'show'){
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
        <?php }
        $search_enable = get_theme_mod('wp_parallax_search_enable','show');
        if($search_enable == 'show'){?>
        <div class="search-wrap">
            <div class="search-icon">
            <button class="btn-transparent">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <path d="M508.875,493.792L353.089,338.005c32.358-35.927,52.245-83.296,52.245-135.339C405.333,90.917,314.417,0,202.667,0
                            S0,90.917,0,202.667s90.917,202.667,202.667,202.667c52.043,0,99.411-19.887,135.339-52.245l155.786,155.786
                            c2.083,2.083,4.813,3.125,7.542,3.125c2.729,0,5.458-1.042,7.542-3.125C513.042,504.708,513.042,497.958,508.875,493.792z
                             M202.667,384c-99.979,0-181.333-81.344-181.333-181.333S102.688,21.333,202.667,21.333S384,102.677,384,202.667
                            S302.646,384,202.667,384z"/>
                </svg>
                </button>             
           </div>
       </div>
       <?php }
       $button_text = get_theme_mod('wp_parallax_header_button_text','Contact Us');
       $button_link = get_theme_mod('wp_parallax_header_button_link');
       $target = get_theme_mod('wp_parallax_header_button_target','1');
       if($button_text){
       ?>
       <div class="header-button">
            <a href="<?php echo esc_url($button_link);?>" <?php if($target ==1){?>target="_blank"<?php }?>><?php echo esc_html($button_text);?></a>
       </div>      
       <?php }?>   
   </div><!-- .search-cart-wrap-->				
   <?php
}
}

/*===========================================================================================================*/
/**
 * Function for section title
 */

if(!function_exists('wp_parallax_section_title')){
	function wp_parallax_section_title($title){
		?>
        <div class="section-title-wrap wow fadeInUp">
            <h2 class="section-title">
                <?php echo esc_html($title); ?>
            </h2>
        </div>
        <?php
    }
}

/* Single Post Formats */
if( !function_exists('wp_parallax_post_formats') ){
    function wp_parallax_post_formats(){
        global $post;
        $format = get_post_format();
        $post_audio_url = get_post_meta( $post->ID, 'post_embed_audio_url', true );
        $post_video_url = get_post_meta( $post->ID, 'post_embed_video_url', true );
        $post_images_url = get_post_meta( $post->ID, 'post_images', true );
        if($format == 'video' && !empty($post_video_url) ){
            wp_enqueue_script('fitvids');
            ?>
            <div class="wpparallax_video_wrap">
                <?php echo wp_oembed_get( esc_url($post_video_url) ); // WPCS: XSS OK. ?>
            </div>
        <?php 
        }else if($format == 'audio' && !empty($post_audio_url)){
            wp_enqueue_script('fitvids');
            ?>
            <div class="wpparallax_audio_wrap">
                <?php echo wp_oembed_get( esc_url($post_audio_url) ); // WPCS: XSS OK. ?>
            </div>
        <?php 
        }else if($format == 'gallery' && !empty($post_images_url)){ 
            wp_enqueue_style('light-slider');
            wp_enqueue_script('light-slider');
            ?>
            <div class="post-gallery-wrapper">
                <ul class="wpparallax-gallery-items">
                    <?php 
                        foreach ( $post_images_url as $image_url) {
                    ?>
                        <li><img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr__('gallery-images','wpparallax');?>"/></li>
                    <?php
                        }
                    ?>
                </ul>
            </div><!-- .post-gallery-wrapper -->
            <?php 
        } else{
        ?>
        <div class="wp-img">
            <?php the_post_thumbnail('full');?>
        </div> 
        <?php 
        } 
    }
}


if(!function_exists('wpparallax_title_banner_styles')){
    function wpparallax_title_banner_styles(){
        $b_color = get_theme_mod('wp_parallax_breadcrumb_bg_color');
        $b_image = get_theme_mod('wp_parallax_breadcrumb_image');
        $b_height = get_theme_mod('wp_parallax_banner_height',300);
        $text_color = get_theme_mod('wp_parallax_breadcrumb_text_color');

        $bp_bgcolor = get_post_meta(get_the_ID(),'ultra_page_banner_bg_color',true);
        $bp_image = get_post_meta(get_the_ID(),'ultra_page_banner_bg_image',true);
        if(!empty($bp_image)){
            $bp_image = wp_get_attachment_image_url($bp_image,'large');
        }
        $bp_height = get_post_meta(get_the_ID(),'ultra_page_banner_height',true);

        $bg_styles = array(
            'b-color' => !empty($bp_bgcolor) ? $bp_bgcolor : $b_color,
            'b-image' => !empty($bp_image) ? $bp_image : $b_image,
            'b-height' => !empty($bp_height) ? $bp_height : $b_height,
            't-color' => $text_color,
        );

        return $bg_styles;
    }
}


/*===========================================================================================================*/
/**
 * Function for Breadcrumb
 */
function wp_parallax_breadcrumbs() {
    $show_bread = get_theme_mod('wp_parallax_breadcrumb_enable','show');
    if($show_bread!='show'){
      return;
    }
    global $post;
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

    $delimiter = get_theme_mod('wp_parallax_breadcrumb_delimiter','>>');

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $homeLink = esc_url( home_url() );

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1)
            echo '<div id="wpparallax-breadcrumb"><a href="' . esc_url($homeLink) . '">' . esc_attr__('Home', 'wpparallax') . '</a></div></div>';
    } else {

        echo '<div id="wpparallax-breadcrumb"><a href="' . esc_url($homeLink) . '">' . esc_attr__('Home', 'wpparallax') . '</a> ' . esc_attr($delimiter) . ' ';

        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0)
                echo get_category_parents($thisCat->parent, TRUE, ' ' . esc_attr($delimiter) . ' ');
            echo '<span class="current">' . esc_html__('Archive by category','wpparallax').' "' . single_cat_title('', false) . '"' . '</span>';
        } elseif (is_search()) {
            echo '<span class="current">' . esc_html__('Search results for','wpparallax'). '"' . get_search_query() . '"' . '</span>';
        } elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . esc_attr($delimiter) . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . esc_attr($delimiter) . ' ';
            echo '<span class="current">' . get_the_time('d') . '</span>';
        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . esc_attr($delimiter) . ' ';
            echo '<span class="current">' . get_the_time('F') . '</span>';
        } elseif (is_year()) {
            echo '<span class="current">' . get_the_time('Y') . '</span>';
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . esc_url($homeLink) . '/' . esc_attr($slug['slug']) . '/">' . esc_attr($post_type->labels->singular_name) . '</a>';
                if ($showCurrent == 1)
                    echo ' ' . esc_attr($delimiter) . ' ' . '<span class="current">' . get_the_title() . '</span>';
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                if ($showCurrent == 0)
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                echo wp_parallax_sanitize_breadcrumb($cats);
                if ($showCurrent == 1)
                    echo '<span class="current">' . get_the_title() . '</span>';
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo '<span class="current">' . esc_attr($post_type->labels->singular_name) . '</span>';
        } elseif (is_attachment()) {
            if ($showCurrent == 1) echo ' ' . '<span class="current">' . get_the_title() . '</span>';
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1)
                echo '<span class="current">' . get_the_title() . '</span>';
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo wp_parallax_sanitize_breadcrumb($breadcrumbs[$i]);
                if ($i != count($breadcrumbs) - 1)
                    echo ' ' . esc_attr($delimiter). ' ';
            }
            if ($showCurrent == 1)
                echo ' ' . esc_attr($delimiter) . ' ' . '<span class="current">' . get_the_title() . '</span>';
        } elseif (is_tag()) {
            echo '<span class="current">' . esc_attr__('Posts tagged','wpparallax').' "' . single_tag_title('', false) . '"' . '</span>';
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo '<span class="current">' . esc_attr__('Articles posted by ','wpparallax'). esc_attr($userdata->display_name) . '</span>';
        } elseif (is_404()) {
            echo '<span class="current">' . 'Error 404' . '</span>';
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo esc_attr__('Page', 'wpparallax') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</div>';
    }
}


/* Get all registered sidebars */
if(!function_exists('wpparallax_get_sidebars')){
    function wpparallax_get_sidebars(){
        global $wp_registered_sidebars;
        $registered_sidebars = array();
        foreach ( $wp_registered_sidebars as $sidebars ) {
            $registered_sidebars[$sidebars['id']] = $sidebars['name'];
        }
        return $registered_sidebars;
    }
}


/* Get Elementor Templates */
if(!function_exists('wpparallax_get_elementor_templates')){
    function wpparallax_get_elementor_templates( $type = '' ) {
        $args = [
            'post_type'         => 'elementor_library',
            'posts_per_page'    => -1,
            'post_status' => 'publish'
        ];

        if ( $type ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'elementor_library_type',
                    'field'    => 'slug',
                    'terms' => $type,
                ]
            ];
        }

        $page_templates = get_posts( $args );

        $options = array();
        $options[''] = __('Select Template','wpparallax');
        if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
            foreach ( $page_templates as $post ) {
                $options[ $post->ID ] = $post->post_title;
            }
        }
        return $options;
    }
}


/**
* Retrieve post meta and default value of metabox
* 
*/
function wp_parallax_get_post_meta( $key, $defaults = '' ){
  global $post;

  if(! $post )
    return;
    
    $default = $defaults;
    $meta_val =  get_post_meta( $post->ID, $key , true ); 

    if( empty($meta_val) && ($defaults != '') ){
        $meta_val = $default;
    }

    return $meta_val;

}