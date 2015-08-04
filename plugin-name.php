<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://website.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin Name
 * Plugin URI:        http://website.com
 * Description:       Description
 * Version:           1.0.0
 * Author:            Author Name
 * Author URI:        http://website.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

final class Plugin_Name {

	/**
	 * @var Plugin_Name.
	 * @since 1.4
	 */
	private static $instance;


	/**
	 * Main Plugin_Name Instance
	 *
	 * Insures that only one instance of Plugin_Name exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 1.4
	 * @static
	 * @staticvar array $instance
	 * @uses Plugin_Name::setup_constants() Setup the constants needed
	 * @uses Plugin_Name::includes() Include the required files
	 * @uses Plugin_Name::load_textdomain() load the language files
	 * @see Plugin_Name()
	 * @return The one true Plugin_Name
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Plugin_Name ) ) {
			self::$instance = new Plugin_Name;
			self::$instance->setup_constants();

			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

			self::$instance->includes();
		}
		return self::$instance;
	}

	/**
	 * Setup plugin constants
	 *
	 * @access private
	 * @since 1.4
	 * @return void
	 */
	private function setup_constants() {

		// Plugin version
		if ( ! defined( 'PLUGIN_NAME_VERSION' ) ) {
			define( 'PLUGIN_NAME_VERSION', '1.0.0' );
		}

		// Plugin Folder Path
		if ( ! defined( 'PLUGIN_NAME_PLUGIN_DIR' ) ) {
			define( 'PLUGIN_NAME_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL
		if ( ! defined( 'PLUGIN_NAME_PLUGIN_URL' ) ) {
			define( 'PLUGIN_NAME_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File
		if ( ! defined( 'PLUGIN_NAME_PLUGIN_FILE' ) ) {
			define( 'PLUGIN_NAME_PLUGIN_FILE', __FILE__ );
		}
	}

	/**
	 * Include required files
	 *
	 * @access private
	 * @since 1.0.0
	 * @return void
	 */
	private function includes() {

		require_once PLUGIN_NAME_PLUGIN_DIR . 'includes/scripts.php';

	}

	/**
	 * Loads the plugin language files
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function load_textdomain() {
		// Set filter for plugin's languages directory
		$plugin_name_lang_dir = dirname( plugin_basename( PLUGIN_NAME_PLUGIN_FILE ) ) . '/languages/';
		$plugin_name_lang_dir = apply_filters( 'plugin_name_languages_directory', $plugin_name_lang_dir );

		// Traditional WordPress plugin locale filter
		$locale        = apply_filters( 'plugin_locale',  get_locale(), 'plugin-name' );
		$mofile        = sprintf( '%1$s-%2$s.mo', 'plugin-name', $locale );

		// Setup paths to current locale file
		$mofile_local  = $plugin_name_lang_dir . $mofile;

		if ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/plugin-name/languages/ folder
			load_textdomain( 'plugin-name', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'plugin-name', false, $plugin_name_lang_dir );
		}
	}
}


/**
 * The main function responsible for returning the one true Plugin_Name
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 *
 * @since 1.0.0
 * @return object The one true Plugin_Name Instance
 */

function Plugin_Name() {
	return Plugin_Name::instance();
}

// Get Plugin_Name Running
Plugin_Name();
