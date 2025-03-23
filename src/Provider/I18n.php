<?php
/**
 * Internationalization provider.
 *
 * @package   Cedaro\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

declare ( strict_types = 1 );

namespace Plugin\Provider;

use Plugin\HookProviderInterface;
use Plugin\HooksTrait;
use Plugin\PluginAwareInterface;
use Plugin\PluginAwareTrait;

/**
 * Internationalization class.
 *
 * @package Cedaro\WP\Plugin
 */
class I18n implements PluginAwareInterface, HookProviderInterface {

	use HooksTrait, PluginAwareTrait;

	/**
	 * Register hooks.
	 *
	 * Loads the text domain during the `init` action.
	 */
	public function register_hooks() {
		if ( did_action( 'init' ) ) {
			$this->load_textdomain();
		} else {
			$this->add_action( 'init', 'load_textdomain' );
		}
	}

	/**
	 * Load the text domain to localize the plugin.
	 */
	protected function load_textdomain() {
		$plugin_rel_path = dirname( $this->plugin->get_basename() ) . '/languages';
		load_plugin_textdomain( $this->plugin->get_slug(), false, $plugin_rel_path );
	}
}
