<?php
$lang = qtrans_getLanguage();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if( has_post_thumbnail() ) {
			?>
			<div class="grid grid--big">
				<div class="grid__item grid__item--lg-span-7">
					<?php
					$thumbnail_attrs = array(
						'class' => "img-responsive"
					);
					the_post_thumbnail( 'full', $thumbnail_attrs );
					?>
                    <div class="margin-30"></div>
				</div>
				<div class="grid__item grid__item--lg-span-5 grid__item--break-md-30">
					<?php the_content(); ?>
                    <div class="m20"></div>
                    <h4 class="text-uppercase"><?php _e( 'Project Specs', 'alestrunda' ); ?></h4>
                    <div class="m5"></div>
                    <strong class="text-black"><?php _e( 'Date', 'alestrunda' ); ?>:</strong>
                    <?php
                    echo the_time('j.n.Y') . '<br>';
					?>
                    <div class="m5"></div>
                    <?php
									
					$technologies = wp_get_post_terms( get_the_id(), 'technology' );
					if( $technologies ) {
						?>
                    	<strong class="text-black"><?php _e( 'Technology', 'alestrunda' ); ?>:</strong>
                        <?php
						$out = "";
						foreach( $technologies as $tech ) {
							$tech_name = qtrans_use($lang, $tech->name, false);
							$out .= ' ' . $tech_name . ',';
						}
						echo trim($out, ',') . '<br>';
						?>
                        <div class="m5"></div>
                        <?php
					}
					
					$client = get_post_meta( get_the_ID(), 'client', true );
					if( $client ) {
						?>
                        <strong class="text-black"><?php _e( 'Client', 'alestrunda' ); ?>:</strong>
                        <?php
						echo $client . '<br>';
						?>
                        <div class="m5"></div>
                        <?php
					}					
					
					$website = get_post_meta( get_the_ID(), 'website', true );
					if( $website ) {
						?>
                        <strong class="text-black"><?php _e( 'Website', 'alestrunda' ); ?>:</strong>
                        <?php
							echo '<a href="' . $website . '">' . $website . '</a><br>';
						?>
                        <div class="m5"></div>
                        <?php
					}					
					?>
				</div><!-- .grid__item -->
			</div><!-- .grid -->
			<?php
		}
		else {
			the_content();
		}
	?>
</article>