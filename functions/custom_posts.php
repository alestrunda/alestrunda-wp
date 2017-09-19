<?php

/********************************************************************
 * Custom posts - register
 *
 */
function create_custom_posts() {
	register_post_type( 'testimonial',
		array(
      		'labels' => array(
        		'name' => __( 'Testimonials', 'alestrunda' ),
        		'singular_name' => __( 'Testimonial', 'alestrunda' )
      		),
      		'public' => true,
			'has_archive' => false,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'testimonials' ),
    	)
  	);
	
	register_post_type( 'popup_window',
		array(
      		'labels' => array(
        		'name' => __( 'Popup Windows', 'alestrunda' ),
        		'singular_name' => __( 'Popup Window', 'alestrunda' )
      		),
      		'public' => true,
			'has_archive' => false,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'popup_window' ),
			'supports' => array( 'title', 'editor', 'thumbnail' )
    	)
  	);
	
	register_post_type( 'top_slide',
		array(
      		'labels' => array(
        		'name' => __( 'Top Slides', 'alestrunda' ),
        		'singular_name' => __( 'Top Slide', 'alestrunda' )
      		),
      		'public' => true,
			'has_archive' => false,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'top-slides' )
    	)
  	);
	
	register_post_type( 'work',
		array(
      		'labels' => array(
        		'name' => __( 'Works', 'alestrunda' ),
        		'singular_name' => __( 'Work', 'alestrunda' )
      		),
      		'public' => true,
			'has_archive' => false,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'works' ),
			'taxonomies' => array( 'technology' ),
			'supports' => array( 'title', 'editor', 'thumbnail' )
    	)
  	);
	
	$labels = array(
		'name'                       => _x( 'Technologies', 'taxonomy general name', 'alestrunda' ),
		'singular_name'              => _x( 'Technologies', 'taxonomy singular name', 'alestrunda' ),
		'search_items'               => __( 'Search Technologies', 'alestrunda' ),
		'popular_items'              => __( 'Popular Technologies', 'alestrunda' ),
		'all_items'                  => __( 'All Technologies', 'alestrunda' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Technology', 'alestrunda' ),
		'update_item'                => __( 'Update Technology', 'alestrunda' ),
		'add_new_item'               => __( 'Add New Technology', 'alestrunda' ),
		'new_item_name'              => __( 'New Technology Name', 'alestrunda' ),
		'separate_items_with_commas' => __( 'Separate technologies with commas', 'alestrunda' ),
		'add_or_remove_items'        => __( 'Add or remove technologies', 'alestrunda' ),
		'choose_from_most_used'      => __( 'Choose from the most used technologies', 'alestrunda' ),
		'not_found'                  => __( 'No technologies found.', 'alestrunda' ),
		'menu_name'                  => __( 'Technologies', 'alestrunda' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'technology' ),
	);

	register_taxonomy( 'technology', 'work', $args );
}
add_action( 'init', 'create_custom_posts' );



/********************************************************************
 * Custom posts - add fields
 *
 */
function custom_post_fields() {
	//page
	add_meta_box( 'page_detail_meta',
        __( 'Page Options', 'alestrunda' ),
        'display_page_detail_meta',
        'page', 'normal', 'high'
    );

	//testimonials
    add_meta_box( 'testimonial_detail_meta',
        'Testimonial Options',
        'display_testimonial_detail_meta',
        'testimonial', 'normal', 'high'
    );
	
	//top_slides
	add_meta_box( 'top_slides_detail_meta',
        'Top Slide Options',
        'display_top_slides_detail_meta',
        'top_slide', 'normal', 'high'
    );
	
	//work
	add_meta_box( 'work_detail_meta',
        'Work Options',
        'display_work_detail_meta',
        'work', 'normal', 'high'
    );
}
add_action( 'admin_init', 'custom_post_fields' );



/********************************************************************
 * Custom posts - display fields in admin
 *
 */
 
//page
function display_page_detail_meta( $page ) {
	$subheading = esc_html( get_post_meta( $page->ID, 'subheading', true ) );
	?>
    <h4><?php _e( 'Subheading', 'alestrunda' ); ?></h4>
    <p><input type="text" style="width:100%;" name="subheading" value="<?php echo $subheading; ?>"></p>
    <?php
}


