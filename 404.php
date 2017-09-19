<?php
	get_header();
	?>
    
    <div class="page-title">
        <div class="container">
            <h2 class="heading-page"><?php _e('Page not found'); ?></h2>
        </div>
    </div>

	<section class="section-light section-content--mid">
        <div class="container text-center">
            <div class="m70"></div>
            <h2><?php echo sprintf(__('Sorry, requested page was not found, please continue to the %sfront page%s.', 'alestrunda'), '<a href="' . site_url() . '">', '</a>'); ?></h2>
            <div class="m40"></div>
            <h3><?php echo sprintf(__('In case something seems to be wrong, let me know - %scontact form%s, thanks.', 'alestrunda'), '<a href="' . site_url() . '#contact">', '</a>'); ?></h3>
            <div class="m70"></div>
        </div><!-- .container -->
    </section>
    
    <?php
	get_footer();
?>