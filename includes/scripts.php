<?php

/**
 * Load Scripts
 *
 * Enqueues the required scripts.
 *
 * @since 1.0.0
 */
function plugin_name_load_scripts() {

	$js_dir = PLUGIN_NAME_PLUGIN_URL . 'includes/js/';

	wp_enqueue_script( 'plugin-name', $js_dir . 'plugin-name.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'plugin_name_load_scripts' );

// register our form css
function plugin_name_register_css() {
	wp_register_style('plugin-name-css',  PLUGIN_NAME_PLUGIN_URL . 'includes/css/style.min.css', array(), PLUGIN_NAME_VERSION );
	wp_enqueue_style( 'plugin-name-css' );
}
add_action('wp_enqueue_scripts', 'plugin_name_register_css');