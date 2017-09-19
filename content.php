<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-preview' ); ?>>
    <div class="grid grid--big">
    	<?php
		if( has_post_thumbnail() ) {
			?>
			<div class="grid__item grid__item--lg-span-5">
				<a href="<?php the_permalink(); ?>">
					<?php
					$thumbnail_attrs = array(
						'class' => "img-responsive post-preview__img"
					);
					the_post_thumbnail( 'full', $thumbnail_attrs );
					?>
				</a>
			</div>
			<div class="grid__item grid__item--lg-span-7">
			<?php
		}
		?>
                <div class="m10"></div>
                <header>
                    <span class="text-silver"><?php the_time('j.n.Y'); ?></span>
                    <h2 class="post-preview__title"><a class="link-clean" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                </header>
				<?php the_excerpt(); ?>
                <p class="text-right">
                    <a href="<?php the_permalink(); ?>" class="link-read-more"><?php _e("Read more", 'alestrunda'); ?> <i class="fa fa-double-angle-right"></i></a>
                </p>
        <?php
		if( has_post_thumbnail() ) {
			?>
        	</div><!-- .col-md-7 -->
			<?php
		}
		?>
    </div><!-- .grid -->
</article>