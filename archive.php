<?php
	get_header();
	?>
    
    <div class="page-title">
        <div class="container">
            <h2 class="heading-page"><?php the_archive_title(); ?></h2>
        </div>
    </div>

	<section class="section-light section-content--mid">
		<div class="container">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
				endwhile;
				
				the_posts_pagination( array(
					'prev_text'          => __( 'Prev', 'alestrunda' ),
					'next_text'          => __( 'Next', 'alestrunda' ),
				) );
			}
			else {
				_e( 'No posts', 'alestrunda' );
			}
			?>
		</div><!-- .container -->
    </section>
    
    <?php
	get_footer();
?>