<?php
/**
 * Template Name: Page portfolio
 *
 */
 
	get_header();
	?>
    
    <div class="page-title">
        <div class="container">
            <h2 class="heading-page"><?php the_title(); ?></h2>
        </div>
    </div>

	<section>
        <div class="section-light section-content section-content--small">
        	<?php
			$post = get_page_by_path( 'portfolio' );
			if( $post ) {
				setup_postdata( $post );
				the_content();
				wp_reset_postdata();
			}
			?>
        </div><!-- .section-light -->
    </section>
    
    <?php
	get_footer();
?>