//testimonial
function display_testimonial_detail_meta( $testimonial ) {
	$author_detail = esc_html( get_post_meta( $testimonial->ID, 'author_detail', true ) );
	$testimonial_order = esc_html( get_post_meta( $testimonial->ID, 'testimonial_order', true ) );
	?>
    <h4><?php _e( 'Author Detail', 'alestrunda' ); ?></h4>
	<p><input type="text" style="width:100%;" name="author_detail" value="<?php echo $author_detail; ?>"></p>
    <h4><?php _e( 'Testimonial Order', 'alestrunda' ); ?></h4>
    <p><input type="number" style="width:100%;" name="testimonial_order" value="<?php echo $testimonial_order; ?>"></p>
    <?php
}


//top_slides
function display_top_slides_detail_meta( $top_slide ) {
	$order = esc_html( get_post_meta( $top_slide->ID, 'top_slides_order', true ) );
	?>
    <h4><?php _e( 'Slide Order', 'alestrunda' ); ?></h4>
    <p><input type="number" style="width:100%;" name="top_slides_order" value="<?php echo $order; ?>"></p>
    <?php
}


//work
function display_work_detail_meta( $work ) {
	$work_preview = esc_html( get_post_meta( $work->ID, 'work_preview', true ) );
	$img_lightbox = esc_html( get_post_meta( $work->ID, 'img_lightbox', true ) );
	$buy_online = esc_html( get_post_meta( $work->ID, 'buy_online', true ) );
	$buy_online_text = esc_html( get_post_meta( $work->ID, 'buy_online_text', true ) );
	$pages_list = esc_html( get_post_meta( $work->ID, 'pages_list', true ) );
	$live_preview = esc_html( get_post_meta( $work->ID, 'live_preview', true ) );
	$live_preview_nofollow = esc_html( get_post_meta( $work->ID, 'live_preview_nofollow', true ) ) === "true" ? true : false;
	$wordpress = esc_html( get_post_meta( $work->ID, 'wordpress', true ) );
	$rating = esc_html( get_post_meta( $work->ID, 'rating', true ) );
	$rating_text = esc_html( get_post_meta( $work->ID, 'rating_text', true ) );
	$client = esc_html( get_post_meta( $work->ID, 'client', true ) );
	$website = esc_html( get_post_meta( $work->ID, 'website', true ) );
	?>
    <h4><?php _e( 'Work Preview Text', 'alestrunda' ); ?></h4>
    <p><textarea style="width:100%;" name="work_preview"><?php echo $work_preview; ?></textarea></p>
    <h4><?php _e( 'Lightbox Img', 'alestrunda' ); ?></h4>
    <p><input type="text" style="width:100%;" name="img_lightbox" value="<?php echo $img_lightbox; ?>"></p>
    <h4><?php _e( 'Buy Online', 'alestrunda' ); ?></h4>
    <p><input type="text" style="width:100%;" name="buy_online" value="<?php echo $buy_online; ?>"></p>
    <h4><?php _e( 'Buy Online Text', 'alestrunda' ); ?></h4>
    <p><input type="text" style="width:100%;" name="buy_online_text" value="<?php echo $buy_online_text; ?>"></p>
    <h4><?php _e( 'Pages List', 'alestrunda' ); ?></h4>
    <p><input type="text" style="width:100%;" name="pages_list" value="<?php echo $pages_list; ?>"></p>
    <h4><?php _e( 'Live Preview', 'alestrunda' ); ?></h4>
    <p><input type="text" style="width:100%;" name="live_preview" value="<?php echo $live_preview; ?>"></p>
    <h4><?php _e( 'Live Preview No-follow', 'alestrunda' ); ?></h4>
    <p><input type="checkbox" name="live_preview_nofollow" value="true" <?php if($live_preview_nofollow) echo 'checked'; ?>></p>
    <h4><?php _e( 'WordPress', 'alestrunda' ); ?></h4>
    <p><input type="text" style="width:100%;" name="wordpress" value="<?php echo $wordpress; ?>"></p>
    <h4><?php _e( 'Work Rating', 'alestrunda' ); ?></h4>
    <p><input type="number" min="0" max="10" size="10" name="rating" value="<?php echo $rating; ?>"></p>
    <h4><?php _e( 'Work Rating Text', 'alestrunda' ); ?></h4>
    <p><input type="text" style="width:100%;" name="rating_text" value="<?php echo $rating_text; ?>"></p>
    <h4><?php _e( 'Client', 'alestrunda' ); ?></h4>
    <p><input type="text" style="width:100%;" name="client" value="<?php echo $client; ?>"></p>
    <h4><?php _e( 'Website', 'alestrunda' ); ?></h4>
    <p><input type="text" style="width:100%;" name="website" value="<?php echo $website; ?>"></p>
	<?php
}



