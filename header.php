<?php 
    get_template_part( 'page-head' );
?>
    
<div id="page-header" class="page-header">
    <div class="container">
        <a href="<?php echo site_url(); ?>" class="site-logo el-relative">
            <div class="decoration-border decoration-border--top decoration-border--small"></div>
            <div class="decoration-border decoration-border--bottom decoration-border--small"></div>
            <img class="site-logo__img" alt="AT logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg">
        </a>
        <h1 class="heading-site-title">Aleš Trunda</h1>
        
        <div id="main-nav-btn" class="nav-btn">
            <i class="fa fa-reorder"></i>
        </div>
        <?php wp_nav_menu(array(
            'theme_location'	=> 'subpages',
            'container'			=> 'nav',
            'container_class'	=> 'nav-main',
            'container_id'		=> 'main-page-nav',
            'link_before'		=> '<div class="nav-main__link">',
            'link_after'		=> '</div>',
        )); ?>
    </div><!-- .container -->
</div><!-- .page-header -->
    