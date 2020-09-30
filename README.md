# acf-gmaps
WordPress plugin for displaying Google Maps and a marker which location is stored in custom field (ACF)

Usage:
  1. Install and activate Advanced Custom Fields WordPress plugin (https://wordpress.org/plugins/advanced-custom-fields/)
  2. Create a new custom field "location"
  3. On a post where you want to display Google map, set location
  4. Install and activate acf-gmaps plugin
  5. In display-maps.php replace GOOGLEMAPSAPIKEY (line 11) with your Google Maps API key (https://developers.google.com/maps/documentation/javascript/get-api-key)
  5. Use shortcode to display map with a marker [acfgmaps_single_marker]
