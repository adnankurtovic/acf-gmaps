<?php
class ACFGmaps {
	private $acf_gmaps_options;
	
	function dbi_add_settings_page() {
		add_options_page( 'ACFGmaps plugin page', 'ACFGmaps Plugin Menu', 'manage_options', ‘dbi-example-plugin’, 'dbi_render_plugin_settings_page' );
	}
	add_action( 'admin_menu', 'dbi_add_settings_page' );

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'acf_gmaps_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'acf_gmaps_page_init' ) );
	}

	public function acf_gmaps_add_plugin_page() {
		add_menu_page(
			'ACF GMaps', // page_title
			'ACF GMaps', // menu_title
			'manage_options', // capability
			'acf-gmaps', // menu_slug
			array( $this, 'acf_gmaps_create_admin_page' ), // function
			'dashicons-admin-generic', // icon_url
			81 // position
		);
	}

	public function acf_gmaps_create_admin_page() {
		$this->acf_gmaps_options = get_option( 'acf_gmaps_option_name' ); ?>

		<div class="wrap">
			<h2>ACF GMaps</h2>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'acf_gmaps_option_group' );
					do_settings_sections( 'acf-gmaps-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function acf_gmaps_page_init() {
		register_setting(
			'acf_gmaps_option_group', // option_group
			'acf_gmaps_option_name', // option_name
			array( $this, 'acf_gmaps_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'acf_gmaps_setting_section', // id
			'Settings', // title
			array( $this, 'acf_gmaps_section_info' ), // callback
			'acf-gmaps-admin' // page
		);

		add_settings_field(
			'google_maps_api_key', // id
			'Google Maps API key', // title
			array( $this, 'google_maps_api_key_callback' ), // callback
			'acf-gmaps-admin', // page
			'acf_gmaps_setting_section' // section
		);
	}

	public function acf_gmaps_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['google_maps_api_key'] ) ) {
			$sanitary_values['google_maps_api_key'] = sanitize_text_field( $input['google_maps_api_key'] );
		}

		return $sanitary_values;
	}

	public function acf_gmaps_section_info() {
		
	}

	public function google_maps_api_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="acf_gmaps_option_name[google_maps_api_key]" id="google_maps_api_key" value="%s">',
			isset( $this->acf_gmaps_options['google_maps_api_key'] ) ? esc_attr( $this->acf_gmaps_options['google_maps_api_key']) : ''
		);
	}

}
if ( is_admin() )
	$acf_gmaps = new ACFGmaps();

/* 
 * Retrieve this value with:
 * $acf_gmaps_options = get_option( 'acf_gmaps_option_name' ); // Array of All Options
 * $google_maps_api_key = $acf_gmaps_options['google_maps_api_key']; // Google Maps API key
 */
