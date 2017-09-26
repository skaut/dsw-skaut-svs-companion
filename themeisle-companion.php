<?php
/*
 * Plugin Name: DSW Skaut SVS companion
 * Plugin URI: https://github.com/skaut/dsw-skaut-svs-companion 
 * Description: Enhances ThemeIsle's themes with extra functionalities.
 * Version: 1.1
 * Author: Themeisle / Jan Teply
 * Author URI: http://themeisle.com
 * Text Domain: themeisle-companion-scout
 * Domain Path: /languages
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

define( 'THEMEISLE_COMPANION_VERSION',  '1.0.9' );
define( 'THEMEISLE_COMPANION_PATH',  plugin_dir_path( __FILE__ ) );
define( 'THEMEISLE_COMPANION_URL',  plugin_dir_url( __FILE__ ) );


if ( ! function_exists( 'add_action' ) ) {
	die('Nothing to do...');
}
add_action( 'plugins_loaded', 'themeisle_companion_textdomain' );

/**
 * Load plugin textdomain.
 */
function themeisle_companion_textdomain() {
	load_plugin_textdomain( 'themeisle-companion', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}


function themeisle_companion_loader() {
	if ( function_exists( 'zerif_setup' ) ) {
		require_once( THEMEISLE_COMPANION_PATH . 'inc/zerif-lite/zerif-lite-functions.php' );
	}
}

add_action( 'after_setup_theme', 'themeisle_companion_loader', 0 );

function scout_companion_check_for_updates( $transient ) {

	if ( empty( $transient->checked ) ) {
		return $transient;
	}

	$pluginName = '';
	$pluginSlug = '';

	foreach ( $transient->checked as $plugin => $version ) {
		if ( strpos( $plugin, 'dsw-skaut-svs-companion' ) !== false ) {
			$pluginName = $plugin;
			$pluginSlug = dirname( $plugin );
		}
	}

	if ( $pluginName === '' ) {
		return $transient;
	}

	$raw = wp_remote_get( 'https://api.github.com/repos/skaut/dsw-skaut-svs-companion/releases/latest', [ 'user-agent' => 'skaut' ] );
	if ( is_wp_error( $raw ) || wp_remote_retrieve_response_code( $raw ) !== 200 ) {
		return $transient;
	}

	$actual = json_decode( $raw['body'] );
	if ( $actual === null ) {
		return $transient;
	}

	if ( preg_match( '~\d+\.\d+~', $actual->tag_name ) === 1 ) {
		$package = $actual->zipball_url;
		$version = $actual->tag_name;

		if ( $package !== null && version_compare( $transient->checked[ $pluginName ], $version, '<' ) ) {
			$transient->response[ $pluginName ] = [
				'slug'        => $pluginSlug,
				'new_version' => $version,
				'url'         => $actual->html_url,
				'package'     => $package
			];
		}
	}

	return $transient;
}

add_filter( 'pre_set_site_transient_update_plugins', 'scout_companion_check_for_updates' );

add_filter( 'upgrader_package_options', function ( $options ) {
	if ( ! isset( $options['hook_extra'], $options['hook_extra']['plugin'] ) || strpos( $options['hook_extra']['plugin'], 'dsw-skaut-svs-companion' ) === false ) {
		return $options;
	}

	$raw = wp_remote_get( 'https://api.github.com/repos/skaut/dsw-skaut-svs-companion/releases/latest', [ 'user-agent' => 'skaut' ] );
	if ( is_wp_error( $raw ) || wp_remote_retrieve_response_code( $raw ) !== 200 ) {
		return $options;
	}

	$actual = json_decode( $raw['body'] );
	if ( $actual === null ) {
		return $options;
	}

	if ( preg_match( '~\d+\.\d+~', $actual->tag_name ) === 1 ) {
		$package = $actual->zipball_url;
	} else {
		return $options;
	}

	$options['package'] = $package;

	return $options;
}, 10, 1 );

add_filter( 'upgrader_source_selection', function ( $source ) {
	if ( strpos( $source, 'dsw-skaut-svs-companion' ) === false ) {
		return $source;
	}

	preg_match( "~([^\/]+)\/$~", $source, $result );
	if ( ! isset( $result[1] ) ) {
		return $source;
	}
	$newFolderName = str_replace( $result[1], 'dsw-skaut-svs-companion', $source );
	rename( $source, $newFolderName );

	return $newFolderName;
}, 20, 1 );

add_action( 'upgrader_process_complete', function ( $obj, $hookExtra ) {
	if ( isset( $hookExtra['plugins'] ) ) {
		foreach ( $hookExtra['plugins'] as $key => $plugin ) {
			if ( strpos( $plugin, 'dsw-skaut-svs-companion' ) !== false ) {
				global $wpdb;
				$activePlugins = $wpdb->get_results( $wpdb->prepare( "
				    SELECT `option_value`
				    FROM $wpdb->options
				    WHERE `option_name` = %s 
				    LIMIT 1
			    	", 'active_plugins' ) );
				$activePlugins = unserialize( $activePlugins[0]->option_value );
				foreach ( $activePlugins as $key => &$plugin ) {
					if ( strpos( $plugin, 'dsw-skaut-svs-companion-' ) !== false ) {
						$plugin = 'dsw-skaut-svs-companion/themeisle-companion.php';
					}
				}
				$wpdb->query( $wpdb->prepare( "
				    UPDATE $wpdb->options
				    SET `option_value` = %s
				    WHERE `option_name` = %s
				    LIMIT 1
				", serialize( $activePlugins ), 'active_plugins' ) );
			}
		}
	}
}, 100, 2 );