/********************************************************************
 * Custom posts - save field values
 *
 */
function save_post_meta( $post_id, $post ) {
	//page
	if ( $post->post_type == 'page' ) {
        if ( isset( $_POST['subheading'] ) ) {
            update_post_meta( $post_id, 'subheading', $_POST['subheading'] );
        }
	}
	
	//testimonial
    if ( $post->post_type == 'testimonial' ) {
        if ( isset( $_POST['author_detail'] ) ) {
            update_post_meta( $post_id, 'author_detail', $_POST['author_detail'] );
        }
		if ( isset( $_POST['testimonial_order'] ) ) {
            update_post_meta( $post_id, 'testimonial_order', $_POST['testimonial_order'] );
        }
    }
	
	//top_slide
    if ( $post->post_type == 'top_slide' ) {
        if ( isset( $_POST['top_slides_order'] ) ) {
            update_post_meta( $post_id, 'top_slides_order', $_POST['top_slides_order'] );
        }
	}
	
	//work
	if ( $post->post_type == 'work' ) {
        if ( isset( $_POST['work_preview'] ) ) {
            update_post_meta( $post_id, 'work_preview', $_POST['work_preview'] );
        }
		if ( isset( $_POST['img_lightbox'] ) ) {
            update_post_meta( $post_id, 'img_lightbox', $_POST['img_lightbox'] );
        }
		if ( isset( $_POST['buy_online'] ) ) {
            update_post_meta( $post_id, 'buy_online', $_POST['buy_online'] );
        }
		if ( isset( $_POST['buy_online_text'] ) ) {
            update_post_meta( $post_id, 'buy_online_text', $_POST['buy_online_text'] );
        }
		if ( isset( $_POST['pages_list'] ) ) {
            update_post_meta( $post_id, 'pages_list', $_POST['pages_list'] );
        }
		if ( isset( $_POST['live_preview'] ) ) {
            update_post_meta( $post_id, 'live_preview', $_POST['live_preview'] );
        }
		if ( isset( $_POST['live_preview_nofollow'] ) ) {
            update_post_meta( $post_id, 'live_preview_nofollow', $_POST['live_preview_nofollow'] );
        }
		else {
            update_post_meta( $post_id, 'live_preview_nofollow', "" );
        }
		if ( isset( $_POST['wordpress'] ) ) {
            update_post_meta( $post_id, 'wordpress', $_POST['wordpress'] );
        }
		if ( isset( $_POST['rating'] ) ) {
            update_post_meta( $post_id, 'rating', $_POST['rating'] );
        }
		if ( isset( $_POST['rating_text'] ) ) {
            update_post_meta( $post_id, 'rating_text', $_POST['rating_text'] );
        }
		if ( isset( $_POST['client'] ) ) {
            update_post_meta( $post_id, 'client', $_POST['client'] );
        }
		if ( isset( $_POST['website'] ) ) {
            update_post_meta( $post_id, 'website', $_POST['website'] );
        }
	}
}
add_action( 'save_post', 'save_post_meta', 10, 2 );



/*
 * Custom field for taxonomy technology
 */

function technology_taxonomy_custom_fields($tag) {  
   // Check for existing taxonomy meta for the term you're editing  
    $t_id = $tag->term_id; // Get the ID of the term you're editing  
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check  
	?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="term_meta[technology_show]">Zobrazovat</label>  
        </th>
        <td>
        	<input type="checkbox" name="term_meta[technology_show]" id="term_meta[technology_show]" value="true" <?php if($term_meta['technology_show']) echo "checked"; ?>>
        	<input type="hidden" name="taxonomy_meta_save">
        </td>
    </tr>
    <?php
}  
add_action( 'technology_edit_form_fields', 'technology_taxonomy_custom_fields', 10, 2 );  

//save the changes
function save_taxonomy_custom_fields( $term_id ) {
    if ( isset( $_POST['taxonomy_meta_save'] ) && isset( $_POST['term_meta'] ) ) {  
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_term_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ) {
            if ( isset( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
			else {
                $term_meta[$key] = "";
            }
        }
        //save the option array  
        update_option( "taxonomy_term_$t_id", $term_meta );  
    }
}

add_action( 'edited_technology', 'save_taxonomy_custom_fields', 10, 2 );  
?>
