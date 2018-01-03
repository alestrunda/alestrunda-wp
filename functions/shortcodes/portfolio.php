<?php

function portfolio_func( $atts ){
	$lang = qtrans_getLanguage();
	
	$params = shortcode_atts( array(
        'num' => -1
    ), $atts );
	?>
    <div class="text-center">
        <ul class="list-filters" id="works-filters">
            <li class="list-filters__item active"><a class="list-filters__link isotope-filter" data-filter="*" href="#"><?php _e( "All", 'alestrunda' ); ?></a></li>
            <?php
            $work_taxonomies = get_terms( 'technology' );
            foreach($work_taxonomies as $work_tax) {
				$filter_class = "list-filters__item";
				$work_name = qtrans_use($lang, $work_tax->name, false);
				$options = get_option( "taxonomy_term_" . $work_tax->term_id );
				if(!isset($options['technology_show']) || $options['technology_show'] !== "true")
					$filter_class .= " list-filters__item--secondary";
                echo '<li class="' . $filter_class . '"><a class="list-filters__link isotope-filter" data-filter=".' . $work_tax->slug . '" href="#">' . $work_name . '</a></li>';
				echo "\n";
            }
            ?>
        </ul>
        <div>
        	<a href="#" id="show-all-works-filters"><?php _e("Show all filters", 'alestrunda'); ?></a>
        </div>
        <div class="m60"></div>
    </div><!-- .text-center -->
    
    <?php
    $the_query = new WP_Query( array(
            'post_type' => 'work',
            'posts_per_page' => $params['num']
        )
    );

    if ( $the_query->have_posts() ) {
        ?>
        <div id="works">
            <?php
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $work_tags = wp_get_post_terms( get_the_ID(), 'technology' );
                $work_tags_str = "";
                foreach($work_tags as $work_tag) {
                    $work_tags_str .= $work_tag->slug . ' ';
                }
                ?>
                <div class="work-item <?php echo trim($work_tags_str); ?>">
                    <div class="work-item__wrapper">
                        <?php
                        $work_img_src = wp_get_attachment_url( get_post_thumbnail_id() );
                        $work_lightbox = get_post_meta( get_the_ID(), 'img_lightbox', true );
                        ?>
                        <div class="work-item__preview" style="background-image: url('<?php echo $work_img_src; ?>');"></div>
                        <div class="work-item__content">
                            <div class="decoration-border decoration-border--top"></div>
                            <div class="decoration-border decoration-border--bottom"></div>
                            <h4 class="work-item__title"><?php the_title(); ?></h4>
                            <p><em>
                                <?php
                                $work_preview = get_post_meta( get_the_ID(), 'work_preview', true );
                                echo qtrans_use($lang, $work_preview, false);
                                ?>
                            </em></p>
                            
                            <div class="mt10">
                                <?php if( $work_lightbox ): ?>
                                    <a class="icon-box icon-box--hover tooltip" href="<?php echo $work_lightbox; ?>" data-title="<?php _e('Full picture', 'alestrunda'); ?>" data-lightbox="work-<?php echo get_the_ID(); ?>"><i class="icon-box__icon fa fa-search"></i></a>
                                <?php endif; ?>
                                
                                <?php
                                $buy_online = get_post_meta( get_the_ID(), 'buy_online', true );
                                $buy_online_text = get_post_meta( get_the_ID(), 'buy_online_text', true );
                                $buy_online_text = qtrans_use( $lang, $buy_online_text, false );
                                $buy_online_scroll = $buy_online[0] === '#' ? true : false;
                                if( $buy_online_text === "" )
                                    $buy_online_text = __( 'Buy online', 'alestrunda' );
                                if( $buy_online ) {
                                    ?>
                                    <a class="icon-box icon-box--hover tooltip" href="<?php echo $buy_online; ?>" <?php if( $buy_online_scroll ) echo 'class="scroll-to"'; ?> data-title="<?php echo $buy_online_text; ?>"><i class="icon-box__icon fa fa-usd"></i></a>
                                    <?php
                                }
                                
                                $pages_list = get_post_meta( get_the_ID(), 'pages_list', true );
                                if( $pages_list ) {
                                    ?>
                                    <a class="icon-box icon-box--hover tooltip" href="<?php echo $pages_list; ?>" data-title="<?php _e('List of all pages', 'alestrunda'); ?>"><i class="icon-box__icon fa fa-file-text-o"></i></a>
                                    <?php
                                }
                                
                                $live_preview = get_post_meta( get_the_ID(), 'live_preview', true );
                                $live_preview_nofollow = get_post_meta( get_the_ID(), 'live_preview_nofollow', true ) === 'true' ? true : false;
                                if( $live_preview ) {
                                    ?>
                                    <a class="icon-box icon-box--hover tooltip" href="<?php echo $live_preview; ?>" data-title="<?php _e('Live preview', 'alestrunda'); ?>" <?php if($live_preview_nofollow) echo 'rel="nofollow"'; ?>><i class="icon-box__icon fa fa-share"></i></a>
                                    <?php
                                }

                                $github = get_post_meta( get_the_ID(), 'github', true );
                                if( $github ) {
                                    ?>
                                    <a class="icon-box icon-box--hover tooltip" href="<?php echo $github; ?>" data-title="<?php _e('Github', 'alestrunda'); ?>"><i class="icon-box__icon fa fa-github"></i></a>
                                    <?php
                                }
                                
                                $wordpress = get_post_meta( get_the_ID(), 'wordpress', true );
                                if( $wordpress ) {
                                    ?>
                                    <a class="icon-box icon-box--hover tooltip" href="<?php echo $wordpress; ?>" data-title="<?php _e('WordPress live preview', 'alestrunda'); ?>"><i class="icon-box__icon fa fa-wordpress"></i></a>
                                    <?php
                                }
                                ?>
                                <a class="icon-box icon-box--hover tooltip" href="<?php the_permalink(); ?>" data-title="<?php _e('Details', 'alestrunda'); ?>"><i class="icon-box__icon fa fa-info"></i></a>
                                <?php
                                $rating = get_post_meta( get_the_ID(), 'rating', true );
                                $rating_text = get_post_meta( get_the_ID(), 'rating_text', true );
                                $rating_text = qtrans_use( $lang, $rating_text, false );
                                if($rating) {
                                    ?>
                                    <div class="work-item__rating tooltip tooltip--left" data-title="<?php echo $rating_text; ?>">
                                        <a class="rating rating--<?php echo $rating; ?>"></a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div><!-- .work-item__content -->
                    </div><!-- .work-item__wrapper -->
                </div><!-- .work-item -->
                <?php
            }
            wp_reset_postdata();
            ?>
        </div><!-- #works -->
        <?php
    }
}

add_shortcode( 'portfolio', 'portfolio_func' );
?>
