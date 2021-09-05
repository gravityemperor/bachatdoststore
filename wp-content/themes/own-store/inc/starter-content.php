<?php

/**
 * Function to return the array of starter content for the theme.
 *
 * Passes it through the `own_store_starter_content` filter before returning.
 *
 *
 * @return array A filtered array of args for the starter_content.
 */
function own_store_get_starter_content() {

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'     => array(
			'front' => array(
				'post_type'    => 'page',
				'post_title'   => esc_html__( 'Gutenberg Home', 'own-store' ),
				'post_content' => '
					<!-- wp:cover {"url":"' . esc_url( get_stylesheet_directory_uri() ) . '/img/bg-image.jpg","id":405,"dimRatio":0,"minHeight":600,"align":"full","style":{"color":{}}} -->
					<div class="wp-block-cover alignfull" style="min-height:600px"><img class="wp-block-cover__image-background wp-image-405" alt="" src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/bg-image.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"textColor":"black","fontSize":"normal"} -->
					<p class="has-black-color has-text-color has-normal-font-size">Get 30% OFF on Clearance Sale</p>
					<!-- /wp:paragraph -->

					<!-- wp:heading {"textColor":"black","fontSize":"huge"} -->
					<h2 class="has-black-color has-text-color has-huge-font-size">Furnitures Designed For You</h2>
					<!-- /wp:heading -->

					<!-- wp:spacer {"height":30} -->
					<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:buttons -->
					<div class="wp-block-buttons"><!-- wp:button {"width":25,"className":"is-style-fill","fontSize":"normal"} -->
					<div class="wp-block-button has-custom-width wp-block-button__width-25 has-custom-font-size is-style-fill has-normal-font-size"><a class="wp-block-button__link" href="#">START SHOPPING</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div></div>
					<!-- /wp:cover -->

					<!-- wp:spacer {"height":60} -->
					<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:heading {"textAlign":"center","textColor":"black","fontSize":"huge"} -->
					<h2 class="has-text-align-center has-black-color has-text-color has-huge-font-size">Newest Products</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#555555"}},"fontSize":"normal"} -->
					<p class="has-text-align-center has-text-color has-normal-font-size" style="color:#555555">This is a demo products list. Install WooCommerce Plugin </p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#555555"}},"fontSize":"normal"} -->
					<p class="has-text-align-center has-text-color has-normal-font-size" style="color:#555555">&amp; Add WooCommerce Product Blocks</p>
					<!-- /wp:paragraph -->

					<!-- wp:spacer {"height":80} -->
					<div style="height:80px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:columns -->
					<div class="wp-block-columns"><!-- wp:column -->
					<div class="wp-block-column"><!-- wp:columns {"align":"wide"} -->
					<div class="wp-block-columns alignwide"><!-- wp:column -->
					<div class="wp-block-column"><!-- wp:cover {"overlayColor":"cyan-bluish-gray","minHeight":306,"minHeightUnit":"px"} -->
					<div class="wp-block-cover has-cyan-bluish-gray-background-color has-background-dim" style="min-height:306px"><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…"} -->
					<p class="has-text-align-center">Demo Product</p>
					<!-- /wp:paragraph --></div></div>
					<!-- /wp:cover -->

					<!-- wp:heading {"textAlign":"center","fontSize":"medium"} -->
					<h2 class="has-text-align-center has-medium-font-size">Product 1</h2>
					<!-- /wp:heading -->

					<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"normal"} -->
					<h3 class="has-text-align-center has-normal-font-size">$100</h3>
					<!-- /wp:heading -->

					<!-- wp:buttons {"contentJustification":"center"} -->
					<div class="wp-block-buttons is-content-justification-center"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link">Add to Cart</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:cover {"overlayColor":"luminous-vivid-amber","minHeight":306,"minHeightUnit":"px"} -->
					<div class="wp-block-cover has-luminous-vivid-amber-background-color has-background-dim" style="min-height:306px"><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…"} -->
					<p class="has-text-align-center">Demo Product</p>
					<!-- /wp:paragraph --></div></div>
					<!-- /wp:cover -->

					<!-- wp:heading {"textAlign":"center","fontSize":"medium"} -->
					<h2 class="has-text-align-center has-medium-font-size">Product 2</h2>
					<!-- /wp:heading -->

					<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"normal"} -->
					<h3 class="has-text-align-center has-normal-font-size">$89</h3>
					<!-- /wp:heading -->

					<!-- wp:buttons {"contentJustification":"center"} -->
					<div class="wp-block-buttons is-content-justification-center"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link">Add to Cart</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:columns {"align":"wide"} -->
					<div class="wp-block-columns alignwide"><!-- wp:column -->
					<div class="wp-block-column"><!-- wp:cover {"overlayColor":"light-green-cyan","minHeight":305,"minHeightUnit":"px"} -->
					<div class="wp-block-cover has-light-green-cyan-background-color has-background-dim" style="min-height:305px"><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…"} -->
					<p class="has-text-align-center">Demo Product</p>
					<!-- /wp:paragraph --></div></div>
					<!-- /wp:cover -->

					<!-- wp:heading {"textAlign":"center","fontSize":"medium"} -->
					<h2 class="has-text-align-center has-medium-font-size">Product 3</h2>
					<!-- /wp:heading -->

					<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"normal"} -->
					<h3 class="has-text-align-center has-normal-font-size"><s>$149</s> $100</h3>
					<!-- /wp:heading -->

					<!-- wp:buttons {"contentJustification":"center"} -->
					<div class="wp-block-buttons is-content-justification-center"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link">Add to Cart</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:cover {"overlayColor":"pale-cyan-blue","minHeight":303,"minHeightUnit":"px"} -->
					<div class="wp-block-cover has-pale-cyan-blue-background-color has-background-dim" style="min-height:303px"><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…"} -->
					<p class="has-text-align-center">Demo Product</p>
					<!-- /wp:paragraph --></div></div>
					<!-- /wp:cover -->

					<!-- wp:heading {"textAlign":"center","fontSize":"medium"} -->
					<h2 class="has-text-align-center has-medium-font-size">Product 4</h2>
					<!-- /wp:heading -->

					<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"normal"} -->
					<h3 class="has-text-align-center has-normal-font-size">$79</h3>
					<!-- /wp:heading -->

					<!-- wp:buttons {"contentJustification":"center"} -->
					<div class="wp-block-buttons is-content-justification-center"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link">Add to Cart</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns -->

					<!-- wp:columns {"align":"wide"} -->
					<div class="wp-block-columns alignwide"><!-- wp:column {"width":"35%"} -->
					<div class="wp-block-column" style="flex-basis:35%"><!-- wp:cover {"url":"' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-1.jpg","id":416,"dimRatio":70,"overlayColor":"white","focalPoint":{"x":"0.48","y":0}} -->
					<div class="wp-block-cover has-background-dim-70 has-white-background-color has-background-dim"><img class="wp-block-cover__image-background wp-image-416" alt="" src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-1.jpg" style="object-position:48% 0%" data-object-fit="cover" data-object-position="48% 0%"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","textColor":"black","fontSize":"large"} -->
					<p class="has-text-align-center has-black-color has-text-color has-large-font-size">Upto 30% OFF</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"23px"}},"textColor":"black"} -->
					<p class="has-text-align-center has-black-color has-text-color" style="font-size:23px"><strong>Interior Decorations</strong></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"align":"center","textColor":"black"} -->
					<p class="has-text-align-center has-black-color has-text-color">Lorem ipsum dolor sit amet</p>
					<!-- /wp:paragraph -->

					<!-- wp:spacer {"height":30} -->
					<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:buttons {"contentJustification":"center","align":"wide"} -->
					<div class="wp-block-buttons alignwide is-content-justification-center"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link" href="#">SHOP NOW</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons -->

					<!-- wp:paragraph -->
					<p></p>
					<!-- /wp:paragraph --></div></div>
					<!-- /wp:cover --></div>
					<!-- /wp:column -->

					<!-- wp:column {"width":"30%"} -->
					<div class="wp-block-column" style="flex-basis:30%"><!-- wp:cover {"url":"' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-2.jpg","id":417,"overlayColor":"white","focalPoint":{"x":"0.38","y":"0.07"}} -->
					<div class="wp-block-cover has-white-background-color has-background-dim"><img class="wp-block-cover__image-background wp-image-417" alt="" src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-2.jpg" style="object-position:38% 7%" data-object-fit="cover" data-object-position="38% 7%"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","textColor":"black","fontSize":"large"} -->
					<p class="has-text-align-center has-black-color has-text-color has-large-font-size">Upto 70% OFF</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"align":"center","textColor":"black"} -->
					<p class="has-text-align-center has-black-color has-text-color">Huge Discounts on Groceries</p>
					<!-- /wp:paragraph -->

					<!-- wp:spacer {"height":30} -->
					<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:buttons {"contentJustification":"center","align":"wide"} -->
					<div class="wp-block-buttons alignwide is-content-justification-center"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link" href="#">SHOP NOW</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div></div>
					<!-- /wp:cover -->

					<!-- wp:buttons -->
					<div class="wp-block-buttons"><!-- wp:button /--></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column -->

					<!-- wp:column {"width":"35%"} -->
					<div class="wp-block-column" style="flex-basis:35%"><!-- wp:cover {"url":"' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-3.jpg","id":432,"dimRatio":40,"overlayColor":"white","focalPoint":{"x":"0.00","y":"0.41"}} -->
					<div class="wp-block-cover has-background-dim-40 has-white-background-color has-background-dim"><img class="wp-block-cover__image-background wp-image-432" alt="" src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-3.jpg" style="object-position:0% 41%" data-object-fit="cover" data-object-position="0% 41%"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","textColor":"black","fontSize":"large"} -->
					<p class="has-text-align-center has-black-color has-text-color has-large-font-size">Upto 20% OFF</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"23px"}},"textColor":"black"} -->
					<p class="has-text-align-center has-black-color has-text-color" style="font-size:23px"><strong>Office furniture</strong></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"align":"center","textColor":"black"} -->
					<p class="has-text-align-center has-black-color has-text-color">Lorem ipsum dolor sit amet</p>
					<!-- /wp:paragraph -->

					<!-- wp:spacer {"height":30} -->
					<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:buttons {"contentJustification":"center"} -->
					<div class="wp-block-buttons is-content-justification-center"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link">SHOP NOW</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div></div>
					<!-- /wp:cover --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns -->

					<!-- wp:spacer {"height":60} -->
					<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:columns {"verticalAlignment":"center","style":{"color":{"background":"#f5f2eb"}}} -->
					<div class="wp-block-columns are-vertically-aligned-center has-background" style="background-color:#f5f2eb"><!-- wp:column {"verticalAlignment":"center"} -->
					<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"align":"right","id":445,"width":503,"height":299,"sizeSlug":"full","linkDestination":"none"} -->
					<div class="wp-block-image"><figure class="alignright size-full is-resized"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-4.png" alt="' . esc_attr__( 'Furniture Image', 'own-store' ) . '" class="wp-image-445" width="503" height="299"/></figure></div>
					<!-- /wp:image --></div>
					<!-- /wp:column -->

					<!-- wp:column {"verticalAlignment":"center"} -->
					<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"fontSize":"medium"} -->
					<p class="has-medium-font-size">Quick Delivery</p>
					<!-- /wp:paragraph -->

					<!-- wp:heading {"textColor":"black","fontSize":"huge"} -->
					<h2 class="has-black-color has-text-color has-huge-font-size">Get Branded Furniture Collection</h2>
					<!-- /wp:heading -->

					<!-- wp:buttons -->
					<div class="wp-block-buttons"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link">START SHOPPING</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns -->

					<!-- wp:spacer {"height":60} -->
					<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:heading {"textAlign":"center","textColor":"black","fontSize":"huge"} -->
					<h2 class="has-text-align-center has-black-color has-text-color has-huge-font-size">Trendy Products</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#555555"}},"fontSize":"normal"} -->
					<p class="has-text-align-center has-text-color has-normal-font-size" style="color:#555555">This is a demo products list. Install WooCommerce Plugin </p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#555555"}},"fontSize":"normal"} -->
					<p class="has-text-align-center has-text-color has-normal-font-size" style="color:#555555">&amp; Add WooCommerce Product Blocks</p>
					<!-- /wp:paragraph -->

					<!-- wp:spacer {"height":80} -->
					<div style="height:80px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:paragraph -->
					<p></p>
					<!-- /wp:paragraph -->

					<!-- wp:columns -->
					<div class="wp-block-columns"><!-- wp:column -->
					<div class="wp-block-column"><!-- wp:columns {"align":"wide"} -->
					<div class="wp-block-columns alignwide"><!-- wp:column -->
					<div class="wp-block-column"><!-- wp:cover {"overlayColor":"cyan-bluish-gray","minHeight":306,"minHeightUnit":"px"} -->
					<div class="wp-block-cover has-cyan-bluish-gray-background-color has-background-dim" style="min-height:306px"><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…"} -->
					<p class="has-text-align-center">Demo Product</p>
					<!-- /wp:paragraph --></div></div>
					<!-- /wp:cover -->

					<!-- wp:heading {"textAlign":"center","fontSize":"medium"} -->
					<h2 class="has-text-align-center has-medium-font-size">Product 1</h2>
					<!-- /wp:heading -->

					<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"normal"} -->
					<h3 class="has-text-align-center has-normal-font-size">$100</h3>
					<!-- /wp:heading -->

					<!-- wp:buttons {"contentJustification":"center"} -->
					<div class="wp-block-buttons is-content-justification-center"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link">Add to Cart</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:cover {"overlayColor":"luminous-vivid-amber","minHeight":306,"minHeightUnit":"px"} -->
					<div class="wp-block-cover has-luminous-vivid-amber-background-color has-background-dim" style="min-height:306px"><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…"} -->
					<p class="has-text-align-center">Demo Product</p>
					<!-- /wp:paragraph --></div></div>
					<!-- /wp:cover -->

					<!-- wp:heading {"textAlign":"center","fontSize":"medium"} -->
					<h2 class="has-text-align-center has-medium-font-size">Product 2</h2>
					<!-- /wp:heading -->

					<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"normal"} -->
					<h3 class="has-text-align-center has-normal-font-size">$89</h3>
					<!-- /wp:heading -->

					<!-- wp:buttons {"contentJustification":"center"} -->
					<div class="wp-block-buttons is-content-justification-center"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link">Add to Cart</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:columns {"align":"wide"} -->
					<div class="wp-block-columns alignwide"><!-- wp:column -->
					<div class="wp-block-column"><!-- wp:cover {"overlayColor":"light-green-cyan","minHeight":305,"minHeightUnit":"px"} -->
					<div class="wp-block-cover has-light-green-cyan-background-color has-background-dim" style="min-height:305px"><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…"} -->
					<p class="has-text-align-center">Demo Product</p>
					<!-- /wp:paragraph --></div></div>
					<!-- /wp:cover -->

					<!-- wp:heading {"textAlign":"center","fontSize":"medium"} -->
					<h2 class="has-text-align-center has-medium-font-size">Product 3</h2>
					<!-- /wp:heading -->

					<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"normal"} -->
					<h3 class="has-text-align-center has-normal-font-size"><s>$149</s> $100</h3>
					<!-- /wp:heading -->

					<!-- wp:buttons {"contentJustification":"center"} -->
					<div class="wp-block-buttons is-content-justification-center"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link">Add to Cart</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:cover {"overlayColor":"pale-cyan-blue","minHeight":303,"minHeightUnit":"px"} -->
					<div class="wp-block-cover has-pale-cyan-blue-background-color has-background-dim" style="min-height:303px"><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…"} -->
					<p class="has-text-align-center">Demo Product</p>
					<!-- /wp:paragraph --></div></div>
					<!-- /wp:cover -->

					<!-- wp:heading {"textAlign":"center","fontSize":"medium"} -->
					<h2 class="has-text-align-center has-medium-font-size">Product 4</h2>
					<!-- /wp:heading -->

					<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"normal"} -->
					<h3 class="has-text-align-center has-normal-font-size">$79</h3>
					<!-- /wp:heading -->

					<!-- wp:buttons {"contentJustification":"center"} -->
					<div class="wp-block-buttons is-content-justification-center"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link">Add to Cart</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns -->

					<!-- wp:spacer {"height":50} -->
					<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:columns {"align":"wide"} -->
					<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center"} -->
					<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"textAlign":"center","textColor":"black","fontSize":"medium"} -->
					<h2 class="has-text-align-center has-black-color has-text-color has-medium-font-size">2 Hours Delivery</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"center"} -->
					<p class="has-text-align-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id elementum orci.&nbsp;</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:heading {"textAlign":"center","textColor":"black","fontSize":"medium"} -->
					<h2 class="has-text-align-center has-black-color has-text-color has-medium-font-size">Fast Express Shop </h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"center"} -->
					<p class="has-text-align-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id elementum orci.&nbsp;</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:heading {"textAlign":"center","textColor":"black","fontSize":"medium"} -->
					<h2 class="has-text-align-center has-black-color has-text-color has-medium-font-size">Secure Payments</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"align":"center"} -->
					<p class="has-text-align-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id elementum orci.&nbsp;</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns -->

					<!-- wp:paragraph -->
					<p></p>
					<!-- /wp:paragraph -->',
			),
			'about' => array(
				'post_type'    => 'page',
				'post_title'   => esc_html__( 'About', 'own-store' ),
				'post_content' => '
					<!-- wp:spacer {"height":50} -->
					<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:columns {"align":"wide"} -->
					<div class="wp-block-columns alignwide"><!-- wp:column -->
					<div class="wp-block-column"><!-- wp:heading {"style":{"typography":{"fontSize":"28px"}}} -->
					<h2 style="font-size:28px">About Store</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis risus massa. Praesent ac vestibulum elit. Nulla sed nisl ac erat iaculis bibendum nec congue tortor. Sed volutpat ut sapien eget dictum. In consectetur gravida dolor eget imperdiet. Pellentesque et lacinia tortor. Mauris dignissim, mi eu ultrices pretium, ipsum ex malesuada ex, vel maximus est leo id tortor. Nullam in facilisis tortor. Ut nec nunc eu sapien imperdiet vestibulum. Etiam congue augue non sapien venenatis, bibendum pretium lacus porttitor. Suspendisse eget aliquam nulla.</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:image {"id":432,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-3.jpg" alt="' . esc_attr__( 'About Us', 'own-store' ) . '" class="wp-image-432"/></figure>
					<!-- /wp:image --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns -->

					<!-- wp:spacer -->
					<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:paragraph -->
					<p>Our Gallery</p>
					<!-- /wp:paragraph -->

					<!-- wp:heading {"style":{"typography":{"fontSize":"28px"}},"textColor":"black"} -->
					<h2 class="has-black-color has-text-color" style="font-size:28px">Store Gallery</h2>
					<!-- /wp:heading -->

					<!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
					<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"25%"} -->
					<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:25%"><!-- wp:image {"id":432,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-3.jpg" alt="' . esc_attr__( 'Gallery Image 1', 'own-store' ) . '" class="wp-image-432"/></figure>
					<!-- /wp:image -->

					<!-- wp:paragraph {"align":"center"} -->
					<p class="has-text-align-center">usce lorem est, sodales eget dignissim ut, porttitor sit amet leo. Ut ac vulputate dui. Vivamus ac lectus porttitor, pretium nibh a, rhoncus arcu. Pellentesque congue lacus ac pretium semper</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column -->

					<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
					<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"id":417,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-2.jpg" alt="' . esc_attr__( 'Gallery Image 2', 'own-store' ) . '" class="wp-image-417"/></figure>
					<!-- /wp:image --></div>
					<!-- /wp:column -->

					<!-- wp:column {"verticalAlignment":"center","width":"25%"} -->
					<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:25%"><!-- wp:image {"id":416,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-1.jpg" alt="' . esc_attr__( 'Gallery Image 3', 'own-store' ) . '" class="wp-image-416"/></figure>
					<!-- /wp:image -->

					<!-- wp:paragraph {"align":"center"} -->
					<p class="has-text-align-center">usce lorem est, sodales eget dignissim ut, porttitor sit amet leo. Ut ac vulputate dui. Vivamus ac lectus porttitor, pretium nibh a, rhoncus arcu. Pellentesque congue lacus ac pretium semper</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns -->

					<!-- wp:spacer -->
					<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:cover {"url":"' . esc_url( get_stylesheet_directory_uri() ) . '/img/bg-image.jpg","id":405,"focalPoint":{"x":"0.20","y":"0.85"},"minHeight":200,"minHeightUnit":"px"} -->
					<div class="wp-block-cover has-background-dim" style="min-height:200px"><img class="wp-block-cover__image-background wp-image-405" alt="" src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/bg-image.jpg" style="object-position:20% 85%" data-object-fit="cover" data-object-position="20% 85%"/><div class="wp-block-cover__inner-container"><!-- wp:spacer {"height":50} -->
					<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:columns -->
					<div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center"} -->
					<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"style":{"typography":{"fontSize":"25px"}}} -->
					<h2 style="font-size:25px">Explore more products in the same category</h2>
					<!-- /wp:heading -->

					<!-- wp:spacer {"height":25} -->
					<div style="height:25px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:paragraph {"fontSize":"normal"} -->
					<p class="has-normal-font-size">Pellentesque et lacinia tortor. Mauris dignissim, mi eu ultrices pretium, ipsum ex malesuada ex,&nbsp;</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column -->

					<!-- wp:column {"verticalAlignment":"center"} -->
					<div class="wp-block-column is-vertically-aligned-center"><!-- wp:buttons {"contentJustification":"right"} -->
					<div class="wp-block-buttons is-content-justification-right"><!-- wp:button -->
					<div class="wp-block-button"><a class="wp-block-button__link">SHOP NOW</a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns --></div></div>
					<!-- /wp:cover -->

					<!-- wp:paragraph -->
					<p></p>
					<!-- /wp:paragraph -->
				',
			),
			'blog',
			'contact' => array(
				'post_type'    => 'page',
				'post_title'   => esc_html__( 'Contact', 'own-store' ),
				'post_content' => '
					<!-- wp:spacer {"height":50} -->
					<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:columns {"align":"wide"} -->
					<div class="wp-block-columns alignwide"><!-- wp:column -->
					<div class="wp-block-column"><!-- wp:heading {"fontSize":"medium"} -->
					<h2 class="has-medium-font-size">Email Us</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"fontSize":"normal"} -->
					<p class="has-normal-font-size">support@spiraclethemes.com</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:heading {"fontSize":"medium"} -->
					<h2 class="has-medium-font-size">Phone</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"fontSize":"normal"} -->
					<p class="has-normal-font-size">123-456-7890</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:heading {"fontSize":"medium"} -->
					<h2 class="has-medium-font-size">Address</h2>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"fontSize":"normal"} -->
					<p class="has-normal-font-size">123, Upper Street New York, US</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns -->

					<!-- wp:spacer -->
					<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:columns {"align":"wide"} -->
					<div class="wp-block-columns alignwide"><!-- wp:column -->
					<div class="wp-block-column"><!-- wp:contact-form-7/contact-form-selector -->
					<div class="wp-block-contact-form-7-contact-form-selector">[contact-form-7 id="" title=""]</div>
					<!-- /wp:contact-form-7/contact-form-selector -->

					<!-- wp:spacer {"height":50} -->
					<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:paragraph {"textColor":"black"} -->
					<p class="has-black-color has-text-color">Add the Contact Form 7 Shortcode above</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column -->

					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:image {"id":507,"sizeSlug":"full","linkDestination":"none"} -->
					<figure class="wp-block-image size-full"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/img-5.jpg" alt="' . esc_attr__( 'Contact Us', 'own-store' ) . '" class="wp-image-507"/></figure>
					<!-- /wp:image --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns -->

					<!-- wp:spacer -->
					<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:paragraph -->
					<p></p>
					<!-- /wp:paragraph -->
				',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options'   => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{front}}',
			'page_for_posts' => '{{blog}}',
			'blogdescription' => esc_html__( 'WooCommerce WordPress theme', 'own-store' ),
			'blogname' => 'Own Store',
		),
		'theme_mods'  => array(
			'own_store_enable_header_category_menu'  => true,
			'own_shop_site_primary_color'  => '#333333',
			'own_shop_site_secondary_color'  => '#000000',
		),

		'widgets' => array(
			'topsidebar' => array(
				'text_world' => array(
			       	'text',
			        array(
			        	'text'  => '<p>Free Shipping all orders above $99. <button>Shop Now</button></p>',
			        )
			    ),
			),
			'footer-1' => array(
				'text_world' => array(
			       	'text',
			        array(
			        	'title'  => esc_html__( 'Quick Links', 'own-store' ),
			        	'text'  => '<ul>
										<li><a href="#">' . esc_html__( 'About Us', 'own-store' ) . '</a></li>
										<li><a href="#">' . esc_html__( 'Why Own Store', 'own-store' ) . '</a></li>
										<li><a href="#">' . esc_html__( 'Customer Reviews', 'own-store' ) . '</a></li>
										<li><a href="#">' . esc_html__( 'Support', 'own-store' ) . '</a></li>
										<li><a href="#">' . esc_html__( 'Privacy Policy', 'own-store' ) . '</a></li>
										<li><a href="#">' . esc_html__( 'Terms & Conditions', 'own-store' ) . '</a></li>
									</ul>',
			        )
			    ),
			),
			'footer-2' => array(
				'archives'
			),
			'footer-3' => array(
				'text_world' => array(
			       	'text',
			        array(
			        	'text'  => '<img src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/logo.png" alt="' . esc_attr__( 'footer logo', 'own-store' ) . '" width="150px"><br/><br/>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras urna sem, imperdiet in leo et, fermentum luctus ipsum. Integer ut orci justo. Curabitur posuere rutrum condimentum. In porttitor ligula vel bibendum dictum<br/><br/><br/>',
			        )
			    ),
			),
		),
		
		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "primary" location.
			'primary' => array(
				'name'  => esc_html__( 'Primary', 'own-store' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
			'categorymenu' => array(
				'name'  => esc_html__( 'Category Menu', 'own-store' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
	);

	/**
	 * Filters the array of starter content.
	 *
	 *
	 * @param array $starter_content Array of starter content.
	 */
	return apply_filters( 'own_store_starter_content', $starter_content );
}
