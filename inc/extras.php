
<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Ben_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
// function theme_body_classes( $classes ) {
// 	// Adds a class of group-blog to blogs with more than 1 published author.
// 	if ( is_multi_author() ) {
// 		$classes[] = 'group-blog';
// 	}

// 	// Adds a class of hfeed to non-singular pages.
// 	if ( ! is_singular() ) {
// 		$classes[] = 'hfeed';
// 	}

// 	return $classes;
// }
// add_filter( 'body_class', 'theme_body_classes' );

// Register options page for ACF field
if( function_exists('acf_add_options_page') ) {
	
    acf_add_options_page(array(
      'page_title' 	=> 'Theme General Settings',
      'menu_title'	=> 'Theme Settings',
      'menu_slug' 	=> 'theme-general-settings',
      'capability'	=> 'edit_posts',
      'redirect'		=> false
    ));
}

//Styling login form
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/style-login.css' );
    // wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );


// disable for post types
// add_filter('use_block_editor_for_post_type', '__return_false', 10);
// add_action('init', 'my_remove_editor_from_post_type');
// function my_remove_editor_from_post_type() {
// 	remove_post_type_support( 'page', 'editor' );
// }

//add categories and tages for pages
function add_categories_to_pages() {
	register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'add_categories_to_pages' );

add_post_type_support( 'page', 'excerpt' );

/**
 * Function that will automatically update ACF field groups via JSON file update.
 * 
 * @link http://www.advancedcustomfields.com/resources/synchronized-json/
 */
function jp_sync_acf_fields() {

	// vars
	$groups = acf_get_field_groups();
	$sync 	= array();

	// bail early if no field groups
	if( empty( $groups ) )
		return;

	// find JSON field groups which have not yet been imported
	foreach( $groups as $group ) {
		
		// vars
		$local 		= acf_maybe_get( $group, 'local', false );
		$modified 	= acf_maybe_get( $group, 'modified', 0 );
		$private 	= acf_maybe_get( $group, 'private', false );

		// ignore DB / PHP / private field groups
		if( $local !== 'json' || $private ) {
			
			// do nothing
			
		} elseif( ! $group[ 'ID' ] ) {
			
			$sync[ $group[ 'key' ] ] = $group;
			
		} elseif( $modified && $modified > get_post_modified_time( 'U', true, $group[ 'ID' ], true ) ) {
			
			$sync[ $group[ 'key' ] ]  = $group;
		}
	}

	// bail if no sync needed
	if( empty( $sync ) )
		return;

	if( ! empty( $sync ) ) { //if( ! empty( $keys ) ) {
		
		// vars
		$new_ids = array();
		
		foreach( $sync as $key => $v ) { //foreach( $keys as $key ) {
			
			// append fields
			if( acf_have_local_fields( $key ) ) {
				
				$sync[ $key ][ 'fields' ] = acf_get_local_fields( $key );
				
			}

			// import
			$field_group = acf_import_field_group( $sync[ $key ] );
		}
	}

}
add_action( 'admin_init', 'jp_sync_acf_fields' );

// add_action('acf/init', 'my_acf_init');
// function my_acf_init() {
//     acf_update_setting('show_updates', true);
//     acf_update_setting('google_api_key', 'AIzaSyBUcMvTzs7_Oltb0NwiYrPDURzLBidQJ5Y');
// }

//Saving points
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $path;
    
}
//Loading points
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $paths;
    
}

