<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-full' ); ?>>
    <div class="grid grid--big">
    	<?php
		if( has_post_thumbnail() ) {
			?>
			<div class="grid__item grid__item--lg-span-6">
				<?php
                $thumbnail_attrs = array(
                    'class' => "img-responsive post-full__img"
                );
                the_post_thumbnail( 'full', $thumbnail_attrs );
                ?>
			</div>
			<div class="grid__item grid__item--lg-span-6">
			<?php
		}
		?>
				<div class="poup-full__content">
					<header>
						<span class="text-silver"><?php the_time('j.n.Y'); ?></span>
						<h2 class="post-full__title"><?php the_title(); ?></h2>
					</header>
					<?php the_content(); ?>
				</div>
        <?php
		if( has_post_thumbnail() ) {
			?>
        	</div><!-- .grid__item -->
			<?php
		}
		?>
    </div><!-- .grid -->
</article>