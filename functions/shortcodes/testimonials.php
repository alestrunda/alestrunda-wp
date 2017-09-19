<?php

function testimonials_func( $atts ){
    $the_query = new WP_Query( array(
        'post_type' => 'testimonial',
        'meta_key' => 'testimonial_order',
        'orderby' => 'meta_value_num',
    ) );

    if ( $the_query->have_posts() ) {
        ?>
        <div class="container-limit text-center">
            <div id="testimonials-slider">
                <?php
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    ?>
                    <div class="mb50">
                        <div class="citation">
                            <p><?php the_content(); ?></p>
                            <p class="citation__author"><?php the_title(); ?> <span class="citation__author-info">
							<?php
                            $author_detail = get_post_meta( get_the_ID(), 'author_detail', true );
							echo qtrans_use(qtrans_getLanguage(), $author_detail, false);
							?></span></p>
                        </div>
                    </div>
                    <?php
                }
				wp_reset_postdata();
                ?>
            </div><!-- .testimonials-slider -->
        </div><!-- .testimonials -->
        <?php
    }
}

add_shortcode( 'testimonials', 'testimonials_func' );
?>
