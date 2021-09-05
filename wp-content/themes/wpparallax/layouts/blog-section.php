<?php
/**
 * The template for displaying all Parallax Templates.
 *
 * @package wpparallax
 */
?>

	<div class="blog-section">
		<?php
        $query = new WP_Query( 'page_id='.$page_id );
        while ( $query->have_posts() ) : $query->the_post();
	      $section_title = get_the_title();
	      if($show_title == 'on'){
	      wp_parallax_section_title($section_title);
	      }
        endwhile;
        wp_reset_postdata();
        ?>
	   <div class="blogwrap clearfix">	
	    <?php 
		$args = array(
			'cat' => $cat_id,
			'posts_per_page' => 3
			);
		$query = new WP_Query($args);
		if($query->have_posts()):
			$count_service = 1;
            while ($query->have_posts()): $query->the_post();	
            $image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'wpparallax-blog-image', true );
		    ?>
		    	
	            <div class="blogsinfo wow fadeInUp clearfix" data-wow-duration="0.5s">
	                <?php if( has_post_thumbnail() ) { ?>
	                    <div class="blog-image">
	                        <figure>
	                            <a href="<?php the_permalink(); ?>">
	                                <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php the_title(); ?>" />
	                            </a>
	                        </figure>
	                    </div>
	                <?php   } ?>
	                <div class="blog-info clearfix">
	                    <h4>
	                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	                    </h4>
	                    <ul>
	                        <li>
	                            <?php echo esc_html__('BY','wpparallax') ?>
	                            <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
	                               <span><?php the_author(); ?></span>
	                            </a>
	                        </li>
	                        <li>
	                            <?php the_category( ', '); ?>
	                        </li>
	                    </ul> 
	                </div>
	                <div class="blog-time">
	                    <span class="blog-day"><?php the_time( 'd' ); ?></span>
	                    <span class="blog-month"><?php the_time( 'M' ); ?></span>
	                </div>                                                          
	            </div>          
            
	            <?php
		    endwhile;
			wp_reset_postdata();
		endif;
	?>
	</div>
	<div class="clearfix btn-wrap wow fadeInUp">
	<a class="read-more" href="<?php echo esc_url(get_category_link($cat_id))?>"><?php echo esc_html__('View All','wpparallax'); ?></a>
	</div>  	
	</div>