//** *Enable upload for webp image files.*/
function webp_upload_mimes($existing_mimes) {
	$existing_mimes['webp'] = 'image/webp';
	return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');


/**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the tempalte as $template_args array
 * @param string filepart
 * @param mixed wp_args style argument list
 * https://wordpress.stackexchange.com/questions/176804/passing-a-variable-to-get-template-part
 */
function get_template_part_args( $file, $template_args = array(), $cache_args = array() ) {
    $template_args = wp_parse_args( $template_args );
    $cache_args = wp_parse_args( $cache_args );
    if ( $cache_args ) {
        foreach ( $template_args as $key => $value ) {
            if ( is_scalar( $value ) || is_array( $value ) ) {
                $cache_args[$key] = $value;
            } else if ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
                $cache_args[$key] = call_user_method( 'get_id', $value );
            }
        }
        if ( ( $cache = wp_cache_get( $file, serialize( $cache_args ) ) ) !== false ) {
            if ( ! empty( $template_args['return'] ) )
                return $cache;
            echo $cache;
            return;
        }
    }
    $file_handle = $file;
    do_action( 'start_operation', 'hm_template_part::' . $file_handle );
    if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) )
        $file = get_stylesheet_directory() . '/' . $file . '.php';
    elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) )
        $file = get_template_directory() . '/' . $file . '.php';
    ob_start();
    $return = require( $file );
    $data = ob_get_clean();
    do_action( 'end_operation', 'hm_template_part::' . $file_handle );
    if ( $cache_args ) {
        wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
    }
    if ( ! empty( $template_args['return'] ) )
        if ( $return === false )
            return false;
        else
            return $data;
    echo $data;
}

//Wp ajax init
add_action( 'wp_head', 'my_wp_ajaxurl' );
function my_wp_ajaxurl() {
	$url = parse_url( home_url( ) );
	if( $url['scheme'] == 'https' ){
	   $protocol = 'https';
	}        
	else{
	    $protocol = 'http'; 
	}
    ?>
    <?php global $wp_query; ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url( 'admin-ajax.php', $protocol ); ?>';
    </script>
    <?php
}
/* Disable WordPress Admin Bar for all users */
// add_filter( 'show_admin_bar', '__return_false' );

// Add Body Class
add_filter( 'body_class', 'custom_acf_body_class' );
function custom_acf_body_class( $classes ) {
	if ( $body_class = get_field( 'body_class', get_queried_object_id() ) ) {
		$body_class = esc_attr( trim( $body_class ) );
		$classes[] = $body_class;
	}
	return $classes;
}

// Button shortcode
function cta_link_func( $atts ) {
	$a = shortcode_atts( array(
		'href' => '#',
		'title' => '',
		'class' => '',
        'target'=> '',
        'download' => ''
	), $atts );
    if ($a['download']) : 
        $path_parts = pathinfo($a['href']);
        $download = 'download="' . $path_parts['basename'] . '"';
    endif; 
	return '<a  href="' . $a['href'] . '" 
                    class="' . $a['class'] . '" 
                    target="' . $a['target'] . '" ' . $download . '>' . $a['title'] .'</a>';
}
add_shortcode( 'cta_link', 'cta_link_func' );



