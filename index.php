<?php
	get_header( 'index' );
	
	if( function_exists( qtrans_generateLanguageSelectCode ) )
		$language = qtrans_getLanguage();
?>
    <div id="top">
        <div id="page-header" class="page-header page-header--fixed">
            <div class="container">
                <a href="<?php echo site_url(); ?>" class="site-logo el-relative">
                    <div class="decoration-border decoration-border--top decoration-border--small"></div>
                    <div class="decoration-border decoration-border--bottom decoration-border--small"></div>
                    <img class="site-logo__img" alt="AT logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg">
                </a>
                <h1 class="heading-site-title">Aleš Trunda</h1>
                <div id="main-nav-btn" class="nav-btn"><i class="fa fa-reorder"></i></div>
                <nav id="main-page-nav" class="nav-main">
                    <ul id="main-menu-list">
                        <li class="active">
                            <a href="#top"><div class="nav-main__link"><?php _e('Welcome', 'alestrunda'); ?></div></a>
                        </li>
                        <li>
                            <a href="#about"><div class="nav-main__link"><?php _e('About me', 'alestrunda'); ?></div></a>
                        </li>
                        <li>
                            <a href="#portfolio"><div class="nav-main__link"><?php _e('Portfolio', 'alestrunda'); ?></div></a>
                        </li>
                        <li>
                            <a href="#news"><div class="nav-main__link"><?php _e('News', 'alestrunda'); ?></div></a>
                        </li>
                        <li>
                            <a href="#services"><div class="nav-main__link"><?php _e('Services', 'alestrunda'); ?></div></a>
                        </li>
                        <li>
                            <a href="#contact"><div class="nav-main__link"><?php _e('Contact', 'alestrunda'); ?></div></a>
                        </li>
                    </ul>
                </nav><!-- #main-page-nav -->
            </div><!-- .container -->
        </div><!-- #page-header -->
        
        <?php get_template_part( 'flags-container' ); ?>
        
        <section class="section-top">
            <div class="section-top__inner" data-0="background-position: center 0px" data-1000="background-position: center 420px">
                <div class="container container--full">
                    <?php
                    $the_query = new WP_Query( array(
                        'post_type' => 'top_slide',
                        'meta_key'  => 'top_slides_order',
                        'orderby'   => 'meta_value_num',
                        'order' 	=> 'ASC',
                    ) );

                    if ( $the_query->have_posts() ) {
                        ?>
                        <div id="slider-top" class="slider-top">
                            <?php
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                ?>
                                <div class="slider-top__slide">
                                    <div class="heading-box heading-box--bg heading-box--offset-bottom">
                                        <div class="decoration-border decoration-border--white decoration-border--top decoration-border--mid"></div>
                                        <div class="decoration-border decoration-border--white decoration-border--bottom decoration-border--mid"></div>
                                        <h1 class="heading-box__title--huge text-white"><?php the_title(); ?></h1>
                                    </div>
                                    <br>
                                    <?php the_content(); ?>
                                </div><!-- .slider-top__slide -->
                                <?php
                            }
                            wp_reset_postdata();
                            ?>
                        </div><!-- .slider-top -->
                        <?php
                    }
                    ?>
                </div><!-- .container -->
                <div class="section-top__bottom">
                    <div class="container">
                        <a class="button-more scroll-to" href="#about"><?php _e('Explore', 'alestrunda'); ?> <i class="button-more__icon fa fa-chevron-down"></i></a>
                    </div>
                </div>
            </div><!-- .section-top__inner -->
        </section>
    </div><!-- #top -->

	<?php
	global $post;

	$post = get_page_by_path( 'about' );
	if( $post ) {
		setup_postdata( $post );
		?>
        <section id="about">
            <div class="section-light section-content">
                <div class="container">
                    <div class="text-center">
                        <header class="heading-box">
                            <div class="decoration-border decoration-border--top decoration-border--tiny"></div>
                            <div class="decoration-border decoration-border--bottom decoration-border--tiny"></div>
                            <h1 class="heading-box__title"><?php the_title(); ?></h1>
                        </header>
                    </div>
                    <?php the_content(); ?>
                </div><!-- .container -->
            </div><!-- .section-light -->
        </section><!-- #about -->
    	<?php
		wp_reset_postdata();
	}


	$post = get_page_by_path( 'development' );
	if( $post ) {
		setup_postdata( $post );
		?>
        <section id="development" class="bg-parallax bg-development" data-stellar-background-ratio="0.4">
            <div class="section-dark section-content">
                <div class="container text-center">
                    <header class="heading-box">
                        <div class="decoration-border decoration-border--top decoration-border--tiny"></div>
                        <div class="decoration-border decoration-border--bottom decoration-border--tiny"></div>
                        <h1 class="heading-box__title"><?php the_title(); ?></h1>
                    </header>
                    <?php the_content(); ?>
                </div><!-- .container -->
            </div><!-- .section-dark -->
        </section><!-- #development -->
    	<?php
		wp_reset_postdata();
	}
    
	
	$post = get_page_by_path( 'portfolio' );
	if( $post ) {
		setup_postdata( $post );
		?>
        <section id="portfolio">
            <div class="section-light section-content">
                <div class="container text-center">
                    <header class="heading-box mb0">
                        <div class="decoration-border decoration-border--top decoration-border--tiny"></div>
                        <div class="decoration-border decoration-border--bottom decoration-border--tiny"></div>
                        <h1 class="heading-box__title"><?php the_title(); ?></h1>
                    </header>
                    <?php
                    $page_subheading = get_post_meta( get_the_ID(), 'subheading', true );
                    $page_subheading = qtrans_use($language, $page_subheading, false);	//apply translation
                    if($page_subheading)
                        echo '<h3>' . $page_subheading . '</h3>';
                    ?>
                </div><!-- .container -->
                <?php the_content(); ?>
            </div><!-- .section-light -->
        </section><!-- #portfolio -->
    	<?php
		wp_reset_postdata();
	}


	$post = get_page_by_path( 'stats' );
	if( $post ) {
		setup_postdata( $post ); 
		?>
        <section id="stats" class="bg-parallax bg-stats" data-stellar-background-ratio="0.4">
            <div class="section-dark section-content">
                <div class="container text-center">
                    <header class="heading-box">
                        <div class="decoration-border decoration-border--top decoration-border--tiny"></div>
                        <div class="decoration-border decoration-border--bottom decoration-border--tiny"></div>
                        <h1 class="heading-box__title"><?php the_title(); ?></h1>
                    </header>
                	<?php the_content(); ?>
                </div><!-- .container -->
            </div><!-- .section-dark -->
        </section><!-- #stats -->
    	<?php
		wp_reset_postdata();
	}

    
	$post = get_page_by_path( 'latest-news' );
	if( $post ) {
		setup_postdata( $post );
		?>
        <section id="news">
            <div class="section-light section-content">
                <div class="container">
                    <div class="text-center">
                        <header class="heading-box">
                            <div class="decoration-border decoration-border--top decoration-border--tiny"></div>
                            <div class="decoration-border decoration-border--bottom decoration-border--tiny"></div>
                            <h1 class="heading-box__title"><?php the_title(); ?></h1>
                        </header>
                    </div>
                    
                    <?php the_content(); ?>
                    
                    <div class="text-center">
                   		<a class="link-box" href="<?php echo get_category_link( get_category( 2 )); ?>"><?php _e( 'All news', 'alestrunda' ); ?></a>
                	</div>
                </div><!-- .container -->
            </div><!-- .section-light -->
        </section><!-- #news -->
    	<?php
		wp_reset_postdata();
	}
	
	
	$post = get_page_by_path( 'citation' );
	if( $post ) {
		setup_postdata( $post ); 
		?>
        <div id="citation" class="bg-parallax bg-citation" data-stellar-background-ratio="0.4">
            <div class="section-dark section-content">
                <div class="container text-center">
                	<?php the_content(); ?>
                </div><!-- .container -->
            </div><!-- .section-dark -->
        </div><!-- #citation -->
    	<?php
		wp_reset_postdata();
	}
	
	
	$post = get_page_by_path( 'services' );
	if( $post ) {
		setup_postdata( $post ); 
		?>
        <section id="services">
            <div class="section-light section-content">
                <div class="container">
                    <div class="text-center">
                        <header class="heading-box mb0">
                            <div class="decoration-border decoration-border--top decoration-border--tiny"></div>
                            <div class="decoration-border decoration-border--bottom decoration-border--tiny"></div>
                            <h1 class="heading-box__title"><?php the_title(); ?></h1>
                        </header>
                        <?php
                        $page_subheading = get_post_meta( get_the_ID(), 'subheading', true );
						$page_subheading = qtrans_use($language, $page_subheading, false);	//apply translation
						if($page_subheading)
							echo '<h3>' . $page_subheading . '</h3>';
						?>
                    </div>
                    <?php the_content(); ?>
                </div><!-- .container -->
            </div><!-- .section-light -->
        </section><!-- #portfolio -->
    	<?php
		wp_reset_postdata();
	}
    

	$post = get_page_by_path( 'additional-info' );
	if( $post ) {
		setup_postdata( $post ); 
		?>
        <section id="addition" class="bg-addition bg-fixed">
            <div class="section-dark section-content section-content--bottom-smaller text-gray-light">
                <div class="container">
                    <div class="text-center">
                        <header class="heading-box">
                            <div class="decoration-border decoration-border--top decoration-border--tiny"></div>
                            <div class="decoration-border decoration-border--bottom decoration-border--tiny"></div>
                            <h1 class="heading-box__title"><?php the_title(); ?></h1>
                        </header>
                    </div>
                    <?php the_content(); ?>
                </div><!-- .container -->
            </div><!-- .section-dark -->
        </section><!-- #article -->
    	<?php
		wp_reset_postdata();
	}
    
	
	$post = get_page_by_path( 'testimonials' );
	if( $post ) {
		setup_postdata( $post ); 
		?>
        <section id="testimonials">
            <div class="section-light section-content">
                <div class="container">
                    <div class="text-center">
                        <header class="heading-box">
                            <div class="decoration-border decoration-border--top decoration-border--tiny"></div>
                            <div class="decoration-border decoration-border--bottom decoration-border--tiny"></div>
                            <h1 class="heading-box__title"><?php the_title(); ?></h1>
                        </header>
                    </div>
                    <?php the_content(); ?>
                </div><!-- .container -->
            </div><!-- .section-light -->
        </section><!-- #testimonials -->
    	<?php
		wp_reset_postdata();
	}
    ?>
    
    
    
	<div id="logos">
    	<div class="section-extra-dark">
            <div class="container text-center">
            	<div id="slider-logos" class="slick--dots-right slick--dots-small slick--dots-fade slick--dots-white">
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="CSS3">
                            <img class="logo-single__img" alt="CSS3" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/css3.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="HTML5">
                            <img class="logo-single__img" alt="HTML5" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/html5.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="jQuery">
                            <img class="logo-single__img" alt="jQuery" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/jquery.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="JavaScript">
                            <img class="logo-single__img" alt="JavaScript" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/js.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="ES6">
                            <img class="logo-single__img" alt="ES6" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/es6.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="Babel">
                            <img class="logo-single__img" alt="Babel" src="<?php echo get_template_directory_uri(); ?>/images/logos/babel.png">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="React.js">
                            <img class="logo-single__img" alt="React.js" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/react.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="Redux React FW">
                            <img class="logo-single__img" alt="Redux" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/redux.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="Bootstrap">
                            <img class="logo-single__img" alt="Bootstrap" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/bootstrap.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="Sass">
                            <img class="logo-single__img" alt="Sass" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/sass.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="Gulp">
                            <img class="logo-single__img" alt="Gulp" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/gulp.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="Git">
                            <img class="logo-single__img" alt="Git" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/git.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="npm">
                            <img class="logo-single__img" alt="npm" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/npm.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="webpack">
                            <img class="logo-single__img" alt="webpack" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/webpack.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="WordPress">
                            <img class="logo-single__img" alt="WordPress" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/wordpress.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="WooCommerce">
                            <img class="logo-single__img" alt="WooCommerce" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/woocommerce.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="Redux Framework">
                            <img class="logo-single__img" alt="Redux WP Framework" src="<?php echo get_template_directory_uri(); ?>/images/logos/redux_wp.png">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="php">
                            <img class="logo-single__img" alt="php" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/php.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="Modernizr">
                            <img class="logo-single__img" alt="Modernizr" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/modernizr.svg">
                        </div>
                    </div>
                    <div class="slide">
                        <div class="logo-single tooltip tooltip--top tooltip--dark" data-title="Photoshop">
                            <img class="logo-single__img" alt="Photoshop" height="45" src="<?php echo get_template_directory_uri(); ?>/images/logos/photoshop.svg">
                        </div>
                    </div>
          		</div><!-- #slider-logos -->
            </div><!-- .container -->
      	</div><!-- .section-extra-dark -->
    </div><!-- #clients -->
    
    
    <?php
	$post = get_page_by_path( 'contact' );
	if( $post ) {
		setup_postdata( $post ); 
		?>
        <section id="contact" class="bg-contact bg-fixed">
            <div class="section-dark section-content section-content--bottom-smaller">
                <div class="container">
                    <div class="text-center">
                        <header class="heading-box">
                            <div class="decoration-border decoration-border--top decoration-border--tiny"></div>
                            <div class="decoration-border decoration-border--bottom decoration-border--tiny"></div>
                            <h1 class="heading-box__title"><?php the_title(); ?></h1>
                        </header>
                    </div>
                    <?php the_content(); ?>
                </div><!-- .container -->
            </div><!-- .section-dark -->
        </section><!-- #contact -->
    	<?php
		wp_reset_postdata();
	}
	?>
	
	<?php
    $the_query = new WP_Query( array(
		'post_type' => 'popup_window',
		'post_status' => 'publish',
		'posts_per_page' => -1
	));
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			?>
				<div id="popup-<?php the_title(); ?>" class="popup-window paragraphs-big">
					<div class="popup-window-close"><i class="fa fa-close"></i></div>
					<?php the_content(); ?>
				</div>
			<?php
		}
		wp_reset_postdata();
	}
	?>

	<?php
	get_footer( 'index' );
?>