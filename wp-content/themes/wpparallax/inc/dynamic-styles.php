<?php
function wpparallax_dynamic_styles(){

    $output_css = '';

    /* Theme Container */
    $container_width = get_theme_mod('wp_parallax_container_width',1190);
    if($container_width){
        $output_css .= ".wpop-container{ max-width: {$container_width}px;}";
    }

    /* Banner Styles */
    $banner_styles = wpparallax_title_banner_styles();
    $b_image = $banner_styles['b-image'];
    $b_height = $banner_styles['b-height'];
    $b_bg = $banner_styles['b-color'];
    $b_text = $banner_styles['t-color'];
    $output_css .= '.header-banner-container{';
    if($b_image){ 
        $output_css .= 'background-image: url('.esc_url($b_image).');';
    }
    if($b_bg){ 
        $output_css .= "background-color: $b_bg;";
    }
    if($b_height){
        $output_css .= "min-height: {$b_height}px;";
    }
    $output_css .= '}';

    if($b_text){
        $output_css .= ".header-banner-container .page-title,#wpparallax-breadcrumb .current,.woocommerce .woocommerce-breadcrumb,.woocommerce .woocommerce-breadcrumb a{ color: $b_text; }";
    }


    /**
    * Theme Color 
    */    
    $theme_color = get_theme_mod('wp_parallax_theme_color');
    if($theme_color!=''){
    $output_css .= "
            section:hover .section-title:nth-child(even), section:focus .section-title:nth-child(even), .about a.read-more, .service-list .service-detail h3 a:hover, .blog-section .blogsinfo .blog-info a:hover,
            .blog-section .blog-info ul li a:hover span, .footer-widgetswrap .block.footer-widget ul a:hover, .bottom-footer .footer-right ul a:hover, .content-blog .main-blog-right .btn-readmore a:after, .content-blog .main-blog-right .title-text:hover,
            .content-blog .main-blog-right .btn-readmore a:hover, .content-blog .main-blog-right .metadata li:hover a, .pagination .current, .nav-links a:hover,.backtohome a:hover, .comment-wrapper .media-heading a,
            .content-blog .metadata .comment:hover, .comment-left a:hover, a.read-more,
            .comment-left a:hover:before, input[type=submit].woocommerce-Button:hover, 
            .comment-wrapper .media-body a:hover, .widget-area ul li:hover > a,
            .widget_recent_entries ul li:hover > a,
            .widget_pages ul li:hover > a,
            .widget_meta ul li:hover > a,
            .widget_archive ul li:hover > a,
            .widget_categories ul li:hover > a,
            .widget_nav_menu ul li:hover > a,
            .widget_recent_comments ul li:hover > a,
            .widget_recent_comments ul li .comment-author-link:hover a, .widget-area ul li:hover > a:before,
            .widget_recent_entries ul li:hover > a:before,
            .widget_pages ul li:hover > a:before,
            .widget_meta ul li:hover > a:before,
            .widget_archive ul li:hover > a:before,
            .widget_categories ul li:hover > a:before,
            .widget_nav_menu ul li:hover > a:before,#wpparallax-breadcrumb a,.woo-desc-wrap h2:hover,.woocommerce .woocommerce-breadcrumb a
            {
             color: $theme_color;
            }
            .button, input[type='button'], input[type='reset'], input[type='submit'], .full-search-container .search-form .search-submit, .full-search-container .closebtn, a.slider-button:hover, #plx-slider-section .lSSlideOuter .lSPager.lSpg > li:hover a, 
            #plx-slider-section .lSSlideOuter .lSPager.lSpg > li.active a, .section-title::before, .service-list .service-image,
            .testimonial-section .lSSlideOuter .lSPager.lSpg > li:hover a, .about a.read-more:hover, .nav-links a,.backtohome a,
            .testimonial-section .lSSlideOuter .lSPager.lSpg > li.active a, .widget-area .widget .widget-title:before, .widget_search .search-form .search-submit, .page-title-wrap .page-title:before, input[type=submit].woocommerce-Button,#wpop-top:hover a,.woocommerce.woocommerce-page .onsale, .woocommerce.woocommerce-page .related.products .product .onsale, .woocommerce .onsale,#loading8 .object
            {
              background-color: $theme_color;
            } 

            .button, input[type='button'], input[type='reset'], input[type='submit'], .site-header.layout3, .site-header.layout3 .sticky-wrapper.is-sticky .header-wrap, a.slider-button:hover, .about a.read-more,
            .about a.read-more:hover, .team-content-wrap, .team-thumb.active:after, .pagination .current, .nav-links a,.backtohome a, .nav-links a:hover,.backtohome a:hover, input[type=submit].woocommerce-Button,#wpop-top:hover a
            {
              border-color: $theme_color;
            } 

           .woocommerce.woocommerce-page  .onsale:before, .woocommerce .onsale:before, .woocommerce .onsale:before{
            border-color: transparent $theme_color transparent transparent;
           }
    ";
    /* For woocommerce */
    if(class_exists('woocommerce')){
        $output_css .= ".woocommerce ul.products li.product .button:hover, .woocommerce ul.products li.product a.added_to_cart:hover, .comment-form input.submit:hover, .woocommerce-checkout-payment button#place_order:hover, form.checkout_coupon.woocommerce-form-coupon button.button:hover, .wc-proceed-to-checkout a.checkout-button:hover, table.shop_table.woocommerce-cart-form__contents td.actions .button:hover, a.woocommerce-Button.button:hover, .woocommerce-MyAccount-content form.edit-account .woocommerce-Button:hover, .widget_search .search-form .search-submit:hover, .widget_shopping_cart_content p.woocommerce-mini-cart__buttons.buttons a.button.wc-forward:hover, .woocommerce-notices-wrapper a.button.wc-forward:hover, .woocommerce .woocommerce-form-login .woocommerce-form-login__submit:hover, .woocommerce-form-register__submit:hover, .woocommerce button.button:hover, .woocommerce ul.products li.product .button:focus, .woocommerce ul.products li.product a.added_to_cart:focus, .comment-form input.submit:focus, .woocommerce-checkout-payment button#place_order:focus, form.checkout_coupon.woocommerce-form-coupon button.button:focus, .wc-proceed-to-checkout a.checkout-button:focus, table.shop_table.woocommerce-cart-form__contents td.actions .button:focus, a.woocommerce-Button.button:focus, .woocommerce-MyAccount-content form.edit-account .woocommerce-Button:focus, .widget_search .search-form .search-submit:focus, .widget_shopping_cart_content p.woocommerce-mini-cart__buttons.buttons a.button.wc-forward:focus, .woocommerce-notices-wrapper a.button.wc-forward:focus, .woocommerce .woocommerce-form-login .woocommerce-form-login__submit:focus, .woocommerce-form-register__submit:focus,.wc-proceed-to-checkout a.checkout-button:hover,.woocommerce a.button.alt:hover{ border-color: $theme_color !important; background-color: $theme_color !important; }";
    }
    } 

    /* Anchor Color */
    $anchor_color = get_theme_mod('wp_parallax_anchor_color');
    $anchor_hcolor = get_theme_mod('wp_parallax_anchor_hcolor'); 
    if($anchor_color!=''){
    $output_css .= "a{ color: $anchor_color;}";
    }
    if($anchor_hcolor!=''){
    $output_css .= "a:hover, a:focus, a:active{ color: $anchor_hcolor;}";
    }

    /* Top Header */
    $top_bg = get_theme_mod('wp_parallax_top_header_bg_color');
    $top_text = get_theme_mod('wp_parallax_top_header_text_color');
    $top_hover = get_theme_mod('wp_parallax_top_header_hover_color');
    if($top_bg!=''){
        $output_css.= ".top-header,.site-header.layout3 .top-header{ background: $top_bg; }"; 
    }
    if($top_text!=''){
        $output_css.= ".header-info li,.header-info ul li a,.top-header .header-icons ul li a{ color: $top_text; }"; 
    }
    if($top_hover!=''){
        $output_css.= ".header-info li:hover,.header-info ul li a:hover,.top-header .header-icons ul li a:hover{ color: $top_hover; }"; 
    }

    /* Bottom Header */
    $bottom_bg = get_theme_mod('wp_parallax_bottom_header_bg_color');
    $bottom_text = get_theme_mod('wp_parallax_bottom_header_text_color');
    $bottom_hover = get_theme_mod('wp_parallax_bottom_header_hover_color');

    if($bottom_bg!=''){
        $output_css.= ".header-wrap,.main-navigation ul ul{ background: $bottom_bg !important; }";
    }
    if($bottom_text!=''){
        $output_css.= "#site-navigation ul li a,.site-header.layout3 #site-navigation ul li a, .site-header.layout3 .site-description, .site-header.layout3 .search-cart-wrap .search-icon i, .site-header.layout3 .wpop-shopping-cart a,.site-description, .site-header.layout3 #site-navigation ul ul li a{ color: $bottom_text; }
            .site-header.layout3 .search-cart-wrap svg,.site-header .search-cart-wrap svg{ fill: $bottom_text;}
            span.menu-toggle, span.menu-toggle:before, span.menu-toggle:after{ background-color: $bottom_text;}
        ";
    }
    if($bottom_hover!=''){
        $output_css.= "#site-navigation ul li a:hover,.site-header.layout3 #site-navigation ul li a:hover, .site-header.layout3 .search-cart-wrap .search-icon i:hover, .site-header.layout3 .wpop-shopping-cart a:hover, .site-header.layout3 #site-navigation ul ul li a:hover{ color: $bottom_hover; }
            .site-header .search-cart-wrap .search-icon:hover svg,.site-header .search-cart-wrap .count:hover svg{ fill: $bottom_hover;}
        ";
    }

    /* Mobile Menu Styles */
    $mob_text = get_theme_mod('wp_parallax_mobile_text_color');
    $mob_bg = get_theme_mod('wp_parallax_mobile_bg_color');
    if($mob_bg){
        $output_css.= ".mob-nav-wrapp,.main-navigation .wpparallax-mob-menu.mob-primary-menu ul ul{ background-color: $mob_bg !important; }";
    }
    if($mob_text){
        $output_css.= "@media (max-width:768px) {#site-navigation ul li a,.mob-nav-wrapp span.icon-wrapp i,.mob-nav-wrapp span.text,.mob-nav-wrapp .mob-primary-menu li .sub-toggle i{ color: $mob_text !important; }}";
    }
    /* Typography Styles */
    $body_font = json_decode(get_theme_mod('wp_parallax_body_font_family','{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'),true);
    if($body_font['boldweight'] == 'regular'){
        unset($body_font['boldweight']);
        $body_font['boldweight'] = 'normal';
    }
    $body_fsize = get_theme_mod('wp_parallax_body_font_size');
    $b_lheight = get_theme_mod('wp_parallax_body_line_height');
    $b_tcolor = get_theme_mod('wp_parallax_body_text_color');

    if($body_font){
        ob_start();
        ?>
        body,button, input, select, optgroup, textarea{
            font-family: "<?php echo esc_attr($body_font['font']);?>";
            font-weight: <?php echo esc_attr($body_font['boldweight']);?>;
            <?php if($body_fsize){?>
            font-size: <?php echo absint($body_fsize);?>px;
            <?php } if($b_lheight){?>
            line-height: <?php echo absint($b_lheight);?>px;
            <?php } if($b_tcolor){?>
            color: <?php echo $b_tcolor;?>;
            <?php }?> 
        }
        <?php
        $output_css .= ob_get_clean();
    }

    /* Header Button styles */
    $btext_color = get_theme_mod('wp_parallax_button_text_color');
    $bbg_color = get_theme_mod('wp_parallax_button_bg_color');
    $bborder_color = get_theme_mod('wp_parallax_button_border_color');
    $btext_hcolor = get_theme_mod('wp_parallax_button_text_hcolor');
    $bbg_hcolor = get_theme_mod('wp_parallax_button_bg_hcolor');
    $bborder_hcolor = get_theme_mod('wp_parallax_button_border_hcolor');

    if($btext_color||$bbg_color||$bborder_color){
        ob_start();
        ?>
        .header-button a{
            <?php if($btext_color){?>
            color: <?php echo esc_attr($btext_color);?>;
            <?php } if($bbg_color){?>
            background-color: <?php echo esc_attr($bbg_color);?>;
            <?php } if($bborder_color){?>
            border-color: <?php echo esc_attr($bborder_color);?>;
            <?php }?> 
        }
        <?php
        $output_css .= ob_get_clean();
    } 
    if($btext_hcolor||$bbg_hcolor||$bborder_hcolor){
        ob_start();
        ?>
        .header-button a:hover{
            <?php if($btext_hcolor){?>
            color: <?php echo esc_attr($btext_hcolor);?>;
            <?php } if($bbg_hcolor){?>
            background-color: <?php echo esc_attr($bbg_hcolor);?>;
            <?php } if($bborder_hcolor){?>
            border-color: <?php echo esc_attr($bborder_hcolor);?>;
            <?php }?> 
        }
        <?php
        $output_css .= ob_get_clean();
    } 

    /* Footer Styles */
    $tfooter_text = get_theme_mod('wp_parallax_tfooter_text_color');  
    $tfooter_bg = get_theme_mod('wp_parallax_tfooter_bg_color');
    $bfooter_text = get_theme_mod('wp_parallax_bfooter_text_color');
    $bfooter_bg = get_theme_mod('wp_parallax_bfooter_bg_color');

    if($tfooter_bg){
        $output_css .= ".footer-widgetswrap{ background: $tfooter_bg; }";
    }
    if($tfooter_text){
        $output_css .= ".footer-widgetswrap,.footer-widgetswrap i,.footer-widgetswrap a{ color: $tfooter_text; }";
    }
    if($bfooter_bg){
        $output_css .= ".bottom-footer{ background: $bfooter_bg; }";
    }
    if($bfooter_text){
        $output_css .= ".bottom-footer .footer-left,.bottom-footer .footer-right ul a{ color: $bfooter_text; }";
    }

    /**
    * Section font color 
    */
    $wp_parallax_homepage = get_theme_mod('wp_parallax_homepage');
    $wp_parallax_homepage_colors = json_decode($wp_parallax_homepage);
    if($wp_parallax_homepage_colors != ''):
    foreach( $wp_parallax_homepage_colors as $wp_parallax_homepage_color ){
        $font_color =  isset($wp_parallax_homepage_color->wp_parallax_section_txt_color) ? $wp_parallax_homepage_color->wp_parallax_section_txt_color : '';
        $layouts = $wp_parallax_homepage_color->wp_parallax_layout;
        $layout = '.'.$layouts.'-layout';
        
        if( $font_color ){
             $output_css .= 
                     "$layout{
                        color:".esc_html($font_color).";
                }";
        }
    }
    endif;

    //custom style from metabox
    $ultra_page_bg =  get_post_meta(get_the_ID(),'ultra_page_bg_color',true);
    if($ultra_page_bg){
        $output_css .= "body{ background: $ultra_page_bg !important;}";
    }  

    $ultra_inner_padding = get_post_meta(get_the_ID(),'ultra_inner_page_paddings',true);
    if($ultra_inner_padding == 'none'){
        $output_css .= ".inner-container{ padding: 0 !important;}";
    }elseif($ultra_inner_padding == 'only_top'){
        $output_css .= ".inner-container{ padding-bottom: 0 !important;}";
    }elseif($ultra_inner_padding == 'only_bottom'){
        $output_css .= ".inner-container{ padding-top: 0 !important;}";
    }
    $ultra_page_custom_css = get_post_meta(get_the_ID(),'ultra_page_custom_css',true);
    if( $ultra_page_custom_css ){
        $output_css .= "
        ". esc_html($ultra_page_custom_css).";
        ";
    }

    wp_add_inline_style('wpparallax-responsive-style', apply_filters( 'wpparallax_dynamic_css', $output_css ));
} 
add_action('wp_enqueue_scripts', 'wpparallax_dynamic_styles', 999);   