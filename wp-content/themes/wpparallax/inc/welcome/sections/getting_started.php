<div class="operation-theme-steps-list">
<div class="left-box-wrapper-outer">
<div class="op-box-wrapper operation-welcome-box-white">
	<div class="op-box-header"><?php esc_html_e('Links to Customizer Settings','wpparallax'); ?></div>
	<div class="op-box-content">
		<ul class="op-list clearfix">
			<?php
			 $url = admin_url( 'customize.php' );

	        $links = array(
	            array(
	                'label' => __( 'Logo & Site Identity', 'wpparallax' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'title_tagline' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-format-image',
	            ),
	            array(
	                'label' => __( 'Header Options', 'wpparallax' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'wp_parallax_header_layouts_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-align-center',
	            ),
	            array(
	                'label' => __( 'Breadcrumb Settings', 'wpparallax' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'wp_parallax_breadcrumb' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-layout',
	            ),
	            array(
	                'label' => __( 'Theme Colors', 'wpparallax' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'colors' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-admin-customizer',
	            ),
	            array(
	                'label' => __( 'General Settings', 'wpparallax' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'panel' => 'general_settings' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-admin-generic',
	            ),
	            array(
	                'label' => __( 'Blog Settings', 'wpparallax' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'wp_parallax_archive_page_options' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-welcome-write-blog',
	            ),
	            array(
	                'label' => __( 'Top Header Settings', 'wpparallax' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'wp_parallax_top_header_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-share',
	            ),
	            array(
	                'label' => __( 'Footer Settings', 'wpparallax' ),
	                'url' 	=> add_query_arg( array( 'autofocus' => array( 'section' => 'wp_parallax_footer_section' ) ), $url ),
	                'icon' 	=> 'dashicons dashicons-admin-generic',
	            ),
	           
	        );

	        $links = apply_filters( 'wpparallax/dashboard/links', $links );
	        ?> 

			<?php foreach( $links as $l ) { ?>
                <li>
                	<span class="<?php echo esc_attr($l['icon'])?>"></span>
                    <a class="op-quick-setting-link" href="<?php echo esc_url( $l['url'] ); ?>" target="_blank"><?php echo esc_html( $l['label'] ); ?></a>
                </li>
            <?php } ?>
		</ul>
	</div>
</div>

<div class="op-box-wrapper operation-welcome-box-white">
	<div class="op-box-header"><?php esc_html_e('Welcome','wpparallax'); ?></div>
	<div class="box-content">
		<p><?php esc_html_e('Welcome and thank you for choosing WPparallax. Please install and activate all recommended plugins.','wpparallax'); ?></p>
	</div>
</div>	
</div>


<?php $this->admin_sidebar_contents(); ?>

</div>