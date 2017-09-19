<?php
	get_header();
	?>
    
    <div class="page-title">
        <div class="container">
            <h2 class="heading-page"><?php the_title(); ?></h2>
        </div>
    </div>

	<section>
        <div class="section-light section-content section-content--mid section-content--top-small section-content--sm-bottom-small">
            <div class="container">
				<?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'content-work', get_post_format() );
        		endwhile;
				?>
            </div><!-- .container -->
        </div><!-- .section-light -->
    </section>
    
    <?php
	get_footer();
?>