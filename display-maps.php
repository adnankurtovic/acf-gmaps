<?php
/*
Plugin Name: ACF Google maps 
Description: Display Google maps with marker using shortcode. Location saved in ACF custom field named "location". Shortcode to display map: [acfgmaps_single_marker]
*/

add_action( 'wp_enqueue_scripts', 'dir_google_map_script' ); // Firing the JS and API
// Enqueue Google Map scripts
function dir_google_map_script() {
	wp_enqueue_script( 'google-map', plugin_dir_url( __FILE__ ) . 'assets/maps.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'google-api', 'https://maps.googleapis.com/maps/api/js?key=GOOGLEMAPSAPIKEY', null, null, true); // Replace GOOGLEMAPSAPIKEY with your Google Maps API key (https://developers.google.com/maps/documentation/javascript/get-api-key)
}

add_shortcode( 'acfgmaps_single_marker', 'acfgmaps_single_marker' ); // Create shortcode [acfgmaps_single_marker]

// ACF Google Map Single Map Output
function acfgmaps_single_marker() {
        ob_start();
        $location = get_field('location');  // Set the ACF location field to a variable. You have to create ACF location field named "location" before activating the plugin

       // if( !empty($location) ) {
        ?>
                <div class="acf-map">
                        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                                <h4><a href="<?php the_permalink(); ?>" rel="bookmark"> <?php the_title(); ?></a></h4> <!-- Output the title -->
                                <p class="address"><?php echo $location['address']; ?></p> <!-- Output the address -->
                        </div>
                </div>
        <?php
        //}
  return ob_get_clean();
}

/* Stop Adding Functions Below this Line */
?>