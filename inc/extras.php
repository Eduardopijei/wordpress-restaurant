
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
function theme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'theme_body_classes' );

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
	$color = get_field( 'color', get_queried_object_id() );
	if ( $color == 'cyan' ) {
		$classes[] = 'color--cyan';
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
	$ave_time_per_mile = 18.5;
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