function get_nearby_locations($lat, $long, $distance = 50, $offset, $items_per_page) {
    global $wpdb;
	$sql = "SELECT DISTINCT    
        map_lat.post_id,
        map_lat.meta_key,
        map_lat.meta_value as lat,
        map_lng.meta_value as lng,
        ((ACOS(SIN($lat * PI() / 180) * SIN(map_lat.meta_value * PI() / 180) + COS($lat * PI() / 180) * COS(map_lat.meta_value * PI() / 180) * COS(($long - map_lng.meta_value) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance,
        wp_posts.post_title
    FROM 
        $wpdb->postmeta AS map_lat
        LEFT JOIN $wpdb->postmeta as map_lng ON map_lat.post_id = map_lng.post_id
        INNER JOIN wp_posts ON $wpdb->posts.ID = map_lat.post_id
    WHERE map_lat.meta_key = 'lat' AND map_lng.meta_key = 'lng' 
	 AND wp_posts.post_status='publish'
    HAVING distance < $distance AND distance > 0
    ORDER BY distance ASC LIMIT $items_per_page;";
	$nearbyLocations = $wpdb->get_results( $sql );
	/*echo 'RES:<pre>';
	print_r($nearbyLocations);
	echo '</pre>';*/
    
	if ($nearbyLocations) {
		$removing = [];
		$result = [];
		if ($not_head != 0 ) {
			foreach ($nearbyLocations as $key => $location) {
				if ( !get_field("document", $location->post_id) ):
				array_push($removing, $key);
				else:
				array_push($result, $location);
				endif;
			}
			return $result;                
		} else {
			return $nearbyLocations;
		}
	}
	return $nearbyLocations;
}

// Build neighborhood list
function build_neighborhood_walking( $locations ) {
	ob_start();
	$ave_time_per_mile = 18.5;
	foreach( $locations as $location ): ?>
	<li>
		<span class="location-name"><?php echo $location->post_title; ?></span><span class="sep"></span><span class="location-time"><?php echo ceil($location->distance*$ave_time_per_mile); ?> Minute Walk</span>
	</li>
	<?php endforeach; 
	return ob_get_clean();
}

function build_neighborhood_drive( $locations ) {
	ob_start();
	$ave_time_per_mile = 1.5;
	foreach( $locations as $location ): ?>
	<li>
		<span class="location-name"><?php echo $location->post_title; ?></span><span class="sep"></span><span class="location-time"><?php echo ceil($location->distance*$ave_time_per_mile); ?> Minute Drive</span>
	</li>
	<?php endforeach; 
	return ob_get_clean();
}
// Ajax Locations
add_action('wp_ajax_loadAjaxLocations', 'loadAjaxLocations_handler');
add_action('wp_ajax_nopriv_loadAjaxLocations', 'loadAjaxLocations_handler');

function loadAjaxLocations_handler() {
	$items_per_page = 7;
	$radius = 50;
	$offset = 0;
	if (!empty($_POST['lat']) && !empty($_POST['lng'])):
		$locations = get_nearby_locations($_POST['lat'], $_POST['lng'], $radius, $offset, $items_per_page);
	endif;
	$neighborhood_walking = build_neighborhood_walking( $locations );
	$neighborhood_drive = build_neighborhood_drive( $locations );

	ob_start();
	if( $nposts = get_field( 'posts', $_POST['id'] ) ): 
		foreach( $nposts as $npost ): ?>
		<a href="<?php echo get_the_permalink( $npost ); ?>" class="home-map__post">
			<div class="home-map__post--img">
				<img src="<?php echo get_the_post_thumbnail_url( $npost ); ?>" alt="<?php echo get_the_title( $npost ); ?>">
			</div>
			<h6 class="home-map__post--title"><?php echo get_the_title( $npost ); ?></h6>
		</a>
		<?php endforeach; 
	endif; 
	$res->neighborhood_posts = ob_get_clean();
	$res->neighborhood_walking = $neighborhood_walking;
	$res->neighborhood_drive = $neighborhood_drive;
	
	echo json_encode($res);
	die;
}


// Ajax Neighborhood
add_action('wp_ajax_loadAjaxNeighborhood', 'loadAjaxNeighborhood_handler');
add_action('wp_ajax_nopriv_loadAjaxNeighborhood', 'loadAjaxNeighborhood_handler');

function loadAjaxNeighborhood_handler() {
	ob_start(); 
	$args = array(
		'post_type' => 'location',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);
	if( !empty($_POST['cat']) ) {
		$args['tax_query'] = array( 
			array(
				'taxonomy' => 'location_category',
				'field' => 'slug',
				'terms' => $_POST['cat']
			)
			);
	}
	$locations = new WP_Query( $args ); 
	if( $locations->have_posts(  ) ): 
		while( $locations->have_posts() ): $locations->the_post(); 
			$id = get_the_ID(); ?>
			<div class="location-card location-card--location">
				<div class="location-card__img gradient-overlay">
					<img src="<?php echo get_the_post_thumbnail_url( $id ); ?>" 
						alt="<?php echo get_the_title( $id ); ?>">
					<h6 class="location-card__title"><?php echo get_the_title( $id ); ?></h6>
				</div>
				<div class="location-card__distance">
					<span class="label">Distance</span>
					<?php $location = get_field( 'location', $id );
					$distance = round(((ACOS(SIN($_POST['lat'] * PI() / 180) * SIN($location['lat'] * PI() / 180) + COS($_POST['lat'] * PI() / 180) * COS($location['lat'] * PI() / 180) * COS(($_POST['lng'] - $location['lng']) * PI() / 180)) * 180 / PI()) * 60 * 1.1515)); ?>
					<span class="value"><?php echo $distance; ?> Miles</span>
				</div>
				<a href="<?php echo get_the_permalink( $id ); ?>" class="btn btn--primary location-card__cta">
					More Info
				</a>
			</div>
			<?php if( $nposts = get_field( 'posts', $id ) ):
				foreach( $nposts as $npost ): ?>
					<a href="<?php echo get_the_permalink( $npost ); ?>" class="location-card location-card--post">
						<div class="location-card__img gradient-overlay">
							<img src="<?php echo get_the_post_thumbnail_url( $npost ); ?>" 
							alt="<?php echo get_the_title( $npost ); ?>">
							<h6 class="location-card__title"><?php echo get_the_title( $npost ); ?></h6>
						</div>
						<div class="location-card__content">
							<p class="location-card__excerpt"><?php echo get_the_excerpt( $npost ); ?></p>
						</div>       
					</a>
			<?php endforeach;
			endif; 
		endwhile; ?>
	<?php 
	endif;
	$res->output = ob_get_clean();
	// Rebuild map points
	ob_start(); 
	if( $locations->have_posts(  ) ):
		while( $locations->have_posts() ): $locations->the_post();
			$id = get_the_ID();
			if( $location = get_field( 'location', $id ) ): ?>
				<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>" data-id="<?php echo $id; ?>" data-icon="<?php echo get_field( 'location_icon', $id ); ?>">
					<div class="marker-info">
						<div class="marker-img">
							<img src="<?php echo get_the_post_thumbnail_url( $id ); ?>" alt="<?php echo get_the_title( $id ); ?>">
						</div>
						<div class="marker-content">
							<h6 class="marker-title"><?php echo get_the_title( $id ); ?></h6>
							<h6 class="marker-excerpt"><?php echo get_the_excerpt( $id ); ?></h6>
						</div>
					</div>
				</div>
		<?php endif;
		endwhile;  
	endif;
	$res->map = ob_get_clean();
	wp_reset_query(  );
	echo json_encode($res);
	die;
}



// Contact US shortcode
function contact_module_func( $atts ) {
	$a = shortcode_atts( array(
		'href' => '#',
		'title' => '',
		'target' => '',
		'href1' => '#',
		'title1' => '',
		'target1' => ''
	), $atts );
	ob_start(); ?>
	
	<div class="contact-link">
	<?php if( $a['title'] ) : ?>
        <a href="<?php echo $a['href']; ?>" target="<?php echo $a['target']; ?>" class="link">
			<?php echo $a['title']; ?>
		</a>
    <?php endif; ?>
	<?php if( $a['title'] && $a['title1'] ): ?>
		<div class="separater"></div>
	<?php endif; ?>
	<?php if( $a['title1'] ) : ?>
        <a href="<?php echo $a['href1']; ?>" target="<?php echo $a['target1']; ?>" class="cta cta-reverse">
			<?php echo $a['title1']; ?>
		</a>
    <?php endif; ?>
	</div>
	<?php 
	return ob_get_clean();
}
add_shortcode( 'contact_module', 'contact_module_func' );


// Ajax Offers
add_action('wp_ajax_loadAjaxOffers', 'loadAjaxOffers_handler');
add_action('wp_ajax_nopriv_loadAjaxOffers', 'loadAjaxOffers_handler');

function loadAjaxOffers_handler() {
    $page = $_POST['page'] ? (int)$_POST['page'] : 0;
	if( $_POST['category'] ):
		$tax_query = array(
			array( 
				'taxonomy' => 'offer_category',
				'field' => 'slug',
				'terms' => $_POST['category']
			));
	endif;
	$args = array(
		'post_type' => 'offer',
		'post_status' => 'publish',
		'tax_query' => $tax_query,
		'posts_per_page' => 3,
		'paged' => $page + 1
	);
	$query = new WP_Query( $args );
	if( $query->have_posts( ) ): 
		ob_start(); 
		while( $query->have_posts( ) ): $query->the_post( ); 
			get_template_part( 'templates/loop', 'offer', array( 'post' => get_the_ID(), 'show_more' => true ) );
		endwhile;
	else: ?>
		<div class="no-offer">No offers found.</div>
	<?php endif;

	wp_reset_query(  );
	$res->output = ob_get_clean();

    $res->has_more_pages = false;
    if ($query->max_num_pages > ( $page + 1 )) {
        $res->page = $page + 1;
        $res->has_more_pages = true;
    }

	echo json_encode($res);
	die;
}


// Ajax Venuues
add_action('wp_ajax_loadAjaxVenues', 'loadAjaxVenues_handler');
add_action('wp_ajax_nopriv_loadAjaxVenues', 'loadAjaxVenues_handler');

function loadAjaxVenues_handler() {
	if( $_POST['category'] ):
		$tax_query = array(
			array( 
				'taxonomy' => 'venue_category',
				'field' => 'slug',
				'terms' => $_POST['category']
			));
	endif;
    $page = $_POST['page'] ? (int)$_POST['page'] : 0;
	$args = array(
		'post_type' => 'venue',
		'post_status' => 'publish',
		'tax_query' => $tax_query,
		'posts_per_page' => 2,
		'paged' => $page + 1
	);
	$query = new WP_Query( $args );
	if( $query->have_posts( ) ): 
		ob_start(); 
		while( $query->have_posts( ) ): $query->the_post( ); 
			global $post;
			get_template_part( 'templates/loop', 'venues', array( 'post' => $post, 'image_type' => $_POST['type'] ) );
		endwhile;
	else: ?>
		<div class="no-venue">No venues found.</div>
	<?php endif;

	wp_reset_query(  );
	$res->output = ob_get_clean();

    $res->has_more_pages = false;
    if ($query->max_num_pages > ( $page + 1 )) {
        $res->page = $page + 1;
        $res->has_more_pages = true;
    }

	echo json_encode($res);
	die;
}

add_action('wp_ajax_newsletterSignup', 'newsletterSignup_handler');
add_action('wp_ajax_nopriv_newsletterSignup', 'newsletterSignup_handler');

function newsletterSignup_handler() {
   $response = wp_remote_post(
	   'https://www.zdirect.com/api/append_data',
	   array(
		   'method' => 'POST',
		   'headers' => array(),
		   'body' => array(
			   'username' => 'BHH.API',
			   'pass' => 'Amadeus2020%',
			   'list' => 'Boston Harbor Hotel',
			   'source' => 'eClub 2021',
			   'set_optin' => true,
			   'email' => $POST['email']
		   )
	   )
	);
	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		$res->success = false;
		$res->message = "Something went wrong: $error_message";
	} else {
		$res->success = true;
		$res->message = "Thanks for your message. It has been sent.";
	}
	echo json_encode($res);
	die;
}


/**
 * Returns the primary term for the chosen taxonomy set by Yoast SEO
 * or the first term selected.
 *
 * @link https://www.tannerrecord.com/how-to-get-yoasts-primary-category/
 * @param integer $post The post id.
 * @param string  $taxonomy The taxonomy to query. Defaults to category.
 * @return array The term with keys of 'title', 'slug', and 'url'.
 */
function get_primary_taxonomy_term($post = 0, $taxonomy = 'category') {
    if (!$post) {
        $post = get_the_ID();
    }

    $terms = get_the_terms($post, $taxonomy);
    $primary_term = array();

    if ($terms) {
        $term_display = '';
        $term_slug = '';
        $term_link = '';
        if (class_exists('WPSEO_Primary_Term')) {
            $wpseo_primary_term = new WPSEO_Primary_Term($taxonomy, $post);
            $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
            $term = get_term($wpseo_primary_term);
            if (is_wp_error($term)) {
                $term_display = $terms[0]->name;
                $term_slug = $terms[0]->slug;
                $term_link = get_term_link($terms[0]->term_id);
            } else {
                $term_display = $term->name;
                $term_slug = $term->slug;
                $term_link = get_term_link($term->term_id);
            }
        } else {
            $term_display = $terms[0]->name;
            $term_slug = $terms[0]->slug;
            $term_link = get_term_link($terms[0]->term_id);
        }
        $primary_term['url'] = $term_link;
        $primary_term['slug'] = $term_slug;
        $primary_term['title'] = $term_display;
    }
    return $primary_term;
}


// Ajax People
add_action('wp_ajax_loadAjaxPeople', 'loadAjaxPeople_handler');
add_action('wp_ajax_nopriv_loadAjaxPeople', 'loadAjaxPeople_handler');

function loadAjaxPeople_handler() {
    $page = $_POST['page'] ? (int)$_POST['page'] : 0;
	if( $_POST['category'] ):
		$tax_query = array(
			array( 
				'taxonomy' => 'people_category',
				'field' => 'term_id',
				'terms' => $_POST['category']
			));
	endif;
	$args = array(
		'post_type' => 'people',
		'post_status' => 'publish',
		'tax_query' => $tax_query,
		'posts_per_page' => 9,
		'paged' => $page + 1
	);
	$query = new WP_Query( $args );
	if( $query->have_posts( ) ): 
		ob_start(); 
		while( $query->have_posts( ) ): $query->the_post( ); 
			get_template_part( 'templates/loop', 'people', array( 'id' => get_the_ID(), 'show_more' => true ) );
		endwhile;
	else: ?>
		<div class="no-people">No people found.</div>
	<?php endif;

	wp_reset_query(  );
	$res->output = ob_get_clean();

    $res->has_more_pages = false;
    if ($query->max_num_pages > ( $page + 1 )) {
        $res->page = $page + 1;
        $res->has_more_pages = true;
    }

	if( $heading = get_field( 'heading', 'people_category_' . $_POST['category'] ) ): 
		$res->heading = $heading;
	endif;
	echo json_encode($res);
	die;
}


// Ajax Venues Popup
add_action('wp_ajax_venuesPopup', 'venuesPopup_handler');
add_action('wp_ajax_nopriv_venuesPopup', 'venuesPopup_handler');

function venuesPopup_handler() {
	$id = $_POST['id'];
	$args = array(
		'post_type' => 'venue',
		'post_status' => 'publish',
		'p' => $id
	);
	$query = new WP_Query( $args );
	ob_start(); 
	if( $query->have_posts(  ) ):
		while( $query->have_posts(  ) ): $query->the_post( ); ?>
		<div id="venues-popup" class="popup-block">
			<button class="popup-block__close">
				<svg viewBox="0 0 40 42" fill="none" xmlns="http://www.w3.org/2000/svg">
					<line x1="37.9413" y1="40.0607" x2="1.9413" y2="4.06066" stroke="#2F2F2F" stroke-width="3"/>
					<line x1="1.93934" y1="37.9393" x2="37.9393" y2="1.93934" stroke="#2F2F2F" stroke-width="3"/>
				</svg>
			</button>
			<div class="popup-block__inner">
				<div class="popup-block__images">
					<div class="popup-block__slides">
						<?php $images = get_field( 'gallery', $id );
						foreach( $images as $image ): ?>
						<div class="popup-block__slide">
							<img class="lazyload" 
								data-src="<?php echo $image['sizes']['popup']; ?>" 
								data-srcset="<?php echo $image['sizes']['popup-2x']; ?> 2x" 
								alt="<?php echo $image['alt']; ?>">
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="popup-block__content">
					<div class="popup-block__content--inner">
						<h2 class="popup-block__heading"><?php echo get_the_title( ); ?></h2>
						<div class="three-dots">
							<span></span>
							<span></span>
							<span></span>
						</div>
						<?php if( $details = get_field( 'detail', $id ) ): ?>
						<div class="popup-block__text"><?php echo $details; ?></div>
						<?php endif; ?>
					</div>
					<?php if( $booking_link = get_field( 'booking_link', $id ) ): ?>
					<div class="popup-block__content--footer">
						<a href="<?php echo $booking_link['url']; ?>" 
							class="btn btn--primary"
							target="<?php echo $booking_link['target'] ?: '_blank'; ?>">
							<?php echo $booking_link['title'] ?: 'Inquire'; ?>
						</a>
					</div>
					<?php endif; ?>
					<?php get_template_part_args( 'templates/content-module-cta', array( 'v' => 'cta', 'o' => 'f', 'c' => 'btn btn--primary popup-block__cta', 'w' => 'div', 'wc' => 'popup-block__content--footer' ) ); ?>
				</div>
			</div>
		</div>
		<?php endwhile;
	endif;
	wp_reset_query(  );
	$res->output = ob_get_clean();
	echo json_encode($res);
	die;
}