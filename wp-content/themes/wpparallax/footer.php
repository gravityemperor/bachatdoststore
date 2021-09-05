<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpparallax
 */

?>

	</div><!-- #content -->

	<?php do_action( 'wp_parallax_before_footer' ); ?>
		<?php
	    $meta = get_post_meta(get_the_ID(),'ultra_page_footer',true);
	    $footer_layout = get_post_meta(get_the_ID(),'ultra_page_footer',true);
	    $template_id = get_post_meta(get_the_ID(),'ultra_page_custom_footer',true);
	    
	    if($footer_layout == 'default' || $footer_layout == ''){
	        $footer_layout = get_theme_mod('wp_parallax_footer_layouts','default');
	        $template_id = get_theme_mod('wp_parallax_custom_footer');
	    }
	    if($footer_layout!='hide'){
	        if($footer_layout == 'custom' && $template_id!='' && defined('ELEMENTOR_VERSION')){
	            echo '<footer class="ultra-custom-footer">';
	            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id );
	            echo '</footer>';
	        }else{
			    ?>
				<footer id="colophon" class="site-footer" role="contentinfo">
		            
					<?php
						/**
						 * @hooked wp_parallax_footer_widgets - 0
						 * @hooked wp_parallax_credit - 10
						 */
						do_action( 'wp_parallax_footer' ); 
					?>			
				</footer><!-- #colophon -->
				<?php
			} 
		}
		?>
		
	<?php do_action( 'wp_parallax_before_footer' ); ?>
	<?php 
    $search_enable = get_theme_mod('wp_parallax_search_enable','show');
	if($search_enable == 'show'){?>
	<div class="full-search-container">
	   <a href="javascript:void(0)" class="closebtn" >&times;</a>
	   <?php get_search_form(); ?>
	</div> 
	<?php }?>
	<div id="wpop-top">
		<a href="javascript:void(0)">
			<i class="fa fa-angle-up"></i>	
		</a>
	</div>
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
<?php 
do_action( 'wp_parallax_after_body_output' );
?>
</html>
