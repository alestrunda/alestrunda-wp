<?php

function latest_news_func( $atts ){
    $the_query = new WP_Query( array(
            'category_name' => 'news',
            'posts_per_page' => 3
        )
    );

    if ( $the_query->have_posts() ) {
		$anim_delay = 0;
        ?>
        <div class="grid">
            <?php
            $counter = 0;
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
				$anim_delay += 150;
				?>
                <div class="grid__item grid__item--lg-span-4 onscroll-animate animated <?php if( $counter !== 0 ) echo "grid__item--break-md-20" ?>" data-delay="<?php echo $anim_delay; ?>">
                    <div class="post-article">
                    	<?php
						if( has_post_thumbnail() ) {
							?>
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                $thumbnail_attrs = array(
                                    'class' => "post-article__photo img-responsive"
                                );
                                the_post_thumbnail( 'full', $thumbnail_attrs );
                                ?>
                            </a>
                        	<?php
						}
						?>
                        <h2 class="post-article__title"><a class="link-clean" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <ul class="list-tags">
                            <li class="list-tags__item"><i class="list-tags__icon fa fa-pencil"></i> <?php echo get_the_author_meta( 'first_name' ) . ' ' . get_the_author_meta( 'last_name' ); ?></li>
                            <li class="list-tags__item"><i class="list-tags__icon fa fa-clock-o"></i> <?php echo the_time('j.n.Y'); ?></li>
                        </ul>
            
            			<?php the_excerpt(); ?>
                        <p class="text-right">
                            <a href="<?php the_permalink(); ?>" class="link-read-more"><?php _e("Read more", 'alestrunda'); ?> <i class="fa fa-double-angle-right"></i></a>
                        </p>
                    </div><!-- .post-article -->
                </div><!-- .grid__item -->
                <?php
                $counter++;
			}
			wp_reset_postdata();
		?>
        </div><!-- .grid -->
        <?php
	}
}

add_shortcode( 'latest-news', 'latest_news_func' );
?